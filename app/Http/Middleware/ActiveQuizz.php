<?php

namespace App\Http\Middleware;

use App\Quizz;
use Closure;

class ActiveQuizz
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $parameters = $request->route()->parameters();
        $quizz = Quizz::whereUrl($parameters['name'])->first();

        return $quizz->active == '0' ? $next($request) : redirect()->route('inactive-quizz', array('name' => $parameters['name']));
    }
}
