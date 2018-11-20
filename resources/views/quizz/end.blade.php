@extends('frontoff.app' , array('template' => $quizz->template->stylesheet))

@section('content')


    <div class="row">
        <h2><font color="#798588">Fin de l'épreuve {{$user->name}}...</font><br>Votre niveau :</h2>
        <span class="results-level" style="font-size: 1.6em;">GRADE</span>
        <span class="pins"><img src="./img/assurances/GRADE-SLUGIFY.jpg" width="100px"></span>

        <span class="results-level" style="padding-left: 80px; padding-right: 80px;">GRADE-COMMENT</span>
        <div class="results-text white-shadow">
            <i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:30px;text-shadow: 2px 2px 0px #fff;"></i>&nbsp; Classement : <span class="results-perf">{{$rank[0]->increment}}/{{$participants}}</span><br>
            <i class="fa fa-check" aria-hidden="true" style="font-size:30px;text-shadow: 2px 2px 0px #fff;"></i>&nbsp; {{ trans('quizz.'.$quizz->template->texts.'.nb-reponses') }} : <span class="results-perf">{{$score}}/{{$quizz->questions->count()}}</span><br>
            <i class="fa fa-clock-o" aria-hidden="true" style="font-size:30px;text-shadow: 2px 2px 0px #fff;"></i>&nbsp; {{ trans('quizz.'.$quizz->template->texts.'.temps-quizz') }} : <span class="results-perf"><font color="#798588">{{$duree}} secondes</font></span>
        </div>
    </div>

    <div class="col-md-12 text-center">
        <input type="button" class="btn btn-primary" value="On recommence ?" onclick="location.href = 'index.php';" style="font-size:25px;">
    </div>


@endsection