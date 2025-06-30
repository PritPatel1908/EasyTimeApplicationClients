<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ApplicationUser;
use App\Http\Controllers\Controller;

class ClientCodeController extends Controller
{
    /**
     * Check if client code exists and return URL
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyClientCode(Request $request)
    {
        $request->validate([
            'client_code' => 'required|string',
        ]);

        $clientCode = $request->input('client_code');
        $applicationUser = ApplicationUser::where('client_code', $clientCode)->first();

        if ($applicationUser) {
            return response()->json([
                'status' => 'success',
                'url' => $applicationUser->url,
                'message' => 'Client code found'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Client code not found'
        ], 404);
    }
}
