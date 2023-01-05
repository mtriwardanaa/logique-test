<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserCommand extends Controller
{
    public static function create($payload)
    {
        return User::create($payload);
    }

    public static function update($payload, $id)
    {
        return User::where('user_id', $id)->update($payload);
    }
}
