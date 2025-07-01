<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApplicationUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApplicationUserController extends Controller
{
    /**
     * Verify client code and return URL if found
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function verifyClientCode(Request $request): JsonResponse
    {
        $request->validate([
            'client_code' => 'required|string',
        ]);

        $clientCode = $request->input('client_code');

        $applicationUser = ApplicationUser::where('client_code', $clientCode)->first();

        if ($applicationUser && $applicationUser->url) {
            return response()->json([
                'status' => 'success',
                'url' => $applicationUser->url,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid client code or URL not found',
        ], 404);
    }
}
