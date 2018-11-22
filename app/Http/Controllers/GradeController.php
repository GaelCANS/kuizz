<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Template;
use Illuminate\Http\Request;

use App\Http\Requests;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template = Template::findOrFail($request->get('template_id'));
        $grade = Grade::create(array('template_id' => $request->get('template_id')));
        $html = view('templates.show-grade' , compact('grade','template'))->render();
        return response()->json(
            array(
                'html'      => $html
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return response()->json(
            array(
                'state'=> 1,
                'id' => $id
            )
        );
    }
    
    public function liste($template_id)
    {
        $template = Template::FindOrFail($template_id);
        $template->load('Grades');

        return view('templates.grade' , compact('template'));
    }


    public function updates(Requests\GradeRequest $request, $template_id)
    {
        $template = Template::findOrFail($template_id);
        $grades = $request->only('grade');
        if (count($grades) > 0 ) {
            foreach ($grades['grade'] as $grade_id => $grade_data) {
                $grade = Grade::FindOrFail($grade_id);
                $grade->update($grade_data);
            }
        }

        return redirect()->back()->with('success' , "Les grades viennent d'être mis à jour");
    }
}
