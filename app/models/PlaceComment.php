<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class PlaceComment extends Eloquent implements UserInterface, RemindableInterface {

    use HasRole;
	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'place_comments';
    protected $fillable = array('user_id', 'place_id', 'comentario');

    public function user()
    {
        return $this->hasOne('User','id', 'user_id');
    }

    public function place()
    {
        return $this->hasOne('Place','id', 'place_id');
    }

}
