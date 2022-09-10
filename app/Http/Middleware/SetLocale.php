<?php

namespace App\Http\Middleware;
use Illuminate\Foundation\Application;
use Closure;
use Session;
use Auth;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;

    }

    public function handle($request, Closure $next)
    {
        $lang=Session()->get('lang');
//        dd($lang);
        /*$lang='ar';
        dd($lang);*/
        if(isset($lang)){
            Session::put('lang',$lang);
            app()->setLocale($lang);
        }else{
            Session::put('lang','ar');
            $this->app->setLocale($lang);
        }
        //dd(Session::get('lang'));
        return $next($request);
    }
}
