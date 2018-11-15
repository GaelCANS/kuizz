<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Quizz;
use App\Template;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class QuizzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzs = Quizz::notdeleted()->get();
        return view('quizzs.index' , compact('quizzs') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quizz = null;
        $templates = Template::notdeleted()->pluck('name' , 'id')->toArray();
        $users = User::admin()->pluck('name' , 'id')->toArray();
        return view('quizzs.show' , compact('quizz' , 'templates' , 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\QuizzRequest $request)
    {
        $quizz = Quizz::create( $request->all() );
        return redirect()->back()->with('success' , "Le quizz vient d'être ajouté");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quizz = Quizz::findOrFail($id);
        $quizz->load('Questions');
        $quizz->questions->load('Answers');
        $templates = Template::notdeleted()->pluck('name' , 'id')->toArray();
        $users = User::admin()->pluck('name' , 'id')->toArray();
        return view('quizzs.show' , compact('quizz' , 'templates' , 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\QuizzRequest $request, $id)
    {
        $quizz = Quizz::findOrFail($id);
        $quizz->update( $request->only( 'name' , 'template_id' , 'user_id' , 'timing' , 'comment' ) );
        Question::saveQuestions($request->only('question'));
        Answer::saveAnswers($request->only('answer'));

        return redirect()->back()->with('success' , "Le quizz vient d'être mis à jour");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quizz = Quizz::findOrFail($id);
        $name = $quizz->name;
        $quizz->update( array('delete' => 1) );
        return redirect(action('QuizzController@index'))->with('success' , "Le quizz {$name} a bien été supprimé.");
    }
    
    
    public function intro($name)
    {
        $quizz = Quizz::whereUrl($name)->first();
        if ($quizz == null) return view('errors.404');

        $quizz->load('Template');

        return view('quizz.intro' , compact('quizz'));
    }


    public function rules($name)
    {
        $quizz = Quizz::whereUrl($name)->first();
        if ($quizz == null) return view('errors.404');

        $quizz->load('Template');
        $quizz->load('Questions');


        return view('quizz.rules' , compact('quizz'));
    }


    public function player($name)
    {
        $quizz = Quizz::whereUrl($name)->first();
        if ($quizz == null) return view('errors.404');

        $quizz->load('Template');


        return view('quizz.player' , compact('quizz'));
    }
}
