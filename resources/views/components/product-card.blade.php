<a href="{{ route('detail', ['id' => $product->id]) }}" class="col-6 col-md-3 px-1 py-1 text-decoration-none text-reset">
    <div class="card">
        <div class="product__img">
            <img src="{{ asset($product->image_path) }}" class="object-cover" alt="">
        </div>
        <div class="product__sale">
            <div>
                @if ($product->discount)
                    -{{ $product->discount }}%
                @else
                    Mới
                @endif
            </div>
        </div>
        <div class="card-body p-2">
            <p class="card-title">
                {{ $product->name }}
            </p>
            <div class="card-text">
                <p class="text-decoration-line-through mb-0">
                    {{ number_format($product->price, 0, ',', '.') }}
                    <span>₫</span>
                </p>
                <p>
                    {{ number_format($product->promotional_price, 0, ',', '.') }}
                    <span>₫</span>
                </p>
            </div>
        </div>
    </div>
</a>
