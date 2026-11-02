<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;

class ProductController extends Controller
{
    /** Each product has its own landing page: /product/{slug} */
    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);

        $related = Product::active()->where('id', '!=', $product->id)->ordered()->take(4)->get();
        $topSelling = Product::active()->where('id', '!=', $product->id)->where('is_top_selling', true)->ordered()->take(4)->get();

        $waText = rawurlencode('আমি "' . $product->name . '" অর্ডার করতে চাই।');
        $waLink = Setting::whatsappNumber() !== ''
            ? 'https://wa.me/' . Setting::whatsappNumber() . '?text=' . $waText
            : null;

        return view('product', [
            'product'    => $product,
            'related'    => $related,
            'topSelling' => $topSelling,
            'waLink'     => $waLink,
            'fees'       => [
                'inside'  => (int) Setting::get('delivery_inside', 0),
                'outside' => (int) Setting::get('delivery_outside', 0),
            ],
        ]);
    }
}
