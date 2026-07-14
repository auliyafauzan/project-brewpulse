<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::latest()->get();

        $stats = [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'revenue' => Order::where('status', 'completed')->sum('total_amount'),
        ];

        return view('orders.index', compact('orders', 'stats'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'items' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $orderNumber = '#BP-' . rand(1000, 9999);
        $itemsArray = array_values(array_filter(array_map('trim', explode(',', $request->items))));

        Order::create([
            'order_number' => $orderNumber,
            'customer_name' => $request->customer_name,
            'location' => $request->location,
            'items' => $itemsArray,
            'total_amount' => $request->total_amount,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan baru berhasil ditambahkan!');
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('orders.index')->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}