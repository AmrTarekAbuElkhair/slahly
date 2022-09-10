<?php
namespace App\Http\Interfaces\Mobile\User;
interface AuthRepositoryInterface
{
    public function sendVerificationCode($request);

    public function verifyCode($request);
}