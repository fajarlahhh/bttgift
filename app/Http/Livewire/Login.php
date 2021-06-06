<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Member;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Lukeraymonddowning\Honey\Traits\WithRecaptcha;

class Login extends Component
{
    use WithRecaptcha;

    public $username, $password, $referral_token, $remember = false;
    public $message;

    protected $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        // if($this->recaptchaPasses() === false){
        //     $this->notification = [
        //         'tipe' => 'danger',
        //         'pesan' => '<li>Recaptcha Failed</li>'
        //     ];
        //     return;
        // }
        // $member = Member::where('username', $this->username)->get();
        // if($member){
        //     $member = $member->first();
        //     $wd_total = TransactionExchange::select('transaction_exchange_amount')->where('transaction_exchange_type', 'Reward')->where('member_id', $member->member_id)->get()->sum('transaction_exchange_amount');
        //     if(($member->contract_price * 3) - $wd_total < $member->contract->contract_reward_exchange_min){
        //         $member = Member::findOrFail($member->member_id);
        //         $member->due_date = Carbon::now()->addDays(5)->format('Y-m-d');
        //         $member->save();
        //     }
        // }else{
		// 	$this->notification = [
		// 		'tipe' => 'danger',
		// 		'pesan' => '<li><strong>Sign In notification!!!</strong><br>Wrong username or password</li>'
		// 	];
		// }

        $remember = $this->remember == 'on';
        if (Auth::attempt(['username' => $this->username, 'password' => $this->password], $remember)) {
            if (auth()->user()->registration_waiting->count() > 0) {
                $data = auth()->user()->registration_waiting->first();
                $until = Carbon::parse($data->created_at)->addHours(5);
                if($until > now()){
                    Member::findOrFail(auth()->id())->delete();
                    Auth::logout();
                    $this->message = "<p class='text-theme-6'>The username is not registered!!!</p>";
                    return;
                }
            }

            Auth::logoutOtherDevices($this->password, 'password');
            return redirect()->intended('dashboard');
        }
        $this->message = "<p class='text-theme-6'>Wrong username or password!!!</p>";
        return;
    }

    public function updated()
    {
        $this->reset('message');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
