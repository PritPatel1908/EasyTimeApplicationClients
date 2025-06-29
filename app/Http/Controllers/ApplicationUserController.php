<?php

namespace App\Http\Controllers;

use App\Models\ApplicationUser;
use App\Models\Client;
use Illuminate\Http\Request;

class ApplicationUserController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {
        $applicationUsers = ApplicationUser::with('client')->latest()->paginate(10);
        return view('application-users.index', compact('applicationUsers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::where('is_active', true)->get();
        return view('application-users.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'client_code' => 'required|string|max:50|unique:application_users',
            'allow_login' => 'boolean',
            'url' => 'nullable|url|max:255',
        ]);

        ApplicationUser::create($validated);

        return redirect()->route('application-users.index')
            ->with('success', 'Application user created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ApplicationUser $applicationUser)
    {
        return view('application-users.show', compact('applicationUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApplicationUser $applicationUser)
    {
        $clients = Client::where('is_active', true)->get();
        return view('application-users.edit', compact('applicationUser', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApplicationUser $applicationUser)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'client_code' => 'required|string|max:50|unique:application_users,client_code,' . $applicationUser->id,
            'allow_login' => 'boolean',
            'url' => 'nullable|url|max:255',
        ]);

        $applicationUser->update($validated);

        return redirect()->route('application-users.index')
            ->with('success', 'Application user updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplicationUser $applicationUser)
    {
        $applicationUser->delete();

        return redirect()->route('application-users.index')
            ->with('success', 'Application user deleted successfully.');
    }
}
