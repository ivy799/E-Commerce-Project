<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::where('user_id', Auth::user()->id)->get();
        return view('dashboard.seller.store.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.seller.store.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:2048',
        ]);

        $imagePath = $request->file('image')?->store('store_images', 'public');

        Store::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('seller.stores.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('dashboard.seller.store.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string|max:2048',
        ]);

        $store = Store::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($store->image) {
                Storage::disk('public')->delete($store->image);
            }
            // Store new image
            $imagePath = $request->file('image')->store('store_images', 'public');
            $store->image = $imagePath;
        }

        $store->update([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'image' => $store->image,
            'description' => $request->description,
        ]);

        return redirect()->route('seller.stores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        if ($store->image) {
            Storage::disk('public')->delete($store->image);
        }
        $store->delete();

        return redirect()->route('seller.stores.index');
    }
}