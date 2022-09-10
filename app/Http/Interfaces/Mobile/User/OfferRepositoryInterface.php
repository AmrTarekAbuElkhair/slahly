<?php
namespace App\Http\Interfaces\Mobile\User;

interface OfferRepositoryInterface
{
    public function getOffers($lang);

    public function offerData($offer_id,$lang);
}
