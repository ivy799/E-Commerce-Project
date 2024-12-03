<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Menampilkan daftar item di cart milik user yang sedang login
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('dashboard.buyer.cart.index', compact('cartItems'));
    }


    public function create()
    {
        //
    }

    /**
     * Menambahkan item ke cart, jika sudah ada maka jumlahnya yang bertambah
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($cartItem) {
            $cartItem->amount += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'amount' => 1,
            ]);
        }

        return redirect()->route('buyer.cart.index')->with('success', 'Product added to cart.');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    /**
     * Mengupdate jumlah item di cart, sesuai jumlah inputan
     */
    public function update(Request $request, string $id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$cartItem || !$cartItem->product) {
            return redirect()->route('buyer.cart.index')->with('error', 'Item not found or product is missing.');
        }

        $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        $cartItem->update(['amount' => $request->amount]);

        return redirect()->route('buyer.cart.index')->with('success', 'Cart updated successfully.');
    }

    /**
     * Menghapus item dari cart
     */
    public function destroy(string $id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$cartItem) {
            return redirect()->route('buyer.cart.index')->with('error', 'Item not found.');
        }

        $cartItem->delete();

        return redirect()->route('buyer.cart.index')->with('success', 'Item removed from cart.');
    }
}
