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
        // Quizz - résultats
        Route::get('quizz/results/{id}', 'QuizzController@results')->name('results-quizz');
        // Quizz - résultats utilisateur
        Route::get('quizz/results-user/{quizz_id}/{user_id}', 'QuizzController@userResults')->name('results-user-quizz');
        // Quizz - stats
        Route::get('quizz/stats/{id}', 'QuizzController@stats')->name('stats-quizz');

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


        // Grade
        Route::resource(
            'template_grade',
            'GradeController'
        );
        Route::get('grade/{template_id}', 'GradeController@liste')->name('list-grade');
        Route::post('grades/{template_id}', 'GradeController@updates')->name('update-grades');


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
    // Quizz - store register player
    Route::post('/{name}/player', 'QuizzController@newPlayer')->name('store-player-quizz');
    // Quizz - question
    Route::get('/{name}/question', 'QuizzController@question')->name('question-quizz');
    // Quizz - store answer
    Route::post('/{name}/question', 'QuizzController@answered')->name('answer-quizz');
    // Quizz - end
    Route::get('/{name}/end', 'QuizzController@end')->name('end-quizz');
    // Quizz - podium
    Route::get('/{name}/podium', 'QuizzController@podium')->name('podium-quizz');
    // Quizz - reload podium
    Route::post('/{name}/reload/podium', 'QuizzController@reloadPodium')->name('reload-podium-quizz');

});



    Route::get('/home', 'HomeController@index');
