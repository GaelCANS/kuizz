<?php

namespace App\Http\Controllers;

use App\Quizz;
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
        return view('quizzs.show' , compact('quizz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quizz = Quizz::create( $request->all() );
        return redirect(action('QuizzController@index'))->with('success' , "Le quizz {$quizz->name} a bien été crée.");
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
        return view('quizzs.show' , compact('quizz'));
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
    public function update(Request $request, $id)
    {

        $quizz = Quizz::findOrFail($id);
        $quizz->update( $request->all() );
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
}
