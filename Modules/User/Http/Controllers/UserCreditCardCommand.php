<?php

namespace Modules\User\Http\Controllers;

use App\Models\UserCreditCard;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserCreditCardCommand extends Controller
{
    public static function create($payload)
    {
        return UserCreditCard::create($payload);
    }

    public static function update($payload, $user_id)
    {
        return UserCreditCard::where('user_id', $user_id)->update($payload);
    }
}
