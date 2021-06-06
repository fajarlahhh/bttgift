<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use App\Models\Deposit;
use App\Models\Payment;
use Livewire\Component;
use App\Models\Contract;
use Hexters\CoinPayment\CoinPayment;
use Illuminate\Support\Facades\Http;

class Activation extends Component
{
    public $data_payment, $contract, $method, $wallet, $coin, $amount, $name, $alias, $description, $deposit, $time;

    public function mount()
    {
        if (auth()->user()->registration_waiting) {
            $data = auth()->user()->registration_waiting->first();
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
        if ($this->method) {
            $ticket = Ticket::where('date', date('Y-m-d'))->where('contract_price', auth()->user()->contract_price)->orderBy('created_at')->first();
            if ($ticket) {
                $ticket = sprintf('%05s', (integer)substr($ticket->kode, 0, 5) + 1);
            }else{
                $ticket = "00001";
            }

            $indodax = Http::get('https://indodax.com//api/summaries')->collect()->first();
            $payment = $this->data_payment->where('id', $this->method)->first();
            $this->name = $payment->name;
            $this->alias = $payment->alias;
            $this->wallet = $payment->wallet;
            $this->description = $payment->description;
            $usdt_idr = (float)$indodax['usdt_idr']['last'];
            $payment_idr = (float)$indodax[strtolower($payment->alias)]['last'];
            $this->amount = (float)round(auth()->user()->contract_price * $payment_idr / $usdt_idr).".".$ticket;
        }
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'wallet' => 'required',
            'amount' => 'required'
        ]);



        $deposit = new Deposit();
        $deposit->id_member = auth()->id();
        $deposit->coin_name = $this->name;
        $deposit->wallet = $this->wallet;
        $deposit->amount = $this->amount;
        $deposit->requisite = 'Registration';
        $deposit->save();

        redirect('/activation');
    }

    public function render()
    {
        return view('livewire.activation', [
            'menu' => 'activation'
        ])->extends('layouts.default');
    }
}
