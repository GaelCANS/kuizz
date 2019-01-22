@extends('backoff.app')

@section('content')

    <h4 class="page-title d-inline-block mr-2">
        @if( $quizz == null ) Création @else Édition @endif d'un quizz @if( $quizz != null ) @endif
    </h4>

    <div class="float-right">
        <a href="{{action('QuizzController@export', $quizz)}}" class="btn btn-danger"><i class="mdi mdi-download"></i> Export vers Excel</a>
        <a href="{{action('QuizzController@index')}}" class="btn btn-info"><i class="fa fa-angle-left"></i> Retour</a>
    </div>

    <ul class="nav nav-tabs">
        <li><a href="{{action("QuizzController@show" , $quizz)}}">Paramétrage</a></li>
        <li class="active"><a href="#">Résultats</a></li>
        <li><a href="{{route('stats-quizz' , array('id' => $quizz->id))}}">Statistiques</a></li>
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
        <tr data-link="{{ route('results-user-quizz' , array('quizz_id' => $quizz->id , 'user_id' => $user->id)) }}" class="user-result">
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
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->agency}}</td>
            <td>{{$user->total}}</td>
            <td>{{$user->duree}}</td>
            <td>@if ($user->sended_at != '0000-00-00 00:00:00') oui @else non @endif</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    @include('quizzs.modal')

@endsection