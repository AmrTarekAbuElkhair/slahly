<?php

namespace App\Exports;

use App\Models\User;
use App\Models\ProviderBusinessInformation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ProvidersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('pages.providers.exports', [
            'providers' => User::all()
        ]);
    }
}
