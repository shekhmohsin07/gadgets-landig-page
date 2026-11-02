<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Support\Upload;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        return view('admin.banners.index', ['banners' => Banner::orderBy('sort_order')->orderBy('id')->get()]);
    }

    public function create()
    {
        return view('admin.banners.form', ['banner' => new Banner(['is_active' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);
        $data['image'] = Upload::image($request->file('image'), 'banners');
        Banner::create($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner added.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.form', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $this->validated($request, false);
        if ($request->hasFile('image')) {
            Upload::delete($banner->image);
            $data['image'] = Upload::image($request->file('image'), 'banners');
        }
        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated.');
    }

    public function destroy(Banner $banner)
    {
        Upload::delete($banner->image);
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted.');
    }

    private function validated(Request $request, bool $imageRequired): array
    {
        $data = $request->validate([
            'title'      => ['nullable', 'string', 'max:255'],
            'link'       => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'image'      => [$imageRequired ? 'required' : 'nullable', 'image', 'max:5120'],
        ]);
        unset($data['image']);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
