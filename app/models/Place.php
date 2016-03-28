<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class Place extends Eloquent implements UserInterface, RemindableInterface {

    use HasRole;
	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'places';
    protected $fillable = array('user_id', 'type', 'nombre', 'direccion', 'lat', 'lon');
    
    public function comments()
    {
        return $this->hasMany('PlaceComment','place_id');
    }

    public function scores()
    {
        return $this->hasMany('PlaceScore', 'place_id');
    }

    public function services()
   {
    return $this->belongsToMany('Service','service_place')->withPivot('id');
   }

}
