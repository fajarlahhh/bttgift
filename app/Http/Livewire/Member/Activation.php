<?php

namespace App\Http\Livewire\Member;

use App\Models\Ticket;
use App\Models\Deposit;
use App\Models\Payment;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Activation extends Component
{
    use WithFileUploads;

    public $data_payment, $error, $contract, $method, $wallet, $coin, $amount, $name, $alias, $description, $deposit, $time, $ticket, $file, $information;

    public function mount()
    {
        if (auth()->user()->registration_waiting_fund->count() > 0) {
            $data = auth()->user()->registration_waiting_fund->first();
            $this->name = $data->coin_name;
            $this->wallet = $data->wallet;
            $this->amount = $data->amount;
            $this->time = $data->created_at;
            return;
        }
        $this->data_payment = Payment::all();
        $this->contract = "$ ".number_format(auth()->user()->contract_price);
    }

    public function updated()
    {
        // if ($this->method) {
        //     $indodax = Http::get('https://indodax.com/api/summaries')->collect()->first();
        //     $payment = $this->data_payment->where('id', $this->method)->first();
        //     $this->name = $payment->name;
        //     $this->alias = $payment->alias;
        //     $this->wallet = $payment->wallet;
        //     $this->description = $payment->description;
        //     $payment_idr = (float)$indodax[strtolower($payment->alias)]['last'];
        //     $this->amount = (float)ceil(auth()->user()->contract_price * 15000 / $payment_idr);
        // }
    }

    public function done()
    {
        $this->validate([
            'information' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $file = null;
        if($this->file){
            $image = $this->file;
            $file_name = auth()->user()->username.date('-Ymd-').time().uniqid();
            $img = Image::make($image->getRealPath())->encode('png', 100)->fit(760, null, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });;
            $img->stream();
            Storage::disk('public')->put('deposit/'.$file_name.'.png', $img);
            $img->destroy();

            $file = 'deposit/'.$file_name.'.png';
        }

        $deposit = Deposit::findOrFail(auth()->user()->registration_waiting_fund->first()->id);
        $deposit->information = $this->information;
        $deposit->file = $file;
        $deposit->save();
        redirect('/activation');
    }

    public function submit()
    {
        $this->validate([
            'method' => 'required',
        ]);


        if (auth()->user()->registration_waiting_fund->count() == 0) {
            DB::transaction(function () {

                $indodax = Http::get('https://indodax.com/api/summaries')->collect()->first();
                $payment = $this->data_payment->where('id', $this->method)->first();
                $this->name = $payment->name;
                $this->alias = $payment->alias;
                $this->wallet = $payment->wallet;
                $this->description = $payment->description;
                $payment_idr = (float)$indodax[strtolower($payment->alias)]['last'];
                $this->amount = (float)ceil(auth()->user()->contract_price * 15000 / $payment_idr);

                $data_ticket = Ticket::where('date', date('Y-m-d'))->where('contract_price', auth()->user()->contract_price)->orderBy('created_at', 'desc')->get();
                if($data_ticket->count() > 0){
                    $this->ticket = $data_ticket->first()->kode;
                }else{
                    $this->ticket = 1;
                }

                $ticket = new Ticket();
                $ticket->contract_price = auth()->user()->contract_price;
                $ticket->kode = $this->ticket;
                $ticket->date = now();
                $ticket->save();

                $deposit = new Deposit();
                $deposit->id_member = auth()->id();
                $deposit->coin_name = $this->name;
                $deposit->wallet = $this->wallet;
                $deposit->amount = $this->amount + $this->ticket;
                $deposit->requisite = 'Registration';
                $deposit->save();
            });
        }

        redirect('/activation');
    }

    public function render()
    {
        return view('livewire.member.activation', [
            'menu' => 'activation'
        ])->extends('layouts.dashboard');
    }
}
