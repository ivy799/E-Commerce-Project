<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product; // Add this line
use Illuminate\Support\Facades\Auth;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    $cartItems = collect();

    // Pastikan `cart_items` selalu berupa array
    $cartItemsInput = is_array($request->cart_items) 
        ? $request->cart_items 
        : (is_string($request->cart_items) ? explode(',', $request->cart_items) : []);

    // Jika parameter kosong atau invalid
    if (empty($cartItemsInput)) {
        return redirect()->route('buyer.cart.index')->with('error', 'No items selected for checkout.');
    }

    // Ambil produk berdasarkan ID dari `cart_items`
    $products = Product::whereIn('id', $cartItemsInput)->get();

    // Buat $cartItems dari produk
    $cartItems = $products->map(function ($product) {
        return (object)[
            'id' => null, // Jika tidak berasal dari keranjang
            'product_id' => $product->id,
            'amount' => 1, // Default jumlah untuk pembelian langsung
            'product' => $product,
        ];
    });

    // Ambil item dari keranjang jika ada
    $cartItemsFromCart = Cart::whereIn('id', $cartItemsInput)
        ->where('user_id', Auth::id())
        ->with('product')
        ->get();

    // Gabungkan semua item
    $cartItems = $cartItems->merge($cartItemsFromCart);

    if ($cartItems->isEmpty()) {
        return redirect()->route('buyer.cart.index')->with('error', 'No items selected for checkout.');
    }

    return view('dashboard.buyer.order.create', compact('cartItems'));
}




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'type' => 'required|string|max:255',
            'buy_method' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'type' => $request->type,
            'buy_method' => $request->buy_method,
            'total_amount' => $request->total_amount,
            'status' => 'Pending',
            'order_date' => now(),
            'estimated_arrival' => now()->addDays(7),
        ]);

        $cartItems = Cart::whereIn('id', $request->cart_items)->where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            $order->products()->attach($item->product_id, ['amount' => $item->amount]);
            $item->delete();
        }

        return redirect()->route('buyer.dashboard')->with('success', 'Order placed successfully.');
    }

    public function storeOrderDetails(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'type' => 'required|string|max:255',
            'buy_method' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'type' => $request->type,
            'buy_method' => $request->buy_method,
            'total_amount' => $request->total_amount,
            'status' => 'Pending',
            'order_date' => now(),
            'estimated_arrival' => now()->addDays(7),
        ]);

        $cartItems = Cart::whereIn('id', $request->cart_items)->where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            $productIds = is_array($request->product_ids) ? $request->product_ids : [$request->product_ids];
            $products = Product::whereIn('id', $productIds)->get();
            $cartItems = $products->map(function ($product) use ($request) {
                return (object)[
                    'product_id' => $product->id,
                    'amount' => 1,
                    'product' => $product,
                ];
            });
        }

        foreach ($cartItems as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->amount,
                'price' => $item->product->price,
            ]);
        }

        return redirect()->route('buyer.dashboard')->with('success', 'Order placed successfully.');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('orderDetails.product')->get();
        return view('dashboard.buyer.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if (Gate::denies('view', $order)) {
            abort(403);
        }
        $order->load('orderDetails.product');
        return view('dashboard.buyer.order.show', compact('order'));
    }

    public function sellerOrderList()
    {
        $orders = Order::whereHas('orderDetails.product.store', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('orderDetails.product')->get();

        return view('dashboard.seller.orderList.index', compact('orders'));
    }

    public function allOrdersFromBuyers()
    {
        $orders = Order::whereHas('orderDetails.product.store', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('orderDetails.product')->get();

        return view('dashboard.seller.orderList.allOrders', compact('orders'));
    }

    public function buyNow($productId)
    {
        $product = Product::findOrFail($productId);
        $cartItems = collect([
            (object)[
                'id' => null,
                'product_id' => $product->id,
                'amount' => 1,
                'product' => $product,
            ]
        ]);
        return view('dashboard.buyer.order.create', compact('cartItems'));
    }

    public function checkout(Request $request)
    {
        $cartItems = Cart::whereIn('id', $request->cart_items)
                         ->where('user_id', Auth::id())
                         ->with('product')
                         ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('buyer.cart.index')->with('error', 'No items selected for checkout.');
        }

        return view('dashboard.buyer.order.create', compact('cartItems'));
    }

    public function shipOrder(Order $order)
    {
        if ($order->status !== 'Pending') {
            return redirect()->back()->with('error', 'Order is not in a pending state.');
        }

        foreach ($order->orderDetails as $detail) {
            $product = $detail->product;
            if ($product->stock < $detail->quantity) {
                return redirect()->back()->with('error', 'Not enough stock for product: ' . $product->name);
            }
            $product->stock -= $detail->quantity;
            $product->save();
        }

        $order->status = 'Shipping';
        $order->save();

        return redirect()->back()->with('success', 'Order status updated to shipping.');
    }
}