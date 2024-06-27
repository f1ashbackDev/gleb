<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        Booking::create([
           'name' => $request->name,
           'email' => $request->email,
           'orderDate' => $request->orderDate,
           'peoples' => $request->peoples,
            'description' => $request->description
        ]);
        return redirect()->route('booking')->withErrors('Столик забронирован');
    }
}
