<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Modules\User\Http\Requests\RegistrationRequest;
use Modules\User\Models\User;

class RegistrationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegistrationRequest $request)
    {
        $user = User::create($request->validated());

        event(new Registered($user));

        return response()->json($user, 201);
    }
}
