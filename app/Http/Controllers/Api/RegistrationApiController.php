<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthUserService;
use Illuminate\Http\JsonResponse;

class RegistrationApiController extends Controller
{
    public function __invoke(RegistrationRequest $request, AuthUserService $service): JsonResponse
    {
        $user = $service->register($request->validated());

        UserRegistered::dispatch($user);

        return response()->json([
            'message' => 'Registration successful',
            'user'    => new UserResource($user),
        ]);
    }
}
