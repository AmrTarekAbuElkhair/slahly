<?php
namespace App\Http\Interfaces\Mobile\User;

interface PackageRepositoryInterface
{
    public function getPackages($lang);

    public function packageData($package_id,$lang);

}
