@extends('backoff.app')

@section('content')
    <ul class="nav nav-tabs">
        <li class=""><a href="{{action('TemplateController@show' , array('id' => $template->id))}}">Template</a></li>
        <li class="active"><a href="#">Grades</a></li>
    </ul>

    <h4 class="page-title d-inline-block mr-2">
        Liste des grades ({{$template->name}})
    </h4>

    <div class="float-right">
        <a href="{{action('TemplateController@index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
    </div>

    {!! Form::model(
        null,
        array(
            'class'     => 'form-horizontal',
            'url'       => route('update-grades' , array('template_id' => $template->id)),
            'method'    => 'POST'
        )
    ) !!}

    <div id="container-grades" class="" data-template="{{ $template->id }}">
        @if (!empty($template->grades))
            @forelse($template->grades as $grade)
                @include('templates.show-grade')
            @empty
            @endforelse
        @endif
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-md-12">
                <button type="button" class="btn btn-secondary add-grade" data-link="{{ action('GradeController@store') }}">
                    <i class="fa fa-fw fa-save"></i>Nouveau grade
                </button>
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