<?php
class Service extends Eloquent  {
 
     
    public $timestamps= false;
    protected $table = 'services';
  
   //laravel internamente crea la tabla que se forma como pivote
   //un estudiante tiene muchos cursos


 
     public function places()
    {
        return $this->belongsToMany('Place','service_place')->withPivot('id');
    }




}