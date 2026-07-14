<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #f3f4f6;">
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-4">Detail Produk</h3>
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded" alt="{{ $product->title }}">
                    @else
                        <div class="alert alert-secondary">Tidak ada gambar</div>
                    @endif
                </div>
                <div class="col-md-8">
                    <h4>{{ $product->title }}</h4>
                    <p class="text-muted">{{ $product->description }}</p>
                    <p><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p><strong>Stok:</strong> {{ $product->stock }}</p>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
