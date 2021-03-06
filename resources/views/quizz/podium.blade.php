@extends('frontoff.app' , array('template' => $quizz->template))

@section('content')

    <h2>&nbsp;</h2>
    <ul id="podium" ids="{{ implode('-', $ids) }}" max="{{$quizz->countQuestion}}" page="0" data-link="{{route('reload-podium-quizz', array('name' => $quizz->url))}}">
        @include('quizz.podium-list')
    </ul>


    <div class="bottom">{{ trans('quizz.'.$quizz->template->texts.'.participants') }} :
        <div id="nb-participants">
            {{$participants}}
        </div>
    </div>

