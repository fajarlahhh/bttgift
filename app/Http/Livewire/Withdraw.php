<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Bonus;
use App\Models\User;
use Livewire\Component;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Withdraw extends Component
{
    public $amount, $address, $fee_percentage, $fee = 0, $error, $total_wd, $max_wd, $min_wd, $remaining_contract, $success, $bonus, $btt_price, $btt = 0, $submit=true;

    public function mount()
    {
        $this->total_wd = Withdrawal::where('id_member', auth()->id())->get();
        if ($this->total_wd->filter(function ($q) {
            return false !== stristr($q->created_at, date('Y-m-d'));
        })->count() == 0){
            $this->btt_price = (float)Http::get('https://indodax.com//api/summaries')->collect()->first()['btt_usdt']['last'];
            $bonus_all = Bonus::where('id_member', auth()->id())->get();
            $this->bonus = $bonus_all->sum('credit') - $bonus_all->sum('debit');
            $this->fee_percentage = auth()->user()->contract->fee_wd;
            $this->address = auth()->user()->wallet;
            $this->min_wd = auth()->user()->contract->min_wd / 100 * auth()->user()->contract_price;
            $this->max_wd = auth()->user()->contract->max_wd / 100 * auth()->user()->contract_price;
            $this->remaining_contract = (auth()->user()->contract->max_claim / 100 * auth()->user()->contract_price) - $this->total_wd->sum('amount');
        }
    }

    public function updated()
    {
        $this->submit = false;
        $this->fee = $this->amount * $this->fee_percentage / 100;
        $this->btt = round(($this->amount - $this->fee) / $this->btt_price);
        $this->btt_price = (float)Http::get('https://indodax.com//api/summaries')->collect()->first()['btt_usdt']['low'];
        $this->submit = true;
    }

    public function submit()
    {
        $this->reset(['error', 'success']);

        $this->validate([
            'amount' => 'required',
            'address' => 'required',
            'fee' => 'required'
        ]);

        if ($this->submit == false) {
            $this->error .= "You can't do this action now<br>";
            return;
        }

        $bonus_all = Bonus::where('id_member', auth()->id())->get();
        $this->bonus = $bonus_all->sum('credit') - $bonus_all->sum('debit');

        if ($this->bonus - $this->amount < 0) {
            $this->error .= "Your bonus has not reached ".$this->amount."<br>";
        }

        if ($this->total_wd->filter(function ($q) {
            return false !== stristr($q->created_at, date('Y-m-d'));
        })->count() > 0) {
            $this->error .= "You have made a withdrawal today<br>";
        }

        if ($this->remaining_contract < $this->amount) {
            $this->error .= "The amount exceeds the remaining contract<br>";
        }

        if ($this->amount < $this->min_wd) {
            $this->error .= "The amount cannot be less than the minimum withdraw<br>";
        }

        if ($this->amount > $this->max_wd) {
            $this->error .= "The amount must not exceed the maximum withdraw<br>";
        }

        if($this->error){
            return;
        }

        DB::transaction(function () {
            $withdrawal = new Withdrawal();
            $withdrawal->wallet = $this->address;
            $withdrawal->amount = $this->amount;
            $withdrawal->fee = $this->fee;
            $withdrawal->acceptance = $this->amount - $this->fee;
            $withdrawal->btt_price = $this->btt_price;
            $withdrawal->accepted_btt = $this->btt;
            $withdrawal->id_member = auth()->id();
            $withdrawal->save();

            $bonus = new Bonus();
            $bonus->description = 'Withdrawal '.now().' amount '.$this->amount;
            $bonus->debit = $this->amount;
            $bonus->credit = 0;
            $bonus->type = 'Withdrawal';
            $bonus->id_member = auth()->id();
            $bonus->id_withdrawal = $withdrawal->id;
            $bonus->save();
        });

        if ($this->total_wd->sum('amount') + $this->amount < $this->min_wd) {
            User::where('id_member', auth()->id())->updated([
                'due_date' => Carbon::now()->addDays(2)
            ]);
        }

        redirect('/withdrawal');

    }

    public function render()
    {
        return view('livewire.withdraw', [
            'menu' => 'withdrawal'
        ])->extends('layouts.default');
    }
}
