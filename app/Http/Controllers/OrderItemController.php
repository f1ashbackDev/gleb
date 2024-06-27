<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function store($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $orderHistory = OrderItems::where('order_id', '=', $id)->with('product')->get();
        // хз пока
        $order = Order::find($id)->first();
        return view('user.order-items', [
            'history' => $orderHistory,
            'order' => $order
        ]);
    }
}
