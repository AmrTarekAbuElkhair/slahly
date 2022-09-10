<?php
namespace App\Http\Eloquent\Mobile\User;

use App\Http\Interfaces\Mobile\User\PackageRepositoryInterface;
use App\Models\Description;
use App\Models\Package;
use App\Models\PackageCompany;
use App\Models\User;


class PackageRepository implements PackageRepositoryInterface
{
    protected $package_Ob;

    public function __construct(package $package)
    {
        $this->package_Ob = $package;
    }
    public function getPackages($lang)
    {
        $packages = Package::where('status','1')->get();
        $allpackages = array();
        $i = 0;
        foreach ($packages as $package) {
            $allpackages[$i] = array(
                'id'=>$package->id,
                'name' => $package->getTranslation($lang)->name,
                'image'=>$package->image,
            );
            $i++;
        }
        return $allpackages;
    }

    public function packageData($package_id,$lang)
    {
        $package=package::where('id',$package_id)->get();
        $res_item = [];
        $res_list  = [];
        foreach ($package as $p) {
            $res_item['id'] = $p->id;
            $res_item['name'] = $p->getTranslation($lang)->name;
            $res_item['image'] =$p->image;
            $res_item['price'] = $p->price;
            $getDescs=Description::where('package_id',$p->id)->get();
            $res_item['package_desc'] = $getDescs;
            $res_list[] = $res_item;
        }
           $getcompanies=PackageCompany::where('package_id',$package_id)->pluck('company_id');
           $companies=User::whereIn('id',$getcompanies)->where('type_id','2')->select('id','name','image','rate')->get();
        $data=[
            'package_details'=>$res_list,
            'implementation_companies'=>$companies
        ];
        return $data;
    }
}
