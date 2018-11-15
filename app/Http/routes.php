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

        // Answer
        Route::resource(
            'answer',
            'AnswerController' ,
            array(
                'names' => array(
                    'index' => 'anwser-index'
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

        // User
        Route::resource(
            'users',
            'UserController',
            array(
                'names' => array(
                    'index' => 'users-index',
                    'show'  => 'show-user',
                    'store' => 'store-user',
                    'update' => 'update-user'
                )
            )
        );

        Route::get('/moncompte/{id}' , 'UserController@show')->name('mon-compte');

    });

});



Route::group(['prefix' => '/'], function() {

    // Quizz - intro
    Route::get('/{name}', 'QuizzController@intro')->name('intro-quizz');
    // Quizz - rules
    Route::get('/{name}/rules', 'QuizzController@rules')->name('rules-quizz');
    // Quizz - register player
    Route::get('/{name}/player', 'QuizzController@player')->name('player-quizz');

});



    Route::get('/home', 'HomeController@index');
