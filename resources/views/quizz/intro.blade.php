@extends('frontoff.app' , array('template' => $quizz->template))

@section('content')

    <div class="text-center mx-auto">
        <h1 style="max-width:700px;">
            {{$quizz->comment}}
        </h1>
        @if ($quizz->intro != "")
            <!--<div class="row">
                <div class="col-md-2">&nbsp;</div>
                <div class="col-md-8">
                    {{$quizz->intro}}
                </div>
                <div class="col-md-2">&nbsp;</div>
            </div>-->
        <div style="max-width: 700px; margin-bottom: 30px; text-align: justify;font-size: 1.1em;">
            {{$quizz->intro}}
        </div>
        @endif
        <a href="{{route('rules-quizz' , array('name' => $quizz->url))}}" class="btn btn-primary" >{{ trans('quizz.'.$quizz->template->texts.'.btn-start') }}</a>
    </div>


@endsection