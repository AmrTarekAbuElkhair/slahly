<?php
namespace App\Http\Eloquent\Mobile\Provider;
use App\Http\Interfaces\Mobile\Provider\AuthRepositoryInterface;
use App\Models\User;
use App\Models\Verification;

class AuthRepository implements AuthRepositoryInterface
{
    protected $user_Ob;
    protected $verification_Ob;
    public function __construct(User $user,Verification $verification)
    {
        $this->user_Ob=$user;
        $this->verification_Ob=$verification;
    }
    public function sendVerificationCode($request)
    {
        $providertoverify=$this->user_Ob->whereMobile($request->mobile)->where('type_id','!=',null)->first();
        if (isset($providertoverify)){
            $providertoverify->verified_status=0;
            $providertoverify->save();
            $this->verification_Ob->user_id=$providertoverify->id;
            $digits = 5;
            $code=rand(pow(10, $digits-1), pow(10, $digits)-1);
            $this->verification_Ob->code= $code;
            $this->verification_Ob->save();
//            $data = array('name'=>$usertoverify->users_name,'code'=>$code);
//
//            Mail::send('mail', $data, function($message)use($usertoverify) {
//                $message->to($usertoverify->email)->subject
//                ('Verification Code');
//                $message->from('info@pariseast.net','Pariseast Application');
//            });
            return 'code_sent';
        }else{
            return "user_not_found";
        }
    }

    public function verifyCode($request)
    {
        $verificationcode=$this->verification_Ob->whereCode($request->code)->first();
        if (isset($verificationcode)){
            $providertoverify=$this->user_Ob->whereId($verificationcode->user_id)->first();
            if($providertoverify->verified_status == 0){
                $verificationcode->delete();
                $providertoverify->verified_status=1;
                $providertoverify->save();
                return  $providertoverify;
            }else{
                $verificationcode->delete();
                return 'provider_already_verified';}
        }else{return 'invalid_code';}

    }
}
