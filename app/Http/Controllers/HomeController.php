<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'banners'      => Banner::where('is_active', true)->orderBy('sort_order')->orderBy('id')->get(),
            'topSelling'   => Product::active()->where('is_top_selling', true)->ordered()->get(),
            'popular'      => Product::active()->where('is_popular', true)->ordered()->get(),
            'testimonials' => Testimonial::where('is_active', true)->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function search(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $products = Product::active()
            ->when($q !== '', fn ($query) => $query->where('name', 'like', '%' . $q . '%'))
            ->ordered()
            ->paginate(12)
            ->withQueryString();

        return view('search', compact('q', 'products'));
    }
}
