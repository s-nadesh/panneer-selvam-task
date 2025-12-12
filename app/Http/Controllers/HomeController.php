<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Spatie\Permission\Models\Role;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::count();
        $products = Product::count();
        $user = User::all();
        $order = Order::count();
        $role = Role::count();

        $userData = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

    $userLabels = $userData->pluck('date')->map(function ($date) {
        return Carbon::parse($date)->toIso8601String();
    });

    $userValues = $userData->pluck('total');

    // ----------- ORDERS PER DAY ---------------
    $orderData = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

    $orderLabels = $orderData->pluck('date')->map(function ($date) {
        return Carbon::parse($date)->toIso8601String();
    });

    $orderValues = $orderData->pluck('total');

// dd($orderValues, $orderLabels, count($orderValues));
        return view('dashboard',compact('categories','products','user','order','role', 'userLabels','userValues',
        'orderLabels','orderValues'));
    }
    
}
