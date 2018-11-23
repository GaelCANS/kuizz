@php
$i=0;
@endphp

@foreach($tops as $top)
    @php
    $i++;
    $grade = \App\Grade::getGrade($quizz->template, round($top->percent) );
    @endphp
    <li id="user-{{$top->id}}">
        <div class="podium-block">

        </div>
        <div class="stats">

            <ul>
                <li><span id="pource"><span class="percent" pourcent="{{$top->total}}">
          <span class="podium-rang">
          	{{$i}}
              <img src="{{ URL::to('/') }}/img/{{$quizz->template->texts}}/{{$grade->slug}}.jpg" width="30px">
          </span>
          <span class="podium-text">
          	<small>{{$grade->name}}</small>
          </span>
          <span class="podium-score">
          {{$top->total}}/{{$quizz->questions()->count()}}

              ({{$top->duree}}")
        </span>
          <span class="podium-pseudo">
          {{$top->name}}
        </span>
      </span></span></li>
            </ul>
        </div>
    </li>
@endforeach