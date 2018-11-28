@extends('backoff.app')

@section('content')

    <h4 class="page-title d-inline-block mr-2">
        @if( $quizz == null ) Création @else Édition @endif d'un quizz @if( $quizz != null ) @endif
    </h4>

    <div class="float-right">
        <a href="{{action('QuizzController@index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
    </div>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#">Paramétrage</a></li>
        <li @if($quizz == null) class="disabled" @endif><a href="@if($quizz != null) {{route('results-quizz' , array('id' => $quizz->id))}} @endif">Résultats</a></li>
        <li @if($quizz == null) class="disabled" @endif><a href="@if($quizz != null) {{route('stats-quizz' , array('id' => $quizz->id))}} @endif">Statistiques</a></li>
    </ul>

    {!! Form::model(
        $quizz,
        array(
            'class'     => 'form-horizontal',
            'url'       => action('QuizzController@'.($quizz == null ? 'store' : 'update') , $quizz),
            'method'    => $quizz == null ? 'Post' : 'Put'
        )
    ) !!}

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Nom du quizz</h6>
                {!! Form::text( 'name' , null , array( 'class' => 'form-control' , 'placeholder' => "Saisissez le nom du quizz" , 'id' => 'name-quizz') ) !!}
                {!! Form::hidden( 'url' , null , array( 'class' => 'form-control' , 'id' => 'url-quizz' , 'data-empty' => '' ) ) !!}
                {!! Form::hidden( 'single_response' , null , array( 'class' => 'form-control' , 'id' => 'single_reponse-quizz' , 'data-empty' => '' ) ) !!}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Commentaire</h6>
                {!! Form::textarea( 'comment' , null , array( 'class' => 'form-control' , 'placeholder' => "Un commentaire ?" ) ) !!}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Affichage des réponses <small>(la bonne réponse est affichée immédiatement après la validation)</small></h6>

                <div class="col-lg-10">
                    <div class="radio">
                        {!! Form::label('display_responses-1', 'Oui', ['class' => '']) !!}
                        {!! Form::radio('display_responses', '1', null , ['id' => 'display_responses-1']) !!}

                    </div>
                    <div class="radio">
                        {!! Form::label('display_responses-0', 'Non', ['class' => '']) !!}
                        {!! Form::radio('display_responses', '0', null , ['id' => 'display_responses-0']) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Limiter le quizz aux collaborateurs</h6>

                <div class="col-lg-10">
                    <div class="radio">
                        {!! Form::label('ca_only-1', 'Oui', ['class' => '']) !!}
                        {!! Form::radio('ca_only', '1', null , ['id' => 'ca_only-1']) !!}

                    </div>
                    <div class="radio">
                        {!! Form::label('ca_only-0', 'Non', ['class' => '']) !!}
                        {!! Form::radio('ca_only', '0', null , ['id' => 'ca_only-0']) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Autoriser plusieurs participations</h6>

                <div class="col-lg-10">
                    <div class="radio">
                        {!! Form::label('regame-1', 'Oui', ['class' => '']) !!}
                        {!! Form::radio('regame', '1', null , ['id' => 'regame-1']) !!}

                    </div>
                    <div class="radio">
                        {!! Form::label('regame-0', 'Non', ['class' => '']) !!}
                        {!! Form::radio('regame', '0', null , ['id' => 'regame-0']) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="d-inline-block status">
        {!! Form::select('template_id',$templates , null, ['class' => 'mb-1 select2' , 'id' => 'status-select', 'data-select2-id' => 'status-select']) !!}
    </div>

    <div class="d-inline-block status">
        {!! Form::select('user_id',$users , null, ['class' => 'mb-1 select2' , 'id' => 'status-select', 'data-select2-id' => 'status-select']) !!}
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Timeur <small>(0 pour ne pas mettre de limite de temps)</small></h6>
                {!! Form::text( 'timing' , null , array( 'class' => 'form-control' , 'placeholder' => "Indiquez le temps en secondes par question" ) ) !!}
            </div>
        </div>
    </div>

    <ul id="container-questions" class="sortable" data-quizz="{{ $quizz != null ? $quizz->id : 0 }}">
        @if (!empty($quizz->questions))
            @forelse($quizz->questions as $question)
                @include('questions.show')
                @empty
            @endforelse
        @endif
    </ul>

    @if ($quizz != null)
        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <button type="button" class="btn btn-secondary" id="add-question" data-link="{{ action('QuestionController@store') }}">
                        <i class="fa fa-fw fa-save"></i>Nouvelle question
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-fw fa-save"></i>Enregister
                </button>
            </div>
        </div>
    </div>

    </div>

    {!! Form::close() !!}

    </div>

@endsection