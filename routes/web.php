<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/curl',function() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/todos/1');    
    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
});

Route::get('/info', function (){
    phpinfo();
});

Route::get('/generate-form-data', function (){
    $faker = Faker\Factory::create('id_ID');

    return response([
        'name' => $faker->name,
        'address' => $faker->address,
        'random_number' => rand(1, 3),
        'phone' => $faker->phoneNumber,
    ]);
});

Route::post('submit-form', function (){
    return redirect()->back()->withInput();
});
