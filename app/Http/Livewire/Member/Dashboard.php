<?php

namespace App\Http\Livewire\Member;

use App\Models\User;
use App\Models\Bonus;
use Livewire\Component;
use App\Models\Withdrawal;
use App\Models\Achievement;
use App\Models\Information;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $downline, $achievement, $information, $remaining_contract, $gift, $total_wd, $notification = [];

    public function mount()
    {
        if (auth()->user()->due_date) {
            $this->notification[] = "<div class='alert intro-y alert-warning text-1xl gap-6 show mt-2' role='alert'>
            Your account is in grace period. Renew your contract <strong><a href='/renewal' class='text-danger'>here</a></strong> before ".auth()->user()->due_date."
        </div>";
        }
        if (!auth()->user()->google2fa_secret) {
            $this->notification[] = "<div class='alert intro-y alert-danger-soft text-1xl gap-6 show mt-2' role='alert'>
            You need to activate google authenticator <strong><a href='/renewal' class='text-danger'>here</a></strong>
        </div>";
        }
        $this->total_wd = Withdrawal::where('id_member', auth()->id())->orderBy('created_at', 'desc')->get();
        $this->gift = Bonus::where('id_member', auth()->id())->orderBy('created_at', 'desc')->get();
        $this->information = Information::all();
        $this->remaining_contract = (auth()->user()->contract->max_claim / 100 * auth()->user()->contract_price) - $this->total_wd->sum('amount');
        $this->downline = User::with('left_child')->with('right_child')->with('invalid_left_turnover')->with('invalid_right_turnover')->select("id", "username", "email", "id_rating", "upline", "position", "contract_price", "name", "network", "due_date", "deleted_at",
        DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ki")))=concat(user.network, user.id, "ki") ) left_turnover'),
        DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ka")))=concat(user.network, user.id, "ka") ) right_turnover'))->where('id', auth()->id())->first();
        $this->achievement = Achievement::where('id_member', auth()->id())->with('rating')->get();
    }

    public function render()
    {
        return view('livewire.member.dashboard', [
            'menu' => 'dashboard'
        ])->extends('layouts.default');
    }
}
