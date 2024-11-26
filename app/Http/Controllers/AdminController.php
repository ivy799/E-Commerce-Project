<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
 }

    public function adminHome()
    {
        $userCount = User::count();
        $buyerCount = User::where('role', 'buyer')->count();
        $sellerCount = User::where('role', 'seller')->count();
        $ordersPerDay = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        return view('dashboard.admin.AdminHome', compact('userCount', 'buyerCount', 'sellerCount', 'ordersPerDay'));
    }
}