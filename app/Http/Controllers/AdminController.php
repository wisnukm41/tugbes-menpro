<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'earnings' => DB::table('transactions')->whereMonth('created_at', Carbon::now()->month)->sum('amount'),
            'sales' => DB::table('transactions')->whereYear('created_at', Carbon::now()->year)->count(),
            'new_user' => DB::table('users')->whereYear('created_at', Carbon::now()->year)->count(),
            'order' => DB::table('transactions')->where('status', 'settlement')->orWhere('status', 'process')->count(),
            'transaction' => Transaction::orderBy('created_at', 'desc')->limit(5)->get(),
        ];
        return view('dashboard', $data);
    }
}
