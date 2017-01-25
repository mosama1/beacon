<?php

require __DIR__ . '/routes/website.php';

Route::group(['namespace' => 'Guest', 'middleware' => 'guest'], function () {
    require __DIR__ . '/routes/guest.php';
});

Route::group(['middleware' => 'auth'], function () {

    require __DIR__ . '/routes/auth.php';

    Route::group([
        'prefix'     => 'admin',
        'namespace'  => 'Admin',
    ], function () {
        require __DIR__ . '/routes/admin.php';
    });
});

Auth::routes();