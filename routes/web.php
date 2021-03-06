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

Route::get('search', [PostController::class, 'search'])->name('search');
Route::get('search_post', [PostController::class, 'search_post'])->name('search_post');

Route::get('search2', [PostController::class, 'search2'])->name('search2');
Route::get('search_post2', [PostController::class, 'search_post2'])->name('search_post2');

Route::get('posts-api', [PostController::class, 'posts_api']);

Route::get('ajax-file', [PostController::class, 'ajax_file']);
Route::post('ajax-file', [PostController::class, 'ajax_file_store'])->name('ajax_file_store');

});
