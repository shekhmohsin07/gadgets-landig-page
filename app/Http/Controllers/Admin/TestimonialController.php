<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        return view('admin.testimonials.index', ['items' => Testimonial::orderBy('sort_order')->orderBy('id')->get()]);
    }

    public function create()
    {
        return view('admin.testimonials.form', ['item' => new Testimonial(['rating' => 5, 'is_active' => true])]);
    }

    public function store(Request $request)
    {
        Testimonial::create($this->validated($request));

        return redirect()->route('admin.testimonials.index')->with('success', 'Review added.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', ['item' => $testimonial]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $testimonial->update($this->validated($request));

        return redirect()->route('admin.testimonials.index')->with('success', 'Review updated.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Review deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:120'],
            'handle'     => ['nullable', 'string', 'max:120'],
            'message'    => ['required', 'string', 'max:1000'],
            'rating'     => ['required', 'integer', 'between:1,5'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
