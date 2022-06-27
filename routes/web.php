<?php

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Http\Controllers\MailController;
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
      //welcome
      return view('welcome');
      
});


Route::GET('welcome', [\App\Http\Controllers\PhotoController::class,'FetchAllImageFromUser'])->name('FetchAllImageFromUser');

Route::group(['middleware' => ['auth']] , function(){

    Route::get('/home', function () {
        
        return view('home');
       
    })->name('home');




    /*Route::group(['middleware' => ['is_admin']] , function(){*/


      

        //home
        Route::GET('/home/{link}', [\App\Http\Controllers\PhotoController::class,'show'])->name('show');
        Route::DELETE('/home',[\App\Http\Controllers\PhotoController::class,'destroy'])->name('destroy');
        Route::PUT('/home',[\App\Http\Controllers\PhotoController::class,'update'])->name('update');
        Route::POST('/home/{category}',[\App\Http\Controllers\PhotoController::class,'create'])->name('create');
        Route::POST('/home',[\App\Http\Controllers\PhotoController::class,'store'])->name('store');
        Route::resource('/home',\App\Http\Controllers\PhotoController::class);


        //photo
        
        Route::resource('photos',\App\Http\Controllers\PhotoController::class);
        Route::POST('home/{link}', [\App\Http\Controllers\PhotoController::class,'show'])->name('show');



        //categories
        Route::resource('categories',CategoryController::class);
        Route::GET('categories/{link}/{Category}', [\App\Http\Controllers\CategoryController::class,'showType'])->name('showType');
        Route::POST('categories/{Category}', [\App\Http\Controllers\CategoryController::class,'UploadImageOnCategory'])->name('UploadImageOnCategory');
        Route::PUT('categories', [\App\Http\Controllers\CategoryController::class,'EditImageOnCategory'])->name('EditImageOnCategory');
        Route::DELETE('categories', [\App\Http\Controllers\CategoryController::class,'destroyImageInCategory'])->name('destroyImageInCategory');
        Route::DELETE('categories', [\App\Http\Controllers\CategoryController::class,'DeleteCategory'])->name('DeleteCategory');
      

    /*});*/


});


require __DIR__.'/auth.php';

