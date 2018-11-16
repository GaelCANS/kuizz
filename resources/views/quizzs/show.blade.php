@extends('backoff.app')

@section('content')

    <h4 class="page-title d-inline-block mr-2">
        @if( $quizz == null ) Création @else Édition @endif d'un quizz @if( $quizz != null ) @endif
    </h4>

    <div class="float-right">
        <a href="{{action('QuizzController@index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
    </div>

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