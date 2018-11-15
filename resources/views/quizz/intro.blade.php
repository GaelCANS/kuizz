@extends('frontoff.app' , array('template' => $quizz->template->stylesheet))

@section('content')

    <div class="col-md-12 text-center">
        <div>
            {{$quizz->comment}}
        </div>
        <a href="{{route('rules-quizz' , array('name' => $quizz->url))}}" class="btn btn-primary" >{{ trans('quizz.'.$quizz->template->texts.'.btn-start') }}</a>
    </div>


@endsection