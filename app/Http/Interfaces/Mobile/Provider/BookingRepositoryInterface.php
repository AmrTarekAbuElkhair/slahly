<?php
namespace App\Http\Interfaces\Mobile\Provider;
interface BookingRepositoryInterface
{
    public function getHome($lang,$provider);

    public function getOrders($lang,$provider);

    public function getOrder($order_id,$provider,$lang);

    public function getReviews($provider);

    public function acceptOrder($request);

    public function rejectOrder($request);

    public function rateOrder($request);

    public function getWallet($provider,$lang);

    public function withdraw($request);

    public function arrived($request,$lang);

    public function finishOrder($request,$lang);
}

