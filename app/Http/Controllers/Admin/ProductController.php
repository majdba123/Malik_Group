<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->with(['category', 'images'])
            ->latest()
            ->paginate(12);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'phone_number' => ['required', 'string', 'max:32'],
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['image', 'max:4096'],
        ]);

        $product = Product::query()->create([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'phone_number' => $data['phone_number'],
        ]);

        foreach ($request->file('images') as $index => $file) {
            $path = $file->store('products', 'public');
            $product->images()->create([
                'path' => $path,
                'sort_order' => $index,
            ]);
        }

        return redirect()->route('dashboard.products.index')->with('success', __('Product created.'));
    }

    public function edit(Product $product): View
    {
        $product->load('images');
        $categories = Category::query()->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'phone_number' => ['required', 'string', 'max:32'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'max:4096'],
            'remove_image_ids' => ['nullable', 'array'],
            'remove_image_ids.*' => ['integer', 'exists:product_images,id'],
        ]);

        $product->update([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'phone_number' => $data['phone_number'],
        ]);

        $removeIds = array_values(array_filter($data['remove_image_ids'] ?? []));
        if ($removeIds !== []) {
            ProductImage::query()
                ->where('product_id', $product->id)
                ->whereIn('id', $removeIds)
                ->get()
                ->each(fn (ProductImage $img) => $img->delete());
        }

        if ($request->hasFile('images')) {
            $maxSort = (int) $product->images()->max('sort_order');
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');
                $product->images()->create([
                    'path' => $path,
                    'sort_order' => $maxSort + $index + 1,
                ]);
            }
        }

        if ($product->images()->count() === 0) {
            return back()
                ->withInput()
                ->withErrors(['images' => __('A product must have at least one image. Add new images or keep an existing one.')]);
        }

        return redirect()->route('dashboard.products.index')->with('success', __('Product updated.'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->images()->get()->each(fn (ProductImage $img) => $img->delete());
        $product->delete();

        return redirect()->route('dashboard.products.index')->with('success', __('Product deleted.'));
    }
}
