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


    public static function grade()
    {

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
     * Return users number
     *
     * @param $quizz
     * @return int
     */
    public static function participants($quizz)
    {
        return User::whereQuizzId($quizz->id)->where('finished_at' , '!=','0000-00-00 00:00:00')->count();
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

    // 1 to 1
    public function template()
    {
        return $this->belongsTo('App\Template');
    }
}
