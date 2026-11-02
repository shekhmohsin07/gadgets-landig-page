<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Support\Upload;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::ordered()->paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.products.form', ['product' => new Product(['rating' => 4.9, 'is_active' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Product::uniqueSlug($request->input('slug') ?: $data['name']);

        $data['image'] = $request->hasFile('image') ? Upload::image($request->file('image'), 'products') : null;
        $data['gallery'] = Upload::images($request->file('gallery', []), 'products');
        $data['review_images'] = Upload::images($request->file('review_images', []), 'reviews');

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created. Its landing page is ready.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request);
        $data['slug'] = Product::uniqueSlug($request->input('slug') ?: $data['name'], $product->id);

        if ($request->hasFile('image')) {
            Upload::delete($product->image);
            $data['image'] = Upload::image($request->file('image'), 'products');
        }

        $gallery = array_values(array_diff($product->gallery ?? [], $request->input('remove_gallery', [])));
        foreach ($request->input('remove_gallery', []) as $path) {
            Upload::delete($path);
        }
        $data['gallery'] = array_merge($gallery, Upload::images($request->file('gallery', []), 'products'));

        $reviews = array_values(array_diff($product->review_images ?? [], $request->input('remove_review_images', [])));
        foreach ($request->input('remove_review_images', []) as $path) {
            Upload::delete($path);
        }
        $data['review_images'] = array_merge($reviews, Upload::images($request->file('review_images', []), 'reviews'));

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        Upload::delete($product->image);
        foreach (array_merge($product->gallery ?? [], $product->review_images ?? []) as $path) {
            Upload::delete($path);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'slug'          => ['nullable', 'string', 'max:255'],
            'price'         => ['required', 'integer', 'min:1'],
            'old_price'     => ['nullable', 'integer', 'min:0'],
            'badge'         => ['nullable', 'string', 'max:40'],
            'description'   => ['nullable', 'string'],
            'rating'        => ['nullable', 'numeric', 'between:0,5'],
            'reviews_count' => ['nullable', 'integer', 'min:0'],
            'sort_order'    => ['nullable', 'integer'],
            'image'         => ['nullable', 'image', 'max:5120'],
            'gallery.*'     => ['nullable', 'image', 'max:5120'],
            'review_images.*' => ['nullable', 'image', 'max:5120'],
        ]);

        unset($data['image'], $data['gallery'], $data['review_images']);

        $data['old_price'] = ($data['old_price'] ?? null) ?: null;
        $data['rating'] = $data['rating'] ?? 4.9;
        $data['reviews_count'] = $data['reviews_count'] ?? 0;
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_top_selling'] = $request->boolean('is_top_selling');
        $data['is_popular'] = $request->boolean('is_popular');
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
