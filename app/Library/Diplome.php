<?php

namespace App\Library;




use App\Grade;
use App\Quizz;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Intervention\Image\Facades\Image;

class Diplome
{
    /**
     * @var instance of user
     */
    protected $user;

    /**
     * @var instance of quizz
     */
    protected $quizz;

    /**
     * @var instance of grade
     */
    protected $grade;

    /**
     * @var instance of img
     */
    protected $img;

    /**
     * @var string default font
     */
    protected $font = '/font/Chewy.ttf';

    /**
     * Diplome constructor.
     * @param $quizz
     * @param $user
     */
    public function __construct($quizz, $user)
    {
        $this->user  = $user;
        $this->quizz = $quizz;
    }

    /**
     *
     */
    public function getDiplome()
    {
        return $this->draw();
    }

    /**
     * Generate the diplome image
     *
     * @return string
     */
    private function draw()
    {
        $this->img = Image::make(public_path().'/img/'.$this->quizz->template->texts.'/diplome.jpg');
        $this->texted();
        $this->imaged();
        return $this->store();
    }

    /**
     * Add images on diplome
     */
    private function imaged()
    {
        $this->img->insert(public_path().'/img/'.$this->quizz->template->texts.'/'.$this->grade->slug.'.jpg', '' , 765 , 550);
    }

    /**
     * Add texts on diplome
     */
    private function texted()
    {
        // txt Date
        $this->addText(Carbon::now()->format('d/m/Y'),(int) trans('quizz.'.$this->quizz->template->texts.'.diplome-date-font'),trans('quizz.'.$this->quizz->template->texts.'.diplome-color1'),(int) trans('quizz.'.$this->quizz->template->texts.'.diplome-date-x'),(int) trans('quizz.'.$this->quizz->template->texts.'.diplome-date-y'));
        // txt Nom
        $this->addText($this->user->name,trans('quizz.'.$this->quizz->template->texts.'.diplome-nom-font'),trans('quizz.'.$this->quizz->template->texts.'.diplome-color1'),trans('quizz.'.$this->quizz->template->texts.'.diplome-nom-x'),trans('quizz.'.$this->quizz->template->texts.'.diplome-nom-y'));
        // txt Score
        $score = Quizz::score($this->user);
        $this->addText($score,trans('quizz.'.$this->quizz->template->texts.'.diplome-score-font'),trans('quizz.'.$this->quizz->template->texts.'.diplome-color1'),trans('quizz.'.$this->quizz->template->texts.'.diplome-score-x'),trans('quizz.'.$this->quizz->template->texts.'.diplome-score-y'));
        // txt Temps
        $this->addText(Quizz::duree($this->user),trans('quizz.'.$this->quizz->template->texts.'.diplome-tps-font'),trans('quizz.'.$this->quizz->template->texts.'.diplome-color1'),trans('quizz.'.$this->quizz->template->texts.'.diplome-tps-x'),trans('quizz.'.$this->quizz->template->texts.'.diplome-tps-y'));
        // txt Grade
        $this->grade = $grade = Grade::getGrade($this->quizz->template, round(($score*100)/$this->quizz->questions->count()) );
        $this->addText("Votre niveau : ".$grade->name,trans('quizz.'.$this->quizz->template->texts.'.diplome-grade-font'),trans('quizz.'.$this->quizz->template->texts.'.diplome-color1'),trans('quizz.'.$this->quizz->template->texts.'.diplome-grade-x'),trans('quizz.'.$this->quizz->template->texts.'.diplome-grade-y'));
    }

    /**
     * Write text
     *
     * @param $text
     * @param $size
     * @param $color
     * @param $x
     * @param $y
     */
    private function addText($text, $size, $color, $x, $y)
    {
        $this->img->text($text, $x, $y, function($font) use ($size, $color , $x) {
            $font->file(public_path().$this->font);
            $font->size($size);
            if ( $x == 0 )
                $font->align('center');
            $font->color($color);
        });

    }

    /**
     * Save diplome in tmp directory
     *
     * @return string
     */
    private function store()
    {
        // Dossier tmp dans le public_dir - utile pour les tests
         $name = public_path().'/tmp/diplome-'.$this->user->id.'.jpg';
        // Dossier tmp de laravel
        //$name = sys_get_temp_dir()  .'/diplome-'.$this->user->id.'.jpg';
        $this->img->save($name);
        return $name;
    }

    /**
     * Delete diplome
     *
     * @param $user
     */
    public static function delete($user)
    {

    }
}