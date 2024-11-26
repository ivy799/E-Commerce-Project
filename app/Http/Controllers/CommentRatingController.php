<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentRating;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CommentRatingController extends Controller
{
    public function store(Request $request, $orderId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $order = Order::findOrFail($orderId);
        foreach ($order->orderDetails as $detail) {
            CommentRating::create([
                'user_id' => Auth::id(),
                'product_id' => $detail->product_id,
                'comment' => $request->comment,
                'rating' => $request->rating,
            ]);
        }

        return redirect()->back()->with('success', 'Comment and rating added successfully.');
    }
}
