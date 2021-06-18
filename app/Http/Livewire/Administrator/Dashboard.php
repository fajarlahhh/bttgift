<?php

namespace App\Http\Livewire\Administrator;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Bonus;
use App\Models\Daily;
use App\Models\Deposit;
use Livewire\Component;
use App\Models\Withdrawal;
use App\Models\Achievement;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $daily, $daily_gift, $deposit, $withdrawal, $achievement, $user;

    public function mount()
    {
        $this->daily = Daily::where('date', date('Y-m-d'))->whereNotNull('file')->whereNotNull('information')->count();

        $this->deposit = Deposit::whereNull('processed_at')->count();
        $this->withdrawal = Withdrawal::whereNull('processed_at')->count();
        $this->achievement = Achievement::whereNull('processed_at')->count();
        $this->user = User::whereNotNull('actived_at')->count();
    }

    public function daily()
    {
        $this->validate([
            'daily_gift' => 'required'
        ]);

        DB::transaction(function () {
            $daily = new Daily();
            $daily->date = date('Y-m-d');
            $daily->gift = $this->daily_gift;
            $daily->save();

            $bonus = [];
            foreach (User::whereNotNull('actived_at')->whereNull('due_date')->get() as $key => $row) {
                array_push($bonus,[
                    'description' => 'Daily Gift '.$this->daily_gift.' %',
                    'type' => "Daily",
                    'debit' => 0,
                    'credit' => $row->contract_price * $this->daily_gift /100,
                    'id_member' => $row->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
            $data_bonus = collect($bonus)->chunk(10);
            foreach ($data_bonus as $item)
            {
                Bonus::insert($item->toArray());
            }
        });
        redirect('/admin-area/dashboard');
    }

    public function render()
    {
        return view('livewire.administrator.dashboard', [
            'menu' => 'activation'
        ])->extends('layouts.dashboard');
    }
}
