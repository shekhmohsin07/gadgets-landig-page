@extends('admin.layout')
@php $isEdit = $product->exists; @endphp
@section('title', $isEdit ? 'Edit product' : 'New product')
@section('content')
<h1 class="h4 fw-bold mb-3">{{ $isEdit ? 'Edit product / landing page' : 'New product / landing page' }}</h1>

<form method="post" enctype="multipart/form-data"
      action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card mb-3"><div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Product name *</label>
                    <input name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Price (৳) *</label>
                        <input type="number" name="price" min="1" class="form-control" value="{{ old('price', $product->price) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Old price (৳)</label>
                        <input type="number" name="old_price" min="0" class="form-control" value="{{ old('old_price', $product->old_price) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Badge</label>
                        <input name="badge" class="form-control" placeholder="Best Selling / Hot Deal" value="{{ old('badge', $product->badge) }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Landing page description</label>
                    <textarea name="description" rows="10" class="form-control" placeholder="Bengali or English. New lines are kept. Use ✅ for feature lists.">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Rating (0–5)</label>
                        <input type="number" step="0.1" min="0" max="5" name="rating" class="form-control" value="{{ old('rating', $product->rating) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Reviews count</label>
                        <input type="number" min="0" name="reviews_count" class="form-control" value="{{ old('reviews_count', $product->reviews_count ?? 0) }}">
                        <div class="form-text">Rating shows only when this is above 0.</div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Sort order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $product->sort_order ?? 0) }}">
                    </div>
                </div>
            </div></div>

            <div class="card mb-3"><div class="card-body">
                <h2 class="h6 fw-bold">Images</h2>
                <div class="mb-3">
                    <label class="form-label">Main image (shown on home page + first slide)</label>
                    @if($isEdit && $product->image)<div class="mb-2"><img src="{{ $product->image_url }}" class="thumb" style="width:90px;height:90px" alt=""></div>@endif
                    <input type="file" name="image" accept="image/*" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">More gallery images (slider on the landing page)</label>
                    @if($isEdit && count($product->gallery ?? []))
                        <div class="d-flex flex-wrap gap-3 mb-2">
                            @foreach($product->gallery as $path)
                                <label class="text-center small">
                                    <img src="{{ \App\Models\Product::url($path) }}" class="thumb d-block mb-1" alt="">
                                    <input type="checkbox" name="remove_gallery[]" value="{{ $path }}"> remove
                                </label>
                            @endforeach
                        </div>
                    @endif
                    <input type="file" name="gallery[]" accept="image/*" multiple class="form-control">
                </div>
                <div>
                    <label class="form-label">Customer review screenshots (scroll strip under the description)</label>
                    @if($isEdit && count($product->review_images ?? []))
                        <div class="d-flex flex-wrap gap-3 mb-2">
                            @foreach($product->review_images as $path)
                                <label class="text-center small">
                                    <img src="{{ \App\Models\Product::url($path) }}" class="thumb d-block mb-1" alt="">
                                    <input type="checkbox" name="remove_review_images[]" value="{{ $path }}"> remove
                                </label>
                            @endforeach
                        </div>
                    @endif
                    <input type="file" name="review_images[]" accept="image/*" multiple class="form-control">
                    <div class="form-text">Only upload real screenshots from real customers. The section is hidden when empty.</div>
                </div>
            </div></div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-3"><div class="card-body">
                <h2 class="h6 fw-bold">Publishing</h2>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $product->is_active ?? true))>
                    <label class="form-check-label" for="is_active">Active (visible)</label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_top_selling" value="1" id="top" @checked(old('is_top_selling', $product->is_top_selling))>
                    <label class="form-check-label" for="top">Show in “Top Selling Products”</label>
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_popular" value="1" id="pop" @checked(old('is_popular', $product->is_popular))>
                    <label class="form-check-label" for="pop">Show in “Popular Products”</label>
                </div>
                <label class="form-label">Page URL slug</label>
                <input name="slug" class="form-control" placeholder="auto from name" value="{{ old('slug', $product->slug) }}">
                <div class="form-text">Use English letters, e.g. <code>scalp-massager</code>.</div>
            </div></div>
            <button class="btn btn-brand w-100 mb-2">{{ $isEdit ? 'Save changes' : 'Create product' }}</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary w-100">Cancel</a>
        </div>
    </div>
</form>
@endsection
