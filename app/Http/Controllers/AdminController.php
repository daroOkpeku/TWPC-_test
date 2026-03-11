<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $blockedUsers = User::where('is_blocked', true)->count();
        $recentProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'blockedUsers', 'recentProducts'));
    }

    public function users()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->latest()->paginate(10);

        return view('admin.users', compact('users'));
    }

    public function toggleBlockUser(User $user)
    {
        $user->is_blocked = !$user->is_blocked;
        $user->save();

        $status = $user->is_blocked ? 'blocked' : 'unblocked';
        return redirect()->back()->with('success', "User has been {$status}.");
    }

    public function products()
    {
        $products = Product::with('user')->latest()->paginate(10);
       
        return view('admin.products', compact('products'));
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

      public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }


}
