<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FCMController extends Controller
{
    /**
     * Generate an FCM token and return it as JSON response.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateToken(Request $req)
    {
        // Retrieve all input data from the request
        $input = $req->all();
        
        // Return the input data as a JSON response
        return response()->json($input);
    }
}
