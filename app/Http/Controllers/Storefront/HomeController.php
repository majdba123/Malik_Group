<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(Request $request): View
    {
        $categories = Category::query()
            ->withCount(['products' => fn ($q) => $q->where('status', Product::STATUS_ACTIVE)])
            ->orderBy('name')
            ->get();

        $featured = Product::query()
            ->active()
            ->with(['category', 'images'])
            ->latest()
            ->take(5)
            ->get();

        $products = Product::query()
            ->active()
            ->with(['category', 'images'])
            ->filterCatalog($request)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('storefront.home', compact('categories', 'featured', 'products'));
    }
}
