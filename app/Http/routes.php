<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();


Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin'], function()
    {
        // Quizz
        Route::resource(
            'quizz',
            'QuizzController' ,
            array(
                'names' => array(
                    'index' => 'quizz-index'
                )
            )
        );

        // Question
        Route::resource(
            'question',
            'QuestionController' ,
            array(
                'names' => array(
                    'index' => 'question-index'
                )
            )
        );

        // Template
        Route::resource(
            'template',
            'TemplateController' ,
            array(
                'names' => array(
                    'index' => 'template-index'
                )
            )
        );

    });

});




Route::get('/home', 'HomeController@index');
