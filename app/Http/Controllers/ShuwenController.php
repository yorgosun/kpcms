<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shuwen;

class ShuwenController extends Controller
{
    //

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function store(Request $request)
	{
		$ret = Shuwen::where('kepan_id', $request->input('kepanid'))->max('sequence');

		if ($ret === null) {
			$sequence = 1;
		} else {
			$sequence = $ret + 1;
		}

		$shuwen = new Shuwen();
		$shuwen->shu = $request->input('shuwencontent');
		$shuwen->chao = $request->input('chaowencontent');
		$shuwen->kepan_id = $request->input('kepanid');
		$shuwen->sequence = $sequence;
		$shuwen->save();

		return redirect('/kepans/'.$request->input('kepanid'));
	}

	public function update(Request $request)
	{

	}
}
