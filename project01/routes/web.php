<?php

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
    //return view('welcome');
    return view('top');
});

//Route::get('/','WaitingController@index')->name('home')

Route::resource('Waiting','WaitingController')->only([
    'index','store','destroy','edit'
    ]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/admin', 'AdminController@index')->name('admin');


//全ユーザー
Route::group(['middleware'=>['auth','can:user-higher']],function(){
   //ユーザー一覧
   Route::get('/account','AccountController@index')->name('account.index');
});

//管理者以上
Route::group(['middleware'=>['auth','can:admin-higher']],function(){
   //ユーザー登録
   Route::get('/account/regist','AcountController@regist')->name('account.regist');
   Route::post('/account/regist','AccountController@createData')->name('account.regist');
   
   //ユーザー編集
   Route::get('/account/edit/{userid}','AcountController@edit')->name('account.edit');
   Route::post('/account/edit/{userid}','AccountController@updateData')->name('account.edit');
    
   //ユーザー削除
   Route::post('/account/delete/{userid}','AccountController@deleteData');
    
});

//システム管理者のみ
Route::group(['middleware'=>['auth','can:system-only']],function(){
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
