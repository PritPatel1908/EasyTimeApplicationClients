<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ApplicationUser;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $activeClients = Client::where('is_active', true)->get();
        $activeClientCount = $activeClients->count();
        $recentClients = Client::latest()->take(10)->get();

        $activeApplicationUsers = ApplicationUser::where('allow_login', true)->get();
        $activeApplicationUserCount = $activeApplicationUsers->count();
        $recentApplicationUsers = ApplicationUser::with('client')->latest()->take(10)->get();

        return view('dashboard', compact(
            'activeClientCount',
            'recentClients',
            'activeApplicationUserCount',
            'recentApplicationUsers'
        ));
    }
}
