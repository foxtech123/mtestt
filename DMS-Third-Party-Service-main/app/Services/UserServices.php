<?php

namespace App\Services;

use App\Http\Helper\Common;
use App\Models\User;

class UserServices
{

    public function createUser($request)
    {
        return User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'apikey'    => Common::slugify($request->email . $request->name),
        ]);
    }
}
