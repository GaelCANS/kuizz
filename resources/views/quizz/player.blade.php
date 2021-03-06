@extends('frontoff.app' , array('template' => $quizz->template))

@section('content')

<h2>{{ trans('quizz.'.$quizz->template->texts.'.title-player') }}</h2>

{!! Form::model(
    null,
    array(
        'class'     => 'form-horizontal player',
        'url'       => action('QuizzController@newPlayer' , $quizz->url),
        'method'    => 'Post'
    )
) !!}

    <div class="form-group">
        {!! Form::text( 'name' , null , array( 'class' => 'form-control' , 'placeholder' => "Prénom *" , 'autocomplete' => 'off' , 'aria-describedby' => "pseudoHelp" , 'id' => "pseudo") ) !!}
    </div>

    @if ($quizz->show_agencies)
        <div class="form-group">
            {!! Form::select( 'agency_id' , $agencies , null , array( 'class' => 'form-control') ) !!}
        </div>
    @endif

    <div class="form-group">
        {!! Form::text( 'email' , null , array( 'class' => 'form-control' , 'placeholder' => "Un p'tit mail ? *" , 'autocomplete' => 'off' , 'aria-describedby' => "pseudoHelp" , 'id' => "email") ) !!}
    </div>

    <button type="submit" class="btn btn-primary">{{ trans('quizz.'.$quizz->template->texts.'.btn-player') }}</button>

{!! Form::close() !!}

@endsection