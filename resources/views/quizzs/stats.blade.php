@extends('backoff.app')

@section('content')

    <div class="row">
        <div class="col-md-8 text-center">
            <h2 class="page-title text-center d-inline-block mx-auto">
                @if( $quizz == null ) Création @else Édition @endif du quizz @if( $quizz != null ) @endif
            </h2>
        </div>

        <div class="col-md-4">
            <div class="float-right">
                <a href="{{action('QuizzController@index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link" href="{{action("QuizzController@show" , $quizz)}}">Paramétrage & Questions</a></li>
        <li class="nav-item "><a class="nav-link " href="{{route('results-quizz' , array('id' => $quizz->id))}}">Résultats</a></li>
        <li class="nav-item active"><a class="nav-link active" href="#">Statistiques</a></li>
    </ul>

    @if($quizz->show_agencies)
    <div class="row">
        <div class="col-md-12">
            {!! Form::select( 'agency_id' , $agencies , $agency_id , array( 'class' => 'form-control', 'id' => 'stat-agency', 'basepath' => route('stats-quizz' , array('id' => $quizz->id))) ) !!}
        </div>
    </div>
    @endif

    <div class="row">
        @include('quizzs.stats-box', array('icon' => 'basket' , 'class' => 'success' , 'libelle' => 'Meilleure note' , 'value' => $best))
        @include('quizzs.stats-box', array('icon' => 'chart-line-stacked' , 'class' => 'warning' , 'libelle' => 'Pire note' , 'value' => $worst))
        @include('quizzs.stats-box', array('icon' => 'diamond' , 'class' => 'info' , 'libelle' => 'Note moyenne' , 'value' => $average))
        @include('quizzs.stats-box', array('icon' => 'rocket' , 'class' => 'danger' , 'libelle' => 'Nombre de participants' , 'value' => $participants))
    </div>

    <ul>
        @foreach($quizz->questions as $question)
            <li>{{$question->wording}}</li>
            @php
            $question->load('Answers')
            @endphp
            <ul>
                @foreach($question->answers as $answer)
                    <li class="@if($answer->good)good @else wrong @endif">
                        <input type="checkbox" disabled>
                        {{$answer->wording}}
                        <small>({{\App\Answer::percentAnswered($answer->id, $question->id, $agency_id)}}% de réponses)</small>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </ul>


@endsection