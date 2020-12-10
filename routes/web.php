<?php

Route::get('/', ['as' => 'frontend.index','uses' => 'Frontend\IndexController@index']);






// Authentication Route

Route::get('/login',                     [ 'as' => 'frontend.show_login_form'  ,         'uses' =>  'Frontend\Auth\LoginController@showLoginForm' ]);
Route::post('login',                     [ 'as' => 'frontend.login'  ,                   'uses' =>  'Frontend\Auth\LoginController@login' ]);
Route::post('logout',                    [ 'as' => 'frontend.logout'  ,                  'uses' =>  'Frontend\Auth\LoginController@logout' ]);
Route::get('register',                   [ 'as' => 'frontend.show_register_form'  ,      'uses' =>  'Frontend\Auth\RegisterController@showRegistrationForm' ]);
Route::post('register',                  [ 'as' => 'frontend.register'  ,                'uses' =>  'Frontend\Auth\RegisterController@register' ]);
Route::get('password/reset',             [ 'as' => 'password.request'  ,                 'uses' => 'Frontend\Auth\ForgotPasswordController@showLinkRequestForm' ]);
Route::post('password/email',            [ 'as' => 'password.email'  ,                   'uses' => 'Frontend\Auth\ForgotPasswordController@sendResetLinkEmail' ]);
Route::get('password/reset/{token}',     [ 'as' => 'password.reset'  ,                   'uses' => 'Frontend\Auth\ResetPasswordController@showResetForm' ]);
Route::post('password/reset',            [ 'as' => 'password.update'  ,                  'uses' => 'Frontend\Auth\ResetPasswordController@reset' ]);
Route::get('email/verify',               [ 'as' => 'verification.notice' ,                'uses' => 'Frontend\Auth\VerificationController@show']);
Route::get('email/verify/{id}/{hash}',   [ 'as' => 'verification.verify' ,                'uses' => 'Frontend\Auth\VerificationController@verify']);
Route::post('email/resend',              [ 'as' => 'verification.resend' ,                'uses' => 'Frontend\Auth\VerificationController@resend']);


Route::group(['middleware' => 'verified'],function(){
    Route::get('/dashboard',              ['as' => 'frontend.dashboard' , 'uses' => 'Frontend\UsersController@index']);
    Route::get('/create-post',            ['as' => 'users.post.create' , 'uses' => 'Frontend\UsersController@create_post']);
    Route::post('/create-post',           ['as' => 'users.post.store' , 'uses' => 'Frontend\UsersController@store_post']);

    Route::get('/edit-post/{post_id}',            ['as' => 'users.post.edit' , 'uses' => 'Frontend\UsersController@edit_post']);
    Route::put('/edit-post/{post_id}',           ['as' => 'users.post.update' , 'uses' => 'Frontend\UsersController@update_post']);
    Route::delete('/delete-post/{post_id}',           ['as' => 'users.post.destroy' , 'uses' => 'Frontend\UsersController@destroy_post']);


    Route::post('/delete-post-media/{media_id}',           ['as' => 'users.post.media.destroy' , 'uses' => 'Frontend\UsersController@destroy_post_media']);

});


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




Route::get('/Contact-us',                       ['as'      => 'frontend.Contact',                          'uses' => 'Frontend\IndexController@Contact']);
Route::post('/Contact-us',                      ['as'      => 'frontend.do_Contact',                       'uses' => 'Frontend\IndexController@do_Contact']);
Route::get('/category/{category_slug}',         ['as'       => 'frontend.category.posts',                  'uses' => 'Frontend\IndexController@catgory']);
Route::get('/archive/{date}',                   ['as'       => 'frontend.archive.posts',                   'uses' => 'Frontend\IndexController@archive']);
Route::get('/author/{username}',                ['as'       => 'frontend.author.posts',                   'uses'  => 'Frontend\IndexController@author']);
Route::get('/search',                           ['as'      => 'frontend.search',                           'uses' => 'Frontend\IndexController@search']);
Route::get('/{post}',                           ['as'      => 'posts.show',                                'uses' => 'Frontend\IndexController@post_show']);
Route::post('/{post}',                          ['as'      => 'posts.add_comment',                         'uses' => 'Frontend\IndexController@store_comment']);
