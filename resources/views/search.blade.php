@extends('layouts.app')

@section('title', ($q !== '' ? $q . ' — ' : '') . 'সব পণ্য | ' . $settings['site_name'])

@section('content')
<div class="container-xl pt-3">
    <form action="{{ route('search') }}" method="get" class="mb-3">
        <div class="input-group">
            <input type="search" name="q" class="form-control" placeholder="পণ্য খুঁজুন..." value="{{ $q }}">
            <button class="btn btn-brand" type="submit"><i class="bi bi-search"></i> Search</button>
        </div>
    </form>

    <h2 class="section-title mt-2">{{ $q !== '' ? '"' . $q . '" এর ফলাফল' : 'সব পণ্য' }}</h2>

    @if($products->count())
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-3">
            @foreach($products as $p)
                @include('partials.product-card', ['p' => $p])
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">{{ $products->links() }}</div>
    @else
        <p class="text-center text-muted py-5">কোনো পণ্য পাওয়া যায়নি।</p>
    @endif
</div>
@endsection
