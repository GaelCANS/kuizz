@extends('backoff.app')

@section('content')

    <h4 class="page-title d-inline-block mr-2">
        @if( $quizz == null ) Création @else Édition @endif d'un quizz @if( $quizz != null ) @endif
    </h4>

    <div class="float-right">
        <a href="{{action('QuizzController@index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
    </div>

    <ul class="nav nav-tabs">
        <li><a href="{{action("QuizzController@show" , $quizz)}}">Paramétrage</a></li>
        <li class="active"><a href="{{route('results-quizz' , array('id' => $quizz->id))}}">Résultats</a></li>
        <li><a href="#">Statistiques</a></li>
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