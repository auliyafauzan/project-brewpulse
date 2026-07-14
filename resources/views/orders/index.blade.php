<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #f3f4f6;">
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Manajemen Pesanan</h3>
        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Lihat Produk</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mb-4">
        <div class="col-md-3"><div class="card p-3"><strong>Pending</strong><div>{{ $stats['pending'] }}</div></div></div>
        <div class="col-md-3"><div class="card p-3"><strong>Processing</strong><div>{{ $stats['processing'] }}</div></div></div>
        <div class="col-md-3"><div class="card p-3"><strong>Completed</strong><div>{{ $stats['completed'] }}</div></div></div>
        <div class="col-md-3"><div class="card p-3"><strong>Pendapatan</strong><div>Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</div></div></div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="customer_name" class="form-control" placeholder="Nama pelanggan" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="location" class="form-control" placeholder="Lokasi/Meja" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="items" class="form-control" placeholder="Item (pisahkan dengan koma)" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="total_amount" class="form-control" placeholder="Total" required>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No. Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Lokasi</th>
                        <th>Item</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->location }}</td>
                            <td>{{ implode($order->items ?? [], ', ') }}</td>
                            <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Hapus pesanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">Belum ada pesanan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
