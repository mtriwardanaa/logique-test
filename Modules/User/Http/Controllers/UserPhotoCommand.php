<?php

namespace Modules\User\Http\Controllers;

use App\Models\UserPhoto;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserPhotoCommand extends Controller
{
    public static function create($payload)
    {
        return UserPhoto::create($payload);
    }

    public static function insert($payload)
    {
        return UserPhoto::insert($payload);
    }

    public static function delete($user_id)
    {
        return UserPhoto::where('user_id', $user_id)->delete();
    }
}
