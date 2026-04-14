<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->with(['category', 'images'])
            ->when($request->filled('category_id'), fn ($q) => $q->where('category_id', $request->integer('category_id')))
            ->when($request->filled('status'), function ($q) use ($request): void {
                $s = $request->string('status')->toString();
                if (in_array($s, [Product::STATUS_ACTIVE, Product::STATUS_PENDING], true)) {
                    $q->where('status', $s);
                }
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $filterCategories = Category::query()->orderBy('name')->get();

        return view('admin.products.index', compact('products', 'filterCategories'));
    }

    public function show(Product $product): View
    {
        $product->load(['category', 'images']);

        return view('admin.products.show', compact('product'));
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
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'status' => ['required', Rule::in([Product::STATUS_ACTIVE, Product::STATUS_PENDING])],
            'images' => ['required'],
            'images.*' => ['image', 'max:4096'],
        ]);

        $imageFiles = $this->validUploadedImages($request);
        if (count($imageFiles) < 1) {
            return back()
                ->withInput()
                ->withErrors(['images' => __('Upload at least one valid image. If you selected several, try again or reduce file size (max 4 MB each).')]);
        }

        $product = Product::query()->create([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'phone_number' => $data['phone_number'],
            'price' => $data['price'],
            'status' => $data['status'],
        ]);

        foreach ($imageFiles as $index => $file) {
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
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'status' => ['required', Rule::in([Product::STATUS_ACTIVE, Product::STATUS_PENDING])],
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
            'price' => $data['price'],
            'status' => $data['status'],
        ]);

        $removeIds = array_values(array_filter($data['remove_image_ids'] ?? []));
        if ($removeIds !== []) {
            ProductImage::query()
                ->where('product_id', $product->id)
                ->whereIn('id', $removeIds)
                ->get()
                ->each(fn (ProductImage $img) => $img->delete());
        }

        $newImages = $this->validUploadedImages($request);
        if ($newImages !== []) {
            $maxSort = (int) $product->images()->max('sort_order');
            foreach ($newImages as $index => $file) {
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

    /**
     * @return list<UploadedFile>
     */
    private function validUploadedImages(Request $request): array
    {
        $raw = $request->file('images');
        $files = Arr::wrap($raw);

        return array_values(array_filter(
            $files,
            fn ($f) => $f instanceof UploadedFile && $f->isValid()
        ));
    }
}
