@extends('frontoff.app' , array('template' => $quizz->template))

@section('content')

    <div class="text-center mx-auto">
        <h1 style="max-width:700px;">
            {{$quizz->comment}}
        </h1>
        <a href="{{route('rules-quizz' , array('name' => $quizz->url))}}" class="btn btn-primary" >{{ trans('quizz.'.$quizz->template->texts.'.btn-start') }}</a>
    </div>


@endsection