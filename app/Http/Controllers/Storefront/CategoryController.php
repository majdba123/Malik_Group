<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(Request $request, Category $category): View
    {
        $products = Product::query()
            ->active()
            ->with(['category', 'images'])
            ->filterCatalog($request, $category->id)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('storefront.category', compact('category', 'products'));
    }
}
