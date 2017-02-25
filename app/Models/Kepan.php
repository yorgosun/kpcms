<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kepan extends Model
{
    //

	public function parent()
	{
		return $this->belongsTo('App\Models\Kepan', 'parent_id');
	}

	public function sutra()
	{
		return $this->belongsTo('App\Models\Sutra');
	}

	public function shuwens()
	{
		return $this->hasMany('App\Models\Shuwen');
	}
}
