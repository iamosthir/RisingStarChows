<?php

namespace App\Http\Controllers;

use App\Support\CaptchaGenerator;
use Illuminate\Http\JsonResponse;

class CaptchaController extends Controller
{
    public function refresh(): JsonResponse
    {
        return response()->json(CaptchaGenerator::make());
    }
}
