<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Honeypot: real visitors never fill this hidden field.
        if ($request->filled('website')) {
            return redirect()->route('home');
        }

        $data = $request->validate([
            'product_id'    => ['required', 'integer', 'exists:products,id'],
            'customer_name' => ['required', 'string', 'max:120'],
            'phone'         => ['required', 'regex:/^(?:\+?88)?01[3-9]\d{8}$/'],
            'district'      => ['nullable', 'string', 'max:80'],
            'thana'         => ['nullable', 'string', 'max:80'],
            'address'       => ['required', 'string', 'max:500'],
            'delivery_zone' => ['required', 'in:inside,outside'],
            'quantity'      => ['required', 'integer', 'min:1', 'max:10'],
        ], [
            'customer_name.required' => 'আপনার নাম লিখুন',
            'phone.required'         => 'মোবাইল নাম্বার লিখুন',
            'phone.regex'            => 'সঠিক ১১ ডিজিটের মোবাইল নাম্বার দিন (যেমন 01XXXXXXXXX)',
            'address.required'       => 'ডেলিভারি ঠিকানা লিখুন',
        ]);

        $product = Product::active()->findOrFail($data['product_id']);

        // Prices are always calculated on the server, never trusted from the browser.
        $fee = (int) Setting::get('delivery_' . $data['delivery_zone'], 0);
        $qty = (int) $data['quantity'];

        $order = Order::create([
            'order_number'  => Order::newNumber(),
            'product_id'    => $product->id,
            'product_name'  => $product->name,
            'unit_price'    => $product->price,
            'quantity'      => $qty,
            'delivery_zone' => $data['delivery_zone'],
            'delivery_fee'  => $fee,
            'total'         => $product->price * $qty + $fee,
            'customer_name' => $data['customer_name'],
            'phone'         => preg_replace('/^\+?88/', '', $data['phone']),
            'district'      => $data['district'] ?? null,
            'thana'         => $data['thana'] ?? null,
            'address'       => $data['address'],
            'status'        => 'pending',
            'ip_address'    => $request->ip(),
        ]);

        return redirect()->route('order.thanks', $order->order_number);
    }

    public function thanks(string $number)
    {
        $order = Order::where('order_number', $number)->firstOrFail();

        return view('thanks', compact('order'));
    }
}
