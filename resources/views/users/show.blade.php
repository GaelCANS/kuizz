@extends('backoff.app')

@section('content')



    <h4 class="page-title d-inline-block mr-2">
        @if( $user == null ) Création d'un utilisateur @else @if ( $route =="show-user") Mise à jour utilisateur @else Mon compte @endif @endif
    </h4>


    <div class="float-right">
        <a href="{{route('users-index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
    </div>


    {!! Form::model(
        $user,
        array(
            'class'     => 'form-horizontal',
            'url'       => action('UserController@'.($user == null ? 'store' : 'update') , $user),
            'files'    => true ,
            'method'    => $user == null ? 'Post' : 'Put'
        )
    ) !!}

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <h6>Nom</h6>
                {!! Form::text( 'name' , null , array( 'class' => 'form-control' , 'placeholder' => "Saisissez votre nom"  ) ) !!}
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <h6>Email</h6>
                {!! Form::email( 'email' , null , array( 'class' => 'form-control' , 'placeholder' => "Saisissez votre email" , ($user == null || $route == 'show-user' ? '' : 'disabled') ) ) !!}
            </div>
        </div>

    </div>
    @if ($route == 'show-user' || $user==null)

        <div class="form-group">

            <div class="col-lg-10">
                <div class="radio">
                    {!! Form::label('admin1', 'Oui', ['class' => '']) !!}
                    {!! Form::radio('admin', '1', null , ['id' => 'admin1']) !!}

                </div>
                <div class="radio">
                    {!! Form::label('admin0', 'Non', ['class' => '']) !!}
                    {!! Form::radio('admin', '0', null, ['id' => 'admin0']) !!}
                </div>
            </div>
        </div>

    @endif
    @if ($user != null && $route != 'show-user')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h6>Nouveau mot de passe</h6>
                    {!! Form::password( 'password' , array( 'class' => 'form-control') ) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h6>Confirmer le nouveau mot de passe</h6>
                    {!! Form::password( 'password_confirmation'  , array( 'class' => 'form-control' ) ) !!}
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

    {!! Form::close() !!}

    </div>

@endsection