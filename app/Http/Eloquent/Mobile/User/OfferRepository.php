<?php
namespace App\Http\Eloquent\Mobile\User;

use App\Http\Interfaces\Mobile\User\OfferRepositoryInterface;
use App\Models\Description;
use App\Models\Offer;
use App\Models\package;
use App\Models\PackageCompany;
use App\Models\packageTranslation;
use App\Models\ProviderOffer;
use App\Models\User;


class OfferRepository implements OfferRepositoryInterface
{
    protected $offer_Ob;

    public function __construct(Offer $offer)
    {
        $this->offer_Ob = $offer;
    }
    public function getOffers($lang)
    {
        $getWorkersOffers=ProviderOffer::where('worker_id','!=',null)->pluck('offer_id');
        $moffers = Offer::whereIn('id',$getWorkersOffers)->where('status','1')->
        where('package_id','!=',null)->
        get();
        $allmoffers = array();
        $i = 0;
        foreach ($moffers as $moffer) {
            $allmoffers[$i] = array(
                'id'=>$moffer->id,
                'image'=>$moffer->image,
                'percentage'=>$moffer->percentage,
                'price_before_sale'=>$moffer->price_before_sale,
                'price_after_sale'=>$moffer->price_after_sale,
                'service_id'=>$moffer->service_id,
            );
            $i++;
        }

        $getCompaniesOffers=ProviderOffer::where('company_id','!=',null)->pluck('offer_id');
        $coffers = Offer::whereIn('id',$getCompaniesOffers)->where('status','1')
            ->where('package_id','!=',null)
            ->get();
        $allcoffers = array();
        $i = 0;
        foreach ($coffers as $coffer) {
            $allcoffers[$i] = array(
                'id'=>$coffer->id,
                'image'=>$coffer->image,
                'percentage'=>$coffer->percentage,
                'price_before_sale'=>$coffer->price_before_sale,
                'price_after_sale'=>$coffer->price_after_sale,
                'package_id'=>$coffer->package_id,
                'package_name'=>packageTranslation::where('package_id',$coffer->package_id)->where('locale',$lang)->first()->name,
            );
            $i++;
        }

        $data=[
            'maintenance'=>$allmoffers,
            'comany_offers'=>$allcoffers,
            ];
        return $data;
    }

    public function offerData($offer_id,$lang)
    {
        $getc=ProviderOffer::where('offer_id',$offer_id)->where('company_id','!=',null)->pluck('company_id');
        $getp=ProviderOffer::where('offer_id',$offer_id)->where('worker_id','!=',null)->pluck('worker_id');
        $providers=User::whereIn('id',$getc)
            ->orWhereIn('id',$getp)
            ->select('id','name','image','rate')->get();
        $data=[
            'implementation_providers'=>$providers
        ];
        return $data;
    }
}
