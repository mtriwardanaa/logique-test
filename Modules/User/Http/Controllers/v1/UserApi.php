<?php

namespace Modules\User\Http\Controllers\v1;

use App\Helper\WrapperError;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\User\Http\Controllers\UserCommand;
use Modules\User\Http\Controllers\UserCreditCardCommand;
use Modules\User\Http\Controllers\UserPhotoCommand;
use Modules\User\Http\Controllers\UserQuery;
use Modules\User\Http\Requests\UserRegister;

use DB;

class UserApi extends Controller
{
    public function list(Request $request)
    {
        try {
            $list = UserQuery::paginate($request);
            return response()->json($list);
        } catch (\Throwable $th) {
            return WrapperError::error(500);
        }
    }

    public function register(UserRegister $request)
    {
        DB::beginTransaction();
        try {
            $post = $request->all();
            $dataUser = [
                'name'     => $post['name'],
                'address'  => $post['address'],
                'email'    => $post['email'],
                'password' => \Hash::make($post['password']),
            ];

            $saveUser = UserCommand::create($dataUser);

            $userPhoto = $this->upload($post['photos'], $saveUser['user_id']);
            UserPhotoCommand::insert($userPhoto);

            $creditCard = [
                'user_id' => $saveUser['user_id'],
                'type'    => $post['creditcard_type'],
                'number'  => $post['creditcard_number'],
                'name'    => $post['creditcard_name'],
                'expired' => $post['creditcard_expired'],
                'ccv'     => $post['creditcard_cvv'],
            ];

            UserCreditCardCommand::create($creditCard);

            DB::commit();
            return response()->json(['user_id' => $saveUser['user_id']]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return WrapperError::error(500);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $post = $request->all();
            $user_id = $post['user_id'];
            $dataUser = [];
            if (isset($post['name'])) {
                $dataUser['name'] = $post['name'];
            }
            if (isset($post['address'])) {
                $dataUser['address'] = $post['address'];
            }
            if (isset($post['email'])) {
                $dataUser['email'] = $post['email'];
            }
            if (isset($post['password'])) {
                $dataUser['password'] = \Hash::make($post['password']);
            }

            $saveUser = UserCommand::update($dataUser, $user_id);
            if (isset($post['photos'])) {
                UserPhotoCommand::delete($user_id);

                $userPhoto = $this->upload($post['photos'], $saveUser['user_id']);
                UserPhotoCommand::insert($userPhoto);
            }

            $dataCreditCard = [];
            if (isset($post['creditcard_type'])) {
                $dataCreditCard['type'] = $post['creditcard_type'];
            }
            if (isset($post['creditcard_number'])) {
                $dataCreditCard['number'] = $post['creditcard_number'];
            }
            if (isset($post['creditcard_name'])) {
                $dataCreditCard['name'] = $post['creditcard_name'];
            }
            if (isset($post['creditcard_expired'])) {
                $dataCreditCard['expired'] = $post['creditcard_expired'];
            }
            if (isset($post['creditcard_cvv'])) {
                $dataCreditCard['ccv'] = $post['creditcard_cvv'];
            }

            UserCreditCardCommand::update($dataCreditCard, $user_id);
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return WrapperError::error(500);
        }
    }

    public function upload($payload, $user_id)
    {
        try {
            $url = [];
            foreach ($payload as $value) {
                $url[] = [
                    'user_id'    => $user_id,
                    'link'       => Storage::disk('public')->putFile(
                        'photos',
                        $value,
                    ),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            return $url;
        } catch (\Throwable $th) {
            return WrapperError::error(500);
        }
    }
}
