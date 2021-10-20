<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Notifications\UserRegisterNotification;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{

Route::get('/', function () {
    // return Product::all();
    // $prod = Product::all();

    // $product = Product::find(1);
    // $product->comments()->create([
    //     'user_id' => 1,
    //     'comment' => 'This is another test comment'
    // ]);
    // return $product;

    // return User::all();

    // $post = Post::find(1);
    // return  $post->comments;

    $user = User::find(2);

    $user->notify(new UserRegisterNotification);

    // $user->courses()->attach([2]); // Add new value to the database with redandancy
    // $user->courses()->detach([2]); // Remove value from data
    // $user->courses()->sync([2, 5, 9]); // Insert if the value not exisit And Remove the value if removed from array

    // return $user->courses;

    // foreach($user->courses as $course) {
    //     echo $course->student->user_id . "<br>";
    // }

    exit;

    return view('welcome', compact('prod'));
});

Route::get('export-products', [HomeController::class, 'export']);

Route::post('import', [HomeController::class, 'import'])->name('import');

Route::get('image', [HomeController::class, 'image'])->name('image');
Route::post('image', [HomeController::class, 'imageSubmit']);

Route::get('blog', [HomeController::class, 'blog']);

Route::resource('posts', PostController::class);
Route::get('getData', [PostController::class, 'getData'])->name('posts.getData');

});
