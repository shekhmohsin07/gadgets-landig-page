<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $q = trim((string) $request->query('q', ''));

        $orders = Order::query()
            ->when($status && isset(Order::STATUSES[$status]), fn ($query) => $query->where('status', $status))
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('order_number', 'like', "%$q%")
                        ->orWhere('phone', 'like', "%$q%")
                        ->orWhere('customer_name', 'like', "%$q%");
                });
            })
            ->latest()
            ->paginate(25)
            ->withQueryString();

        $counts = Order::selectRaw('status, COUNT(*) as c')->groupBy('status')->pluck('c', 'status');

        return view('admin.orders.index', compact('orders', 'status', 'q', 'counts'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', 'in:' . implode(',', array_keys(Order::STATUSES))],
            'note'   => ['nullable', 'string', 'max:1000'],
        ]);
        $order->update($data);

        return back()->with('success', 'Order updated.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted.');
    }
}
