<?php

use Modules\User\Http\Controllers\v1\UserApi;


Route::prefix('v1')->group(
    function () {
        Route::prefix('user')->group(
            function () {
                    Route::controller(UserApi::class)->group(
                        function () {
                                        Route::get('list', 'list');
                                        Route::post('register', 'register');
                                        Route::post('/', 'update');
                                    }
                    );
                }
        );
    }
);
