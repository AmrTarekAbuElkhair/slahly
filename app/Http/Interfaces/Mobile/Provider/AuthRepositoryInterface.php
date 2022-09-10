<?php
namespace App\Http\Interfaces\Mobile\Provider;
interface AuthRepositoryInterface
{
    public function sendVerificationCode($request);

    public function verifyCode($request);
}
