<?php

namespace App\Http\Interfaces\Mobile;
interface SettingsRepositoryInterface
{
    public function getAboutUs($lang);

    public function getTerms($lang);

    public function getUserPrivacy($lang);

    public function getProviderPrivacy($lang);

    public function getSocialMedia();

    public function getReasons($lang);

    public function getServices($lang);

    public function getCountries($lang);

    public function getProviderTypes($lang);

    public function insertContactForm($request);

    public function getAllNotifications($lang,$user);

    public function getInstructions($lang);

    public function config($user);
}
