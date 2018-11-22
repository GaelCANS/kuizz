@extends('backoff.app')

@section('content')
    <ul class="nav nav-tabs">
        <li class="active"><a href="#">Template</a></li>
        <li @if($template == null) class="disabled" @endif><a href="@if($template != null) {{route('list-grade' , array('list-grade' => $template->id))}} @endif">Grades</a></li>
    </ul>

    <h4 class="page-title d-inline-block mr-2">
        @if( $template == null ) Création @else Édition @endif d'un template @if( $template != null ) @endif
    </h4>

    <div class="float-right">
        <a href="{{action('TemplateController@index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
    </div>

    {!! Form::model(
        $template,
        array(
            'class'     => 'form-horizontal',
            'url'       => action('TemplateController@'.($template == null ? 'store' : 'update') , $template),
            'method'    => $template == null ? 'Post' : 'Put'
        )
    ) !!}

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Nom du template</h6>
                {!! Form::text( 'name' , null , array( 'class' => 'form-control' , 'placeholder' => "Saisissez le nom du template" ) ) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Feuille de style associée</h6>
                {!! Form::text( 'stylesheet' , null , array( 'class' => 'form-control' , 'placeholder' => "Saisissez la feuille de style associée" ) ) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Textes associés</h6>
                {!! Form::text( 'texts' , null , array( 'class' => 'form-control' , 'placeholder' => "Saisissez le fichier de texte" ) ) !!}
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