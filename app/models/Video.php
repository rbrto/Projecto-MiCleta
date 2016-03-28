<?php
class Video extends Eloquent  {
 
     
    public $timestamps= false;
    protected $table = 'videos';
     

    public function usuarios()
   {
    return $this->belongsToMany('User','user_video')->withPivot('id','fecha');
   }
}