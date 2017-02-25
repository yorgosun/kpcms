<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shuwen extends Model
{
    //

	public function kepan()
	{
		return $this->belongsTo('App\Models\Kepan');
	}
}
