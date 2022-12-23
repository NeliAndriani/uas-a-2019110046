<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function order()
    {

        $orders = Order::all();

        return view('indexorder', compact('orders'));
    }

    public function orderCreate()
    {

        $menus = Menu::all();

        return view('order', compact('menus'));
    }

    public function orderStore(Request $request)
    {

        $order = Order::create([
            'status' => $request->status
        ]);

        $menus = $request->menus;
        $quantities = $request->quantities;

        for ($i = 0; $i < count($menus); $i++) {
            $order->menus()->attach($menus[$i], ['quantity' => $quantities[$i]]);
        }

        return redirect()->route('orderView')->with('success', 'Order created successfully.');
    }

}
