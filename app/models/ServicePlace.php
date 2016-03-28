<?php
class ServicePlace extends Eloquent  {
 
     
    public $timestamps= false;
    protected $table = 'service_place';
    protected $fillable = array('service_id', 'place_id');
     

    public function lugares()
   {
    return $this->belongsToMany('Place','service_place')->withPivot('id');
   }


