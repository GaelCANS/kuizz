@extends('backoff.app')

@section('content')

    <div class="row">
        <div class="col-md-8 text-center">
            <h2 class="page-title text-center d-inline-block mx-auto">
                @if( $quizz == null ) Création @else Édition @endif du quizz @if( $quizz != null ) @endif
            </h2>
        </div>

        <div class="col-md-4">
            <div class="float-right">
                <a href="{{action('QuizzController@export', $quizz)}}" class="btn btn-danger"><i class="mdi mdi-download"></i> Export vers Excel</a>
                <a href="{{action('QuizzController@index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link" href="{{action("QuizzController@show" , $quizz)}}">Paramétrage & Questions</a></li>
        <li class="active nav-item"><a class="nav-link active" href="#">Résultats</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('stats-quizz' , array('id' => $quizz->id))}}">Statistiques</a></li>
    </ul>



    <input class="form-control" id="filter-results" type="text" placeholder="Filtre..">
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">Classement</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Agence</th>
            <th scope="col">Score</th>
            <th scope="col">Temps</th>
            <th scope="col">Envoi</th>
            @if(\Illuminate\Support\Facades\Auth::user()->email == env('SUPER_ADMIN'))
            <th scope="col">Del</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @php
        $i=0;
        @endphp
        @foreach($users as $user)
            @php
            $i++;
            @endphp
        <tr data-link="{{ route('results-user-quizz' , array('quizz_id' => $quizz->id , 'user_id' => $user->id)) }}">
            <th scope="row">
                @if ($i == 1)
                    <img src="{{ URL::to('/') }}/img/medal-or.png" title="Premier">
                @elseif($i == 2)
                    <img src="{{ URL::to('/') }}/img/medal-argent.png" title="Second">
                @elseif($i == 3)
                    <img src="{{ URL::to('/') }}/img/medal-bronze.png" title="Troisième">
                @else
                    {{$i}}
                @endif
            </th>
            <td class="user-result">{{$user->name}}</td>
            <td class="user-result">{{$user->email}}</td>
            <td>{{$user->agency}}</td>
            <td>{{$user->total}}</td>
            <td>{{$user->duree}}</td>
            <td>@if ($user->sended_at != '0000-00-00 00:00:00') oui @else non @endif</td>
            @if(\Illuminate\Support\Facades\Auth::user()->email == env('SUPER_ADMIN'))
            <td>
                <a href="{{route('hard-destroy', array('id' => $user->id))}}" title="Supprimer" data-confirm="Voulez-vous vraiment supprimer" data-method="delete">
                    <button type="button" class="btn btn-outline-secondary icon-btn">
                        <i class="mdi mdi-delete"></i>
                    </button>
                </a>
            </td>
            @endif
        </tr>
        @endforeach
        </tbody>
    </table>

    @include('quizzs.modal')

@endsection