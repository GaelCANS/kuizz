<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Grade;
use App\Question;
use App\Quizz;
use App\Template;
use App\User;
use Carbon\Carbon;
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
        if (!Quizz::urlIsUnique($quizz,$request->get('url'))) {
            $request->merge(array('url' => $request->get('url').'-'.$quizz->id));
        }
        $quizz->update( $request->only( 'name' , 'template_id' , 'user_id' , 'timing' , 'comment' , 'url' ) );
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


    public function newPlayer(Requests\PlayerRequest $request , $name)
    {
        $quizz = Quizz::whereUrl($name)->first();
        if ($quizz == null) return view('errors.404');

        $datas = $request->all();
        $datas['quizz_id'] = $quizz->id;
        $user = User::create($datas);
        $question = Question::where('quizz_id',$quizz->id)->notdeleted()->whereOrder(1)->first();
        session( array('user' => $user , 'question' => $question ) );

        return redirect(action('QuizzController@question' , array('name' => $quizz->url)));
    }


    public function question($name)
    {
        $quizz = Quizz::whereUrl($name)->first();
        if ($quizz == null) return view('errors.404');

        if (session('question') == null && session('user') == null) return redirect(action('QuizzController@intro' , array('name' => $name)));

        $quizz->load('Template');
        $quizz->load('Questions');

        $question = session('question');
        if ($question != null) {
            $question->load('Answers');
            return view('quizz.question' , compact('quizz' , 'question'));
        }

        return redirect(action('QuizzController@end' , array('name' => $quizz->url)));
    }


    public function answered(Request $request, $name)
    {
        $quizz = Quizz::whereUrl($name)->first();
        if ($quizz == null) return view('errors.404');

        // Récupération de l'utilisateur et de la question
        $user = session('user');
        $question = session('question');

        // Enregistrement des réponses en base
        $requestAnswsers = $request->only('answer');
        if ($requestAnswsers['answer'] != null) {
            $anwsers = Answer::whereIn('id', array_keys($requestAnswsers['answer']))->get();
            $user->answers()->attach($anwsers, array("question_id" => $question->id));
        }

        // Récupération du score
        $score = Question::getScore($question, array_keys((array)$requestAnswsers['answer']));
        $user->questions()->attach($question, array("score" => $score));

        // Mise en session de la prochaine question
        session( array('question' => Question::nextQuestion($question) ) );

        return redirect(action('QuizzController@question' , array('name' => $quizz->url)));
    }



    public function end($name)
    {
        $quizz = Quizz::whereUrl($name)->first();
        if ($quizz == null) return view('errors.404');

        if (session('question') == null && session('user') == null) return redirect(action('QuizzController@intro' , array('name' => $name)));

        if (session('user')->finished_at == null ) {
            session('user')->finished_at = Carbon::now();
            session('user')->save();
        }
        
        $quizz->load('Template');
        $quizz->load('Questions');
        $quizz->load('Users');
        $user = session('user');
        $score = Quizz::score(session('user'));
        $duree = Quizz::duree(session('user'));
        $rank = Quizz::rank($user);
        $participants = Quizz::participants($quizz);
        $grade = Grade::getGrade($quizz->template, round(($score*100)/$quizz->questions->count()) );

        return view('quizz.end' , compact('quizz' , 'score' , 'duree' , 'user' , 'rank' , 'participants' , 'grade'));
    }

    public function podium($name)
    {
        $quizz = Quizz::whereUrl($name)->first();
        if ($quizz == null) return view('errors.404');

        $quizz->load('Template');

        $participants = Quizz::participants($quizz);
        $tops = Quizz::top(10,0,$quizz);
        $ids = array_column($tops,'id');

        return view('quizz.podium' , compact('quizz','participants','tops','ids'));
    }

    public function reloadPodium($name)
    {
        $quizz = Quizz::whereUrl($name)->first();
        if ($quizz == null) return view('errors.404');

        $quizz->load('Template');

        $participants = Quizz::participants($quizz);
        $tops = Quizz::top(10,0,$quizz);
        $ids = array_column($tops,'id');

        $html = view('quizz.podium-list' , compact('tops','quizz'))->render();
        return response()->json(
            array(
                'html'          => $html,
                'ids'           => $ids,
                'participants'  => $participants
            )
        );
    }

}
