<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentRating;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CommentRatingController extends Controller
{

    //memberikan rating dan comment pada semua product yang sudah di beli, jika ada 2 produk pada satu order, akan melakukan perulangan dan memberikan rating dan comment pada kedua produk tersebut
    public function store(Request $request, $orderId)
    {
        $request->validate([
            'comments' => 'required|array',
            'comments.*.comment' => 'required|string|max:1000',
            'comments.*.rating' => 'required|numeric|min:1|max:5',
        ]);

        foreach ($request->comments as $productId => $commentData) {
            CommentRating::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'comment' => $commentData['comment'],
                'rating' => $commentData['rating'],
            ]);
        }

        return redirect()->back()->with('success', 'Comments and ratings added successfully.');
    }
}
