<?php

namespace App\Http\Livewire\Member;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Deposit;
use App\Models\Payment;
use Livewire\Component;
use App\Models\Contract;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Enrollment extends Component
{
    use WithFileUploads;

    public $file, $payment_method, $payment_information, $payment_time, $payment_name, $payment_wallet, $ticket, $payment_amount, $data_payment, $type = 'password', $show = 'Show', $username, $password, $name, $email, $contract, $message, $position = 1, $upline, $data_upline = [], $data_contract = [], $error, $waiting = false;

    public function mount()
    {
        $this->upline = auth()->id();
        $waiting = User::where('id_user', auth()->id())->whereNull('actived_at')->first();
        $deposit = Deposit::where('id_member', $waiting->id)->whereNull('file')->whereNull('information')->get();
        if ($deposit->count() > 0) {
            $data = Deposit::where('id_member', $waiting->id)->first();
            $this->payment_name = $data->coin_name;
            $this->payment_wallet = $data->wallet;
            $this->payment_amount = $data->amount;
            $this->payment_time = $data->created_at;
            $this->waiting = true;
            return;
        }
        $this->data_payment = Payment::all();
        $this->data_contract = Contract::all();
        $this->data_upline = User::with('left_child')->with('right_child')->where('id', auth()->id())->get()->first();
    }

    public function done()
    {
        $this->validate([
            'payment_information' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $waiting = User::where('id_user', auth()->id())->whereNull('actived_at')->get();
        $file = null;
        if($this->file){
            $image = $this->file;
            $file_name = $waiting->first()->username.date('-Ymd-').time().uniqid();
            $img = Image::make($image->getRealPath())->encode('png', 100)->fit(760, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });;
            $img->stream();
            Storage::disk('public')->put('deposit/'.$file_name.'.png', $img);
            $img->destroy();

            $file = 'deposit/'.$file_name.'.png';
        }

        $deposit = Deposit::where('id_member', $waiting->first()->id)->whereNull('file')->whereNull('information')->first();
        $deposit->information = $this->payment_information;
        $deposit->file = $file;
        $deposit->save();
        redirect('/enrollment');
    }

    public function updated()
    {
        if ($this->payment_method) {
            $indodax = Http::get('https://indodax.com//api/summaries')->collect()->first();
            $payment = $this->data_payment->where('id', $this->payment_method)->first();
            $payment_idr = (float)$indodax[strtolower($payment->alias)]['last'];
            $this->payment_name = $payment->name;
            $this->payment_wallet = $payment->wallet;
            $this->payment_amount = (float)ceil(auth()->user()->contract_price * 15000 / $payment_idr);
        }
    }

    public function showHide($type)
    {
        $this->emit('reinitialize');
        if ($type == 'Show') {
            $this->show = "Hide";
            $this->type = "text";
        } else {
            $this->show = "Show";
            $this->type = "password";
        }
    }

    public function submit()
    {
        $this->error = null;
        if ($this->waiting == true) {
            $this->error .= "You must complete the previous registration";
            return;
        }

        $this->validate([
            'username' => 'required',
            'password' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'contract' => 'required',
            'upline' => 'required',
            'position' => 'required'
        ]);

        if (User::where('username', $this->username)->count() > 0) {
            $this->error .= "Username already exist";
        }

        if (User::where('email', $this->email)->count() > 0) {
            $this->error .= "Email already used";
        }
        if($this->error){
            return;
        }

        DB::transaction(function () {
            $referral = date('Ymd');
            $upline = User::where('id', $this->upline)->first();

            $user = new User();
            $user->id_user = auth()->id();
            $user->username = $this->username;
            $user->password = Hash::make($this->password);
            $user->name = $this->name;
            $user->email = $this->email;
            $user->contract_price = $this->contract;
            $user->position = $this->position;
            $user->upline = $this->upline;
            $user->network = trim($upline->network).$upline->id.($this->position == 0? 'ki': 'ka');
            $user->left_referral = md5($this->username)."0";
            $user->right_referral = md5($this->username)."1";
            $user->save();

            $ticket = Ticket::where('date', date('Y-m-d'))->where('contract_price', $this->contract)->orderBy('created_at', 'desc')->first();
            if ($ticket) {
                $this->ticket = sprintf('%05s', (integer)substr($ticket->kode, 0, 5) + 1);
            }else{
                $this->ticket = "00001";
            }
            $this->payment_amount = $this->payment_amount.".".$this->ticket;
            $ticket = new Ticket();
            $ticket->contract_price = $this->contract;
            $ticket->kode = $this->ticket;
            $ticket->date = now();
            $ticket->save();

            $deposit = new Deposit();
            $deposit->id_member = $user->id;
            $deposit->coin_name = $this->payment_name;
            $deposit->wallet = $this->payment_wallet;
            $deposit->amount = $this->payment_amount;
            $deposit->requisite = 'Registration';
            $deposit->save();
        });

        redirect('/enrollment');
    }

    public function render()
    {
        $this->emit('reinitialize');
        return view('livewire.member.enrollment')->extends('layouts.default', [
            'menu' => 'enrollment'
        ]);
    }
}
