<?php
namespace App\Http\Interfaces\Mobile\User;
interface BookingRepositoryInterface
{
    public function getHome($lang,$user);

    public function getAllProvidersService($service_id,$request,$user);

    public function providerData($provider,$user,$lang);

    public function getFavoriteList($user);

    public function AddFavorite($user,$worker_id);

    public function deleteFav($user,$fav_id);

    public function createOrder($request);

    public function getOrderDetails($order_id,$lang);

    public function getOrders($user,$lang);

    public function rateOrder($request);

    public function cancelOrder($request);

    public function getWallet($user,$lang);

    public function withdraw($request);

    public function finishOrder($request,$lang);

    public function summary($order_id,$lang);

    public function checkout($request);
}
