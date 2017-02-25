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

	public function edit($swid)
	{
		$shuwen = Shuwen::find($swid);
		$kepan = $shuwen->kepan;
		$sutra = $kepan->sutra;

		$parent_id = $kepan->parent_id;
		$main_parent = $kepan->parent;

		if ($parent_id>0) {
			$parent = $main_parent;
			$output_str = $parent->levelname.$parent->sequence.' '.$parent->title;
			while ($parent->parent_id > 0) {
				$parent = $parent->parent;
				$output_str = $parent->levelname.$parent->sequence.' '.$parent->title.' > '.$output_str;
			}
		} else {
			$output_str = '顶级';
			$main_parent = null;
		}

		return view('shuwen.edit', ['shuwen' => $shuwen, 'sutra' => $sutra, 'parent_str'=>$output_str, 'kepan'=>$kepan]);
	}

	public function update(Request $request, $swid)
	{
		$shuwen = Shuwen::find($swid);
		$shuwen->shu = $request->input('shuwencontent');
		$shuwen->chao = $request->input('chaowencontent');
		$shuwen->kepan_id = $request->input('kepan_id');
		$shuwen->sequence = $request->input('sequence');
		$shuwen->save();

		return redirect('/kepans/'.$request->input('kepan_id'));
	}

	public function destroy($swid)
	{
		Shuwen::destroy($swid);
		return '1';
	}
}
