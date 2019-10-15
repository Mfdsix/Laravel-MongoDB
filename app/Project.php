<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Project extends Eloquent
{
	protected $connection = 'mongodb';
    protected $fillable = [
    	'title', 'start', 'status', 'user_id'
    ];
}
