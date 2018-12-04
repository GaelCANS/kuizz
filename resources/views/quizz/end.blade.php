@extends('frontoff.app' , array('template' => $quizz->template->stylesheet))

@section('content')


    <div class="row">
        <h2><font color="#798588">{{ trans('quizz.'.$quizz->template->texts.'.fin-epreuve') }} {{$user->name}}...</font><br>{{ trans('quizz.'.$quizz->template->texts.'.niveau') }} :</h2>
        <span class="results-level" style="font-size: 1.6em;">{{$grade->name}}</span>
        <span class="pins"><img src="{{ URL::to('/') }}/img/{{$quizz->template->texts}}/{{$grade->slug}}.jpg" width="100px"></span>

        @if ($grade->comment != "")
            <span class="results-level" style="padding-left: 80px; padding-right: 80px;">{!! $grade->comment !!}</span>
        @endif
        <div class="results-text white-shadow">
            <i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:30px;text-shadow: 2px 2px 0px #fff;"></i>&nbsp; {{ trans('quizz.'.$quizz->template->texts.'.classement') }} : <span class="results-perf">{{$rank[0]->increment}}/{{$participants}}</span><br>
            <i class="fa fa-check" aria-hidden="true" style="font-size:30px;text-shadow: 2px 2px 0px #fff;"></i>&nbsp; {{ trans('quizz.'.$quizz->template->texts.'.nb-reponses') }} : <span class="results-perf">{{$score}}/{{$quizz->questions->count()}}</span><br>
            <i class="fa fa-clock-o" aria-hidden="true" style="font-size:30px;text-shadow: 2px 2px 0px #fff;"></i>&nbsp; {{ trans('quizz.'.$quizz->template->texts.'.temps-quizz') }} : <span class="results-perf"><font color="#798588">{{$duree}} secondes</font></span>
        </div>
    </div>

    <div class="col-md-12 text-center">
        <a class="btn btn-primary" href="{{route('intro-quizz' , array('name' => $quizz->url))}}">{{ trans('quizz.'.$quizz->template->texts.'.go-again') }}</a>
    </div>

    @include('effect.html')

@endsection

@section('content_after')
    @include('effect.scripts')
@endsection