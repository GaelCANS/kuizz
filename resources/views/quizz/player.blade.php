@extends('frontoff.app' , array('template' => $quizz->template->stylesheet))

@section('content')

<h2>T ki toué ?</h2>
<form method="post" action="index.php?page=register" id="create-user">
    <div class="form-group">
        <input type="text"  name="pseudo" class="form-control" id="pseudo" aria-describedby="pseudoHelp" autocomplete="off" placeholder="Prénom *"  >
    </div>
    <div class="form-group">
        <input type="text"  name="pole" class="form-control" id="pole" aria-describedby="poleHelp" autocomplete="off" placeholder="Nom *"  >
    </div>
    <div class="form-group" style="display: none;">
        <p>Salarié CRNS ?</p>
        <label class="radio-inline">
            <input type="radio" name="crns" value="1" id="crns-1" checked="checked" style="margin:6px -22px!important;">Oui
        </label>
        <label class="radio-inline">
            <input type="radio" name="crns" value="0" id="crns-0" style="margin:6px -22px!important;">Non
        </label>
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" autocomplete="off" placeholder="Un p'tit mail ? *" >
    </div>
    <input type="hidden" name="tartiflette" value="0" >


    <button type="submit" class="btn btn-primary">Goooooooo</button>
</form>

@endsection