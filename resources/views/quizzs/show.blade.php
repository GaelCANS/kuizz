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
                {!! Form::text( 'name' , null , array( 'class' => 'form-control' , 'placeholder' => "Saisissez le nom du quizz" ) ) !!}
            </div>
        </div>
    </div>

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