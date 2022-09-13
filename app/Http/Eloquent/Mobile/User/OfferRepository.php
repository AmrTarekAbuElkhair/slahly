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
        $providers=User::where('type_id','1')->pluck('id');
        $getWorkersOffers=ProviderOffer::whereIn('provider_id',$providers)->pluck('offer_id');
        $moffers = Offer::whereIn('id',$getWorkersOffers)->whereNull('package_id')->where('status','1')->get();
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

        $providers=User::where('type_id','2')->pluck('id');
        $getCompaniesOffers=ProviderOffer::whereIn('provider_id',$providers)->pluck('offer_id');
        $coffers = Offer::whereIn('id',$getCompaniesOffers)->whereNotNull('package_id')->where('status','1')->get();
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
        $getProvider=ProviderOffer::where('offer_id',$offer_id)->pluck('provider_id');
        $providers=User::whereIn('id',$getProvider)
            ->select('id','name','image','rate')->get();
        $data=[
            'implementation_providers'=>$providers
        ];
        return $data;
    }
}
