<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Hash;

// Route::middleware('auth:api')->get('/admin', function (Request $request) {
//     return $request->admin();
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function(Request $request) {
    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response([
            'message' => ['The provided credentials are incorrect.']
        ], 404);
    }

    $token = $user->createToken('my-app-token')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 201);
});

Route::group(['namespace' => 'Api',], function() {
    Route::get('/products', 'ProductController@index');
    Route::get('/sliders', 'ProductController@slider');
    Route::get('/recommended', 'ProductController@slider');
    Route::get('/categories', 'CategoryController@index');
    Route::get('/products/{id}', 'ProductController@getByCategory');
    Route::post('/register', 'RegisterController@register');
});