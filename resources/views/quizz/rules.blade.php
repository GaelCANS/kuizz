@extends('frontoff.app' , array('template' => $quizz->template->stylesheet))

@section('content')

    <h2>Ça rules ?</h2>

    <div class="content-bloc text-center">
        <dl>
            <dt>{{$quizz->questions->count()}} questions</dt>
            <dd>sur le digital (ou pas...)</dd>
        </dl>
        <dl>
            <dt>Un temps @if ($quizz->timing > 0)limité @else illimité @endif</dt>
            <dd>@if ($quizz->timing > 0) {{$quizz->timing}} secondes par question, pas une de plus ! @else Prenez votre temps, c'est cadeau @endif</dd>
        </dl>
        <dl>
            <dt>@if ($quizz->single_response == 0) {{ trans('quizz.'.$quizz->template->texts.'.single-response') }} @else {{ trans('quizz.'.$quizz->template->texts.'.multi-response') }} @endif</dt>
            <dd>stay focus</dd>
        </dl>
        <dl style="margin-bottom:5px!important;">
            <dt>Soyez précis, soyez rapide</dt>
            <dd>pour accrocher la première place </dd>
        </dl>
    </div>

    <div class="col-md-12 text-center">
        <a href="{{route('player-quizz' , array('name' => $quizz->url))}}" class="btn btn-primary" >{{ trans('quizz.'.$quizz->template->texts.'.btn-rules') }}</a>
    </div>


@endsection