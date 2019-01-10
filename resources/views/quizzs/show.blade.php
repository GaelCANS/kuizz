@extends('backoff.app')

@section('content')
    <div class="row">
        <h2 class="page-title text-center d-inline-block mx-auto">
            @if( $quizz == null ) Création @else Édition @endif du quizz @if( $quizz != null ) @endif
        </h2>

        <div class="float-right">
            <a href="{{action('QuizzController@index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-fw fa-save"></i>Enregister
            </button>
            @if($quizz != null)
                <a href="{{route('intro-quizz' , array('name' => $quizz->url))}}" target="_blank" class="btn btn-primary"><i class="fa fa-angle-left"></i> Voir le quizz</a>
            @endif
        </div>
    </div>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#">Paramétrages & Questions</a></li>
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
        <div class="col-4">
            <div class="col-12">
                <div class="form-group">
                    <h6>Nom du quizz</h6>
                    {!! Form::text( 'name' , null , array( 'class' => 'form-control' , 'placeholder' => "Saisissez le nom du quizz" , 'id' => 'name-quizz') ) !!}
                    {!! Form::hidden( 'url' , null , array( 'class' => 'form-control' , 'id' => 'url-quizz' , 'data-empty' => '' ) ) !!}
                    {!! Form::hidden( 'single_response' , null , array( 'class' => 'form-control' , 'id' => 'single_reponse-quizz' , 'data-empty' => '' ) ) !!}
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <h6>Slogan</h6>
                    {!! Form::text( 'comment' , null , array( 'class' => 'form-control' , 'placeholder' => "Un commentaire ?" ) ) !!}
                </div>
            </div>

            <div class="row px-0 mx-0">

                <div class="col-6 d-inline-block status">
                    <h6>Thème</h6>
                    {!! Form::select('template_id',$templates , null, ['class' => 'mb-1 select2' , 'id' => 'status-select', 'data-select2-id' => 'status-select']) !!}
                </div>



                <div class="col-6">
                    <div class="form-group">
                        <h6>Temps par question<small> (0 = illimité)</small></h6>
                        {!! Form::text( 'timing' , null , array( 'class' => 'form-control' , 'placeholder' => "Indiquez le temps en secondes par question" ) ) !!}
                    </div>
                </div>
            </div>



            <div class="row">


                <div class=" col-6 d-none status">
                    <h6>Responsable</h6>
                    {!! Form::select('user_id',$users , null, ['class' => 'mb-1 select2' , 'id' => 'status-select', 'data-select2-id' => 'status-select']) !!}
                </div>

            </div>
            <div class="row">


                <div class="col-6">
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




                <div class="col-6">
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


                <div class="col-6">
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

</div>
        <div class="col-8">
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

        </div>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="fa fa-fw fa-save"></i>Enregister
    </button>

    </div>

    {!! Form::close() !!}

    </div>

@endsection