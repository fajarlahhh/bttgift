<?php

namespace App\Http\Livewire\Administrator;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Bonus;
use App\Models\Rating;
use Livewire\Component;
use App\Models\Achievement;
use Livewire\WithPagination;
use App\Models\InvalidTurnover;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Deposit extends Component
{
    use WithPagination;

    public $proccess = 0, $month, $year, $key, $parent = [];
    protected $queryString = ['proccess', 'month', 'year'];

    public function mount()
    {
        $this->month = $this->month?:date('m');
        $this->year = $this->year?:date('Y');
    }

    public function cancel()
    {
        $this->key = null;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function setParent($data)
    {
        $left_turnover = (float) $data->left_turnover - (float) $data->invalid_left_turnover->sum('amount');
        $right_turnover = (float) $data->right_turnover - (float) $data->invalid_right_turnover->sum('amount');

        if(strlen($data->deleted_at) === 0 || $data->due_date){
            array_push($this->parent, [
                'id' => $data->id,
                'username' => $data->username,
                'upline' => $data->upline,
                'network' => $data->network,
                'contract' => $data->contract_price,
                'position' => $data->position,
                'founder' => $data->upline? 0: 1,
                'pair' => $left_turnover > 0 && $right_turnover > 0? 1: 0,
                'left' => $left_turnover,
                'right' => $right_turnover,
                'rating' => $data->id_rating? $data->rating->sort: null,
                'active' => $data->deleted_at? 0: 1,
                'due_date' => $data->due_date
            ]);
        }

        if($data->parent)
            $this->setParent($data->parent);
    }

    public function proccess()
    {
        DB::transaction(function () {
            $time = now();
            $data = \App\Models\Deposit::with('member')->findOrFail($this->key);

            $data->update([
                'id_user' => auth()->id(),
                'processed_at' => $time
            ]);

            File::delete(public_path(Storage::url($data->file)));

            $update = [
                'actived_at' => $time
            ];
            if ($data->requisite == 'Reinvest') {
                $update = [
                    'due_date' => null
                ];
            }

            User::findOrFail($data->id_member)->update($update);

            $bonus = [];

            array_push($bonus,[
                'description' => ($data->member->position == 0? "Left side": "Right side")." referral 10% of ".number_format($data->member->contract_price)." by ".$data->member->username,
                'type' => "Referral",
                'debit' => 0,
                'credit' => $data->member->contract_price * 10 /100,
                'id_member' => $data->member->upline,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            if ($data->requisite == 'Registration') {
                $this->parent = [];
                $this->setParent(User::with('parent')->with('rating')->with('invalid_left_turnover')->with('invalid_right_turnover')->select("id", "username", "email", "id_rating", "upline", "position", "contract_price", "name", "network", "due_date", "deleted_at",
                DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ki")))=concat(user.network, user.id, "ki") ) left_turnover'),
                DB::raw('(select ifnull(sum(contract_price), 0) from user a where a.actived_at is not null and left(a.network, length(concat(user.network, user.id, "ka")))=concat(user.network, user.id, "ka") ) right_turnover'))->where('id', $data->id_member)->first());

                $data_rating = Rating::all();
                $invalid_turnover = [];
                $parent_length = 0;
                $network = $data->member->network;

                $persen = 5;
                $level = 1;
                foreach (collect($this->parent)->filter(function($q) use($data){
                    return $q['id'] != $data->id_member;
                }) as $key => $row) {
                    $achievement_id = 0;
                    if(is_null($row['due_date']) == 1 && $row['active'] == 1){
                        $kaki_kecil = collect([$row['left'], $row['right']])->min();

                        $child = User::findOrFail($row['id']);

                        $rating = $data_rating->filter(function ($q) use ($kaki_kecil)
                        {
                            return $q->min_turnover <= $kaki_kecil;
                        })->sortByDesc('min_turnover')->first();

                        if ($rating && strlen($child->upline) > 1 && Achievement::where('id_member', $row['id'])->where('id_rating', $rating->id_rating)->get()->count() == 0) {
                            $child->id_rating = $rating->id_rating;

                            if(User::where('username', $child->username)->where('id_rating', $rating->id_rating)->get()->count() == 0){
                                $pcp = new Achievement();
                                $pcp->id_member = $row['id'];
                                $pcp->id_rating = $rating->id_rating;
                                $pcp->rating_reward = $rating->reward;
                                $pcp->save();
                            }
                        }
                        $child->save();

                        if($row['pair'] === 1) {
                            $pairing = "Pairing bonus level ".$level." ".$persen."% of ";
                            if(substr($network, -2) == 'ki'){
                                if($row['left'] - $data->member->contract_price < $row['right']){
                                    $reward = 0;
                                    if($row['left'] > $row['right']){
                                        $reward = $row['right'] - $row['left'] + $data->member->contract_price;
                                    }else{
                                        $reward = $data->member->contract_price;
                                    }
                                    array_push($bonus,[
                                        'description' => $pairing.number_format($reward, 2)." by ".$data->member->username,
                                        'type' => "Turnover Growth",
                                        'debit' => 0,
                                        'credit' => $reward * $persen /100,
                                        'id_member' => $row['id'],
                                        'created_at' => Carbon::now(),
                                        'updated_at' => Carbon::now()
                                    ]);
                                }
                            }else if(substr($network, -2) == 'ka'){
                                if($row['right'] - $data->member->contract_price < $row['left']){
                                    $reward = 0;
                                    if($row['right'] > $row['left']){
                                        $reward = $row['left'] - $row['right'] + $data->member->contract_price;
                                    }else{
                                        $reward = $data->member->contract_price;
                                    }
                                    array_push($bonus,[
                                        'description' => $pairing.number_format($reward, 2)." by ".$data->member->username,
                                        'type' => "Turnover Growth",
                                        'debit' => 0,
                                        'credit' => $reward * $persen /100,
                                        'id_member' => $row['id'],
                                        'created_at' => Carbon::now(),
                                        'updated_at' => Carbon::now()
                                    ]);
                                }
                            }
                        }
                    }
                    if ($row['due_date']) {
                        array_push($invalid_turnover,[
                            'id_member' => $row['id'],
                            'from_member' => $data->id_member,
                            'amount' => $data->member->contract_price,
                            'position' => substr($network, -2) == "ka"? 1: 0
                        ]);
                    }
                    $persen = $persen / 2;
                    $parent_length = strlen($row['id'].($row['position'] == 0? 'ki': 'ka'));
                    $network = substr($network, 0, (strlen($network) - $parent_length));
                    $level++;
                    if ($level === 7) {
                        break;
                    }
                }
                $data_invalid_turnover = collect($invalid_turnover)->chunk(10);
                foreach ($data_invalid_turnover as $item)
                {
                    InvalidTurnover::insert($item->toArray());
                }
            }

            $data_bonus = collect($bonus)->chunk(10);
            foreach ($data_bonus as $item)
            {
                Bonus::insert($item->toArray());
            }
        });
        $this->key = null;
    }

    public function render()
    {
        $data = \App\Models\Deposit::with('member')->orderBy('created_at')->whereNotNull('file')->whereNotNull('information');
        if ($this->proccess == 1) {
            $data = $data->whereNotNull('processed_at')->whereNotNull('id_user');
        } else {
            $data = $data->whereNull('processed_at')->whereNull('id_user');
        }

        $data = $data->paginate(10);
        return view('livewire.administrator.deposit', [
            'data' => $data,
            'no' => ($this->page - 1) * 10,
            'menu' => 'deposit'
        ])->extends('layouts.default');
    }
}
