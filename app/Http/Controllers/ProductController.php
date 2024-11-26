<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $store = Store::where('user_id', Auth::id())->firstOrFail();
        $products = Product::where('store_id', $store->id)->get();
        return view('dashboard.seller.product.index', compact('products'));
    }

    public function create()
    {
        return view('dashboard.seller.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required',
        ]);

        $store = Store::where('user_id', Auth::id())->firstOrFail();
        $imagePath = $request->file('image')->store('product_images', 'public');

        $product = new Product($request->all());
        $product->store_id = $store->id;
        $product->image = $imagePath;
        $product->save();

        return redirect()->route('seller.products.index')
                         ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('dashboard.buyer.productDetails', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('dashboard.seller.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Store new image
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }

        $product->update($request->all());

        return redirect()->route('seller.products.index')
                         ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('seller.products.index')
                         ->with('success', 'Product deleted successfully.');
    }

    public function createOrder(Request $request)
    {
        $product = null;
        if ($request->has('product_id')) {
            $product = Product::findOrFail($request->input('product_id'));
        }
        $cartItems = []; // Initialize as an empty array
        // Add logic to populate $cartItems if needed
        return view('dashboard.buyer.order.create', compact('product', 'cartItems'));
    }

    public function welcome()
    {
        $products = Product::all();
        $categories = Product::select('category')->distinct()->pluck('category');
        $recommendedProducts = Product::inRandomOrder()->take(3)->get();
        return view('welcome', compact('products', 'categories', 'recommendedProducts'));
    }

    public function adminIndex()
    {
        $products = Product::all();
        return view('dashboard.admin.product.product', compact('products'));
    }

    public function adminDestroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted successfully.');
    }
}