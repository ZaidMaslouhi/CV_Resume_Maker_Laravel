<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('accueil',function(){
    return view('accueil');
});

Route::get('service',function(){
    return view('service');
});

Route::get('contact',function(){
    return view('contact');
});


// // CVs
// Route::get('cvs','CvController@index');
// Route::get('cvs/create','CvController@create');
// Route::post('cvs','CvController@store');
// Route::get('cvs/{id}/edit','CvController@edit');
// Route::put('cvs/{id}','CvController@update');
// Route::delete('cvs/{id}','CvController@destroy');
//                   ||
//                   \/
Route::resource('cvs', 'CvController');

// getData
Route::get('/getData/{id}','CvController@getData');

// Module d'Experience
Route::post('/addexperience','CvController@addExperience');
Route::put('/updateexperience','CvController@updateExperience');
Route::delete('/deleteexperience/{id}','CvController@deleteExperience');

// Module de Formation
Route::post('/addFormation','CvController@addFormation');
Route::put('/updateFormation','CvController@updateFormation');
Route::delete('/deleteFormation/{id}','CvController@deleteFormation');

// Module de Competence
Route::post('/addCompetence','CvController@addCompetence');
Route::put('/updateCompetence','CvController@updateCompetence');
Route::delete('/deleteCompetence/{id}','CvController@deleteCompetence');
