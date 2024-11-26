<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('dashboard.admin.AdminHome');
            } elseif (Auth::user()->role == 'seller') {
                $store = Auth::user()->store;
                $productCount = $store->products()->count();
                $orderCount = Order::whereHas('orderDetails.product.store', function ($query) {
                    $query->where('user_id', Auth::id());
                })->count();
                $totalRevenue = Order::whereHas('orderDetails.product.store', function ($query) {
                    $query->where('user_id', Auth::id());
                })->sum('total_amount');

                $ordersPerDay = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                    ->whereHas('orderDetails.product.store', function ($query) {
                        $query->where('user_id', Auth::id());
                    })
                    ->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->get();

                return view('dashboard.seller.Home', compact('productCount', 'orderCount', 'totalRevenue', 'ordersPerDay'));
            }
            $products = Product::all();
            $categories = Product::select('category')->distinct()->pluck('category');
            $recommendedProducts = Product::inRandomOrder()->take(3)->get();
            return view('dashboard.buyer.home', compact('products', 'categories', 'recommendedProducts'));
        } else {
            return redirect('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $categories = $request->input('categories', []);
        $products = Product::where(function ($q) use ($query, $categories) {
            if ($categories) {
                $q->whereIn('category', $categories);
            }
            $q->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            });
        })->get();
        $categories = Product::select('category')->distinct()->pluck('category');
        $recommendedProducts = Product::inRandomOrder()->take(3)->get();
        
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('dashboard.admin.Home', compact('products', 'categories', 'recommendedProducts'));
        }
        return view('dashboard.buyer.home', compact('products', 'categories', 'recommendedProducts'));
    }

    public function filter(Request $request)
    {
        $categories = $request->input('categories', []);
        $query = $request->input('query');
        $products = Product::whereIn('category', $categories)
                            ->when($query, function ($q) use ($query) {
                                $q->where('name', 'LIKE', "%{$query}%")
                                  ->orWhere('description', 'LIKE', "%{$query}%");
                            })
                            ->get();
        $categories = Product::select('category')->distinct()->pluck('category');
        $recommendedProducts = Product::inRandomOrder()->take(3)->get();
        
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('dashboard.admin.Home', compact('products', 'categories', 'recommendedProducts'));
        }
        return view('dashboard.buyer.home', compact('products', 'categories', 'recommendedProducts'));
    }

    public function welcomeSearch(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        $products = Product::where(function ($q) use ($query, $category) {
            if ($category) {
                $q->where('category', $category);
            }
            $q->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            });
        })->get();
        $categories = Product::select('category')->distinct()->pluck('category');
        $recommendedProducts = Product::inRandomOrder()->take(3)->get();
        return view('welcome', compact('products', 'categories', 'recommendedProducts'));
    }

    public function welcomeFilter(Request $request)
    {
        $category = $request->input('category');
        $query = $request->input('query');
        $products = Product::where('category', $category)
                            ->when($query, function ($q) use ($query) {
                                $q->where('name', 'LIKE', "%{$query}%")
                                  ->orWhere('description', 'LIKE', "%{$query}%");
                            })
                            ->get();
        $categories = Product::select('category')->distinct()->pluck('category');
        $recommendedProducts = Product::inRandomOrder()->take(3)->get();
        return view('welcome', compact('products', 'categories', 'recommendedProducts'));
    }
}
