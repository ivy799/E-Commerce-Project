<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $products = Product::all();
                $userCount = User::count();
                return view('dashboard.admin.Home', compact('userCount', 'products'));
            } elseif (Auth::user()->role == 'seller') {
                $store = Auth::user()->store;
                $productCount = $store->products()->count();
                $orderCount = Order::whereHas('orderDetails.product.store', function ($query) {
                    $query->where('user_id', Auth::id());
                })->count();
                return view('dashboard.seller.Home', compact('productCount', 'orderCount'));
            }
            $products = Product::all();
            return view('dashboard.buyer.home', compact('products'));
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
}
