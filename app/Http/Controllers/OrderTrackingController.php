<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function index()
    {
        return view('track-order', ['order' => null]);
    }

    public function track(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
        ]);

        $order = Order::where(
            'order_number',
            $request->order_number
        )->first();

        if (
            !$order ||
            $this->normalizePhone($order->phone) !==
            $this->normalizePhone($request->phone)
        ) {
            return back()
                ->withInput($request->only('order_number'))
                ->withErrors([
                    'tracking' => 'Order number or phone number is incorrect.'
                ]);
        }

        return view('track-order', compact('order'));
    }

    private function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/\D+/', '', $phone);

        if (str_starts_with($phone, '88')) {
            $phone = substr($phone, 2);
        }

        return $phone;
    }
}
