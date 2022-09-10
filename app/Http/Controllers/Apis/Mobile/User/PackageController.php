<?php

namespace App\Http\Controllers\Apis\Mobile\User;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Mobile\User\PackageRepositoryInterface;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    protected $packageObject;

    public function __construct(PackageRepositoryInterface $packageObject)
    {
        $this->packageObject= $packageObject;
    }
    public function getPackages(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $result = $this->packageObject->getPackages($lang);
        return response(res($lang, success(), 200, 'all_packages', $result));
    }

    public function packageData(Request $request, $package_id)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $result = $this->packageObject->packageData($package_id,$lang);
        return response(res($lang, success(), 200, 'one_package', $result));
    }
}
