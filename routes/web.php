<?php

Route::get('/', ['as' => 'frontend.index','uses' => 'Frontend\IndexController@index']);

// Authentication Route

Route::get('/login',                     [ 'as' => 'show_login_form'  ,         'uses' =>  'Frontend\Auth\LoginController@showLoginForm' ]);
Route::post('login',                     [ 'as' => 'login'  ,                   'uses' =>  'Frontend\Auth\LoginController@login' ]);
Route::post('logout',                    [ 'as' => 'logout'  ,                    'uses' =>  'Frontend\Auth\LoginController@logout' ]);
Route::get('register',                   [ 'as' => 'register'  ,                 'uses' =>  'Frontend\Auth\RegisterController@showRegistrationForm' ]);
Route::post('register',                  [ 'as' => 'register'  ,                'uses' =>  'Frontend\Auth\RegisterController@register' ]);
Route::get('password/reset',             [ 'as' => 'password.request'  ,         'uses' => 'Frontend\Auth\ForgotPasswordController@showLinkRequestForm' ]);
Route::post('password/email',            [ 'as' => 'password.email'  ,            'uses' => 'Frontend\Auth\ForgotPasswordController@sendResetLinkEmail' ]);
Route::get('password/reset/{token}',     [ 'as' => 'password.reset'  ,           'uses' => 'Frontend\Auth\ResetPasswordController@showResetForm' ]);
Route::post('password/reset',            [ 'as' => 'password.update'  ,          'uses' => 'Frontend\Auth\ResetPasswordController@reset' ]);
Route::get('email/verify',               ['as' => 'verification.notice' ,        'uses' => 'Frontend\Auth\VerificationController@show']);
Route::get('email/verify/{id}/{hash}',   ['as' => 'verification.verify' ,        'uses' => 'Frontend\Auth\VerificationController@verify']);
Route::post('email/resend',              ['as' => 'verification.resend' ,       'uses' => 'Frontend\Auth\VerificationController@resend']);

Route::group(['prefix' => 'admin'],function(){

    Route::get('/login',                     [ 'as' => 'admin.show_login_form'  ,         'uses' =>  'Backend\Auth\LoginController@showLoginForm' ]);
    Route::post('login',                     [ 'as' => 'admin.login'  ,                   'uses' =>  'Backend\Auth\LoginController@login' ]);
    Route::post('logout',                    [ 'as' => 'admin.show_login_form'  ,         'uses' =>  'Backend\Auth\LoginController@logout' ]);
    Route::get('password/reset',             [ 'as' => 'admin.password.request'  ,         'uses' => 'Backend\Auth\LoginController@showLinkRequestForm' ]);
    Route::post('password/email',            [ 'as' => 'admin.assword.email'  ,            'uses' => 'Backend\Auth\LoginController@sendResetLinkEmail' ]);
    Route::get('password/reset/{token}',     [ 'as' => 'admin.password.reset'  ,           'uses' => 'Backend\Auth\LoginController@showResetForm' ]);
    Route::post('password/reset',            [ 'as' => 'admin.password.update'  ,          'uses' => 'Backend\Auth\LoginController@reset' ]);
    Route::get('email/verify',               ['as' =>  'admin.verification.notice' ,        'uses' => 'Backend\Auth\VerificationController@show']);
    Route::get('email/verify/{id}/{hash}',   ['as' =>  'admin.verification.verify' ,        'uses' => 'Backend\Auth\VerificationController@verify']);
    Route::post('email/resend',              ['as' => 'admin.verification.resend' ,       'uses' => 'Backend\Auth\VerificationController@resend']);
    
    
});