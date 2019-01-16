@extends('backoff.app')

@section('content')
    <h4 class="page-title d-inline-block mr-2">
        @if( $agency == null ) Création @else Édition @endif d'une agence @if( $agency != null ) @endif
    </h4>

    <div class="float-right">
        <a href="{{action('AgencyController@index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
    </div>

    {!! Form::model(
        $agency,
        array(
            'class'     => 'form-horizontal',
            'url'       => action('AgencyController@'.($agency == null ? 'store' : 'update') , $agency),
            'method'    => $agency == null ? 'Post' : 'Put'
        )
    ) !!}

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Nom du template</h6>
                {!! Form::text( 'name' , null , array( 'class' => 'form-control' , 'placeholder' => "Saisissez le nom de l'agence" ) ) !!}
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

    {!! Form::close() !!}





@endsection