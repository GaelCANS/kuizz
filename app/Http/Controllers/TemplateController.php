<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::notdeleted()->get();
        return view('templates.index' , compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template = null;
        return view('templates.show' , compact('template'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\TemplateRequest $request)
    {
        $template = Template::create($request->all());
        return redirect(action('TemplateController@index'))->with('success' , "Le template {$template->name} a bien été crée.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = Template::findOrFail($id);
        return view('templates.show' , compact('template'));
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
    public function update(Requests\TemplateRequest $request, $id)
    {
        $template = Template::findOrFail($id);
        $template->update($request->all());
        return redirect()->back()->with('success' , "Le template vient d'être mis à jour");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = Template::findOrFail($id);
        $name = $template->name;
        $template->update( array('delete' => 1) );
        return redirect(action('TemplateController@index'))->with('success' , "Le template {$name} a bien été supprimé.");
    }
}
