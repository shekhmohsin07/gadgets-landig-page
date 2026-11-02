<div class="col">
    <article class="product-card h-100">
        @if($p->badge)
            <span class="p-badge">{{ $p->badge }}</span>
        @endif
        <a href="{{ route('product.show', $p) }}" class="p-img">
            <img src="{{ $p->image_url }}" alt="{{ $p->name }}" loading="lazy">
        </a>
        <div class="p-body">
            <h3 class="p-title"><a href="{{ route('product.show', $p) }}">{{ $p->name }}</a></h3>
<<<<<<< HEAD
            <div class="p-price-row">
                <div class="p-price">
                    <strong>৳{{ number_format($p->price) }}</strong>
                    @if($p->old_price)<del>৳{{ number_format($p->old_price) }}</del>@endif
                </div>
                @if($p->save_amount > 0)
                    <span class="save-pill">Save ৳{{ number_format($p->save_amount) }}</span>
                @endif
            </div>
            <a href="{{ route('product.show', $p) }}" class="btn btn-brand w-100">
=======
            <div class="p-price">
                <strong>৳{{ number_format($p->price) }}</strong>
                @if($p->old_price)<del>৳{{ number_format($p->old_price) }}</del>@endif
            </div>
            @if($p->save_amount > 0)
                <span class="save-pill">Save ৳{{ number_format($p->save_amount) }}</span>
            @endif
            <a href="{{ route('product.show', $p) }}" class="btn btn-brand w-100 mt-2">
>>>>>>> affbddf8f8d532a5bdffe687b4b6384364a50c38
                <i class="bi bi-cart3"></i> Buy Now
            </a>
        </div>
    </article>
</div>
