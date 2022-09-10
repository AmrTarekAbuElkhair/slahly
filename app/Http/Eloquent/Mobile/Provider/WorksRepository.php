<?php
namespace App\Http\Eloquent\Mobile\Provider;

use App\Http\Interfaces\Mobile\Provider\WorksRepositoryInterface;
use App\Models\User;
use App\Models\Work;
use Illuminate\Support\Facades\File;

class WorksRepository implements WorksRepositoryInterface
{
    protected $provider_Ob;

    public function __construct(User $provider)
    {
        $this->provider_Ob = $provider;
    }

    public function getWorks($provider)
    {
        $user=User::where('id',$provider)->first();
        $works=Work::where('worker_id',$user->id)->orderBy('id','desc')->get();
            $allworks = array();
            $i = 0;
            foreach ($works as $work) {
                $allworks[$i]['id'] = $work->id;
                $allworks[$i]['image'] = $work->image;
                $i++;
            }
            $data['all_works']=$allworks;

            return $data;
        }

        public function storeWorks($provider, $request)
        {
            $user=User::where('id',$provider)->first();
//            for ($i = 0; $i < sizeof($request->image); $i++) {
            foreach($request->file('image') as $img){
                Work::create(['image' => $img,
                    'worker_id' => $user->id,
                ]);
            }
        }

        public function deleteWork($provider, $work_id)
        {
            $find=Work::where('id',$work_id)->where('worker_id',$provider)->first();
            $find->delete();
        }
}
