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
    public $daily = [], $daily_gift, $deposit, $withdrawal, $achievement, $user;

    public function mount()
    {

        $this->deposit = Deposit::whereNull('processed_at')->whereNotNull('file')->whereNotNull('information')->count();
        $this->withdrawal = Withdrawal::whereNull('processed_at')->count();
        $this->achievement = Achievement::whereNull('processed_at')->count();
        $this->user = User::whereNotNull('actived_at')->count();
    }

    public function daily()
    {
        $this->validate([
            'daily' => 'required'
        ]);
        DB::transaction(function () {
            foreach ($this->daily as $key => $row) {
                if ($row['gift'] > 0) {
                    $daily = new Daily();
                    $daily->date = $row['date'];
                    $daily->gift = $row['gift'];
                    $daily->save();

                    $bonus = [];
                    foreach (User::whereNotNull('actived_at')->whereNull('due_date')->get() as $key => $sub) {
                        array_push($bonus,[
                            'description' => 'Daily Gift '.$row['gift'].' %',
                            'type' => "Daily",
                            'debit' => 0,
                            'credit' => $sub->contract_price * $row['gift'] /100,
                            'id_member' => $sub->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                    $data_bonus = collect($bonus)->chunk(10);
                    foreach ($data_bonus as $item)
                    {
                        Bonus::insert($item->toArray());
                    }
                }
            }
        });
        redirect('/admin-area/dashboard');
    }

    public function render()
    {
        $this->daily = [];
        $data = Daily::orderBy('date', 'desc')->get();
        if($data->count() == 0){
            $last = date('Y-m-d', strtotime(User::first()->created_at));
        }else{
            $last = Carbon::parse($data->first()->date)->format('Y-m-d');
        }
        $from = Carbon::parse($last);
        $now = Carbon::now();

        $diff = $from->diffInDays($now);
        for ($i=0; $i < $diff; $i++) {
            array_push($this->daily, [
                'gift' => 0,
                'date' => $from->addDays(1)->format('Y-m-d')
            ]);
        }
        return view('livewire.administrator.dashboard', [
            'menu' => 'activation'
        ])->extends('layouts.dashboard');
    }
}
