<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


use App\Http\Requests;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct( ){

        $this -> middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::notdeleted()->orderBy('name')->get();
        return view ('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = null;

        $route = \Request::route()->getName();
        return view('users.show', compact('user', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRequest $request)
    {
        $user = User::create( $request->only('name' , 'email') );
        return redirect(action('UserController@index'))->with('success' , "L'utilisateur {$user->name} a bien été crée.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = \Request::route()->getName();

        // Control on admin user
        if (!auth()->user()->admin && $id != auth()->user()->id ) {
            return redirect()->route('dashboard-index');
        }


        $user = User::findOrFail($id);

        return view('users.show' , compact('user' , 'route'));
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
    public function update(Requests\UserRequest $request, $id)
    {
        // Update user standard fiels
        $user = User::findOrFail($id);
        
        $user->update($request->except( 'password'));

        // Update user's password
        if (trim($request->password) != '') {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->back()->with('success' , "Le profil vient d'être mis à jour");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->update( array('delete' => '1') );

        return redirect()->back()->with('success' , "L utilsateur vient d'être supprimé");
    }

    public function hardDestroy($id)
    {
        if (Auth::user()->email != env('SUPER_ADMIN')) return redirect()->back()->with('success' , "Action non autorisée");

        DB::table('question_user')->whereUserId($id)->delete();
        DB::table('answer_user')->whereUserId($id)->delete();
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success' , "L utilsateur vient d'être supprimé");
    }
}
