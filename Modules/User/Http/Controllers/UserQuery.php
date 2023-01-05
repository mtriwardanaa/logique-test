<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserQuery extends Controller
{
    public static function paginate($request)
    {
        $orderBy = $request->get('ob') ?? 'name';
        $sortBy = $request->get('sb') ?? 'asc';
        $offset = $request->get('of') ?? 0;
        $limit = $request->get('lt') ?? 30;

        $paginate = User::with('photos', 'creditcard')->orderBy($orderBy, $sortBy)->skip($offset)->take($limit)->get();
        return [
            'count' => $paginate->count(),
            'rows'  => $paginate
        ];
    }
}
