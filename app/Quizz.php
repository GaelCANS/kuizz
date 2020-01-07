<?php

namespace App;

use App\Library\Traits\Scopable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quizz extends Model
{
    use Scopable;

    protected $guarded = array('id');


    public function getCountQuestionAttribute()
    {
        return $this->howmuch == 0 ? $this->questions->count() : $this->howmuch;
    }

    public function shuffleOrder()
    {
        $questions = $this->questions;
        $array = array();
        foreach ($questions as $question) {
            $array[] = $question->id;
        }
        shuffle($array);
        if ($this->howmuch > 0) {
            return array_slice($array,0,$this->howmuch);
        }
        return $array;
    }

    public static function urlIsUnique($quizz,$url)
    {
        return Quizz::where('id','!=',$quizz->id)->where('url',$url)->count() == 0;
    }

    /**
     * Return user's score
     *
     * @param $user
     * @return int
     */
    public static function score($user)
    {
        return DB::table('question_user')->where('user_id' , $user->id)->sum('score');
    }

    /**
     * Return user's time
     *
     * @param $user
     * @return int
     */
    public static function duree($user)
    {
        return $user->created_at->diffInSeconds($user->finished_at);
    }

    /**
     * Return user's rank
     *
     * @param $user
     * @return array
     */
    public static function rank($user)
    {
        $users = User::whereQuizzId($user->quizz_id)->where('finished_at' , '!=','0000-00-00 00:00:00')->pluck('id')->toArray();
        DB::statement(DB::raw('SET @cpt=0'));
        $sql = "

				SELECT * FROM (

					SELECT (@cpt:= @cpt + 1) AS increment, resultats.*
					FROM(
						SELECT
							SUM(score) total,
							u.name,
							u.id,
							TIMESTAMPDIFF(SECOND,u.created_at,u.finished_at) AS duree
						FROM question_user au
							INNER JOIN users u ON u.id = au.user_id AND u.id IN (".implode($users,',').")
						WHERE u.finished_at != '0000-00-00 00:00:00'
						GROUP BY user_id
						ORDER BY total DESC, duree ASC
					) AS resultats

				) AS final WHERE id = ".$user->id.";
			";
        return DB::select($sql);

    }

    /**
     * Return top ranking
     *
     * @param $nb
     * @param $page
     * @param $quizz
     * @return collection
     */
    public static function top($nb, $page,$quizz,$agency_id=0)
    {
        $from = $page > 0 ? $page*$nb : 0;

        return DB::table('question_user AS au')
            ->select(
                DB::raw('SUM(score) total, (SUM(score)*100/'.$quizz->countQuestion.') AS percent , u.name , u.email , u.id , u.sended_at , TIMESTAMPDIFF(SECOND,u.created_at,u.finished_at) AS duree, a.name AS agency, u.agency_id')
            )
            ->join('users AS u','u.id','=','au.user_id')
            ->leftJoin('agencies AS a','a.id','=','u.agency_id')
            ->where('u.quizz_id','=',$quizz->id)
            ->where('u.agency_id', ($agency_id == 0 ? '>' : '=') , ($agency_id == 0 ? '-1': $agency_id) )
            ->where("u.finished_at", "!=", "0000-00-00 00:00:00")
            ->groupBy('user_id')
            ->orderBy('total' , 'desc')
            ->orderBy('duree' , 'asc')
            ->offset($from)
            ->limit($nb)
            ->get();
    }

    /**
     * Return users number
     *
     * @param $quizz
     * @return int
     */
    public static function participants($quizz, $agency_id = 0)
    {
        if ($agency_id == 0)
            return User::whereQuizzId($quizz->id)->where('finished_at' , '!=','0000-00-00 00:00:00')->count();
        else
            return User::whereQuizzId($quizz->id)->whereAgencyId($agency_id)->where('finished_at' , '!=','0000-00-00 00:00:00')->count();
    }

    public static function sendableUsers($id)
    {
        return User::whereQuizzId($id)->where('sended_at' , '=' , '0000-00-00 00:00:00')->inRandomOrder()->get();
    }

    public function scopeFilter($query, $datas)
    {
        // Keywords
        if (!empty($datas->keywords)) {

            $keywords = trim($datas->keywords);
            $query->where( function ($q) use ($keywords) {

                $q->where('name', 'LIKE', '%'.$keywords.'%')
                    ->orWhere('url', 'LIKE', '%'.$keywords.'%')
                    ->orWhere('comment', 'LIKE', '%'.$keywords.'%');
            }
            );
        }

        // Users
        if (!empty($datas->user)) {
            $query->whereUserId( $datas->user );
        }

        return $query;
    }


    public function getSendableAttribute()
    {
        return count(self::sendableUsers($this->id)) > 0 ? 1 : 0;
    }


    // 1 to many
    public function questions()
    {
        return $this->hasMany('App\Question')->where('delete',0)->orderBy('order' , 'ASC');
    }

    // 1 to many
    public function users()
    {
        return $this->hasMany('App\User');
    }

    // many to 1
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // 1 to 1
    public function template()
    {
        return $this->belongsTo('App\Template');
    }
}
