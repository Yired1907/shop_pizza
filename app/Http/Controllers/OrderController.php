<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate();
        return view('admin.order.index', compact('orders'));
    }

    public function filter()
    {
        $status = request('status', 1);
        $orders = Order::orderBy('id', 'DESC')->where('status', $status)->paginate();
        return view('admin.order.filter', compact('orders'));
    }

    public function show(Order $order)
    {
        $auth = $order->customer;
        return view('admin.order.detail', compact('auth', 'order'));
    }

    public function update(Order $order)
    {
        $status = request('status', 1);
        $order->update(['status' => $status]);
        if ($order->status != 2) {
            $order->update(['status' > $status]);
            return redirect()->route('order.index')->with('ok', 'Status updated successfully');
        }
        return redirect()->route('order.index')->with('nno', 'Update fail');
    }
}
