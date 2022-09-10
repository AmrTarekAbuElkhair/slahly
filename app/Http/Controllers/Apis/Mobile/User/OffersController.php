<?php

namespace App\Http\Controllers\Apis\Mobile\User;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Mobile\User\OfferRepositoryInterface;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    protected $offerObject;

    public function __construct(OfferRepositoryInterface $offerObject)
    {
        $this->offerObject= $offerObject;
    }
    public function getOffers(Request $request)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $result = $this->offerObject->getOffers($lang);
        return response(res($lang, success(), 200, 'all_offers', $result));
    }

    public function offerData(Request $request, $offer_id)
    {
        $lang = ($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        $result = $this->offerObject->offerData($offer_id,$lang);
        return response(res($lang, success(), 200, 'one_offer', $result));
    }

}
