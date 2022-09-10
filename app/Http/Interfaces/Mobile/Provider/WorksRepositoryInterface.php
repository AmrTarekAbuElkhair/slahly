<?php
namespace App\Http\Interfaces\Mobile\Provider;
interface WorksRepositoryInterface
{
    public function getWorks($provider);

    public function storeWorks($provider,$request);

    public function deleteWork($provider,$work_id);

}
