<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Menampilkan daftar produk favorit milik user yang sedang login
     */
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->with('product')->get();
        return view('dashboard.buyer.favorite.index', compact('favorites'));
    }


    public function create()
    {
        //
    }

    /**
     * Menambahkan produk ke favorit, jika sudah ada maka tidak ditambahkan
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);


        $exists = Favorite::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            return redirect()->route('buyer.favorites.index')->with('info', 'Product is already in your favorites.');
        }

        // Tambahkan produk ke favorit jika belum ada
        Favorite::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('buyer.favorites.index')->with('success', 'Product added to favorites.');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Menghapus produk dari favorit
     */
    public function destroy(string $id)
    {
        $favorite = Favorite::where('user_id', Auth::id())->findOrFail($id);
        $favorite->delete();

        return redirect()->route('buyer.favorites.index')->with('success', 'Product removed from favorites.');
    }
}
