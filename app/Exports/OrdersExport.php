<?php

namespace App\Exports;

use App\Models\Booking;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class OrdersExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('pages.orders.exports', [
            'orders' => Order::whereNotNull('provider_id')->all()
        ]);
    }
}
