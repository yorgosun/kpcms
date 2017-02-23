<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kepan;
use App\Models\Sutra;
use App\Models\Shuwen;
use Auth;

class KepanController extends Controller
{
    //
	private $levelnumber = array('甲'=>'A',
								'乙'=>'B',
								'丙'=>'C',
								'丁'=>'D',
								'戊'=>'E',
								'己'=>'F',
								'庚'=>'G',
								'辛'=>'H',
								'壬'=>'I',
								'癸'=>'J',
								'子'=>'K',
								'丑'=>'L',
								'寅'=>'M',
								'卯'=>'N',
								'辰'=>'O',
								'巳'=>'P',
								'午'=>'Q',
								'未'=>'R',
								'申'=>'S',
								'酉'=>'T',
								'戌'=>'U',
								'亥'=>'V'
							);

	private $levelname = array('甲','乙', '丙', '丁', '戊', '己', '庚', '辛', '壬', '癸','子','丑','寅','卯','辰','巳','午','未','申','酉','戌','亥');

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index($sutraid)
	{
		$sutra = Sutra::find($sutraid);
		if (empty($sutra)) {
			//错误处理
			exit();
		}

		$kepan = Kepan::where('sutra_id', $sutraid)->orderBy('id', 'desc')->paginate(15);
		return view('kepan.list', ['sutra'=>$sutra, 'kepan'=>$kepan]);
	}

	public function create($sutraid, $kpid)
	{
		if ($kpid>0) {
			$parent = Kepan::find($kpid);
			$main_parent = $parent;
			$output_str = $parent->levelname.$parent->sequence.' '.$parent->title;
			while ($parent->parent_id > 0) {
				$parent = $parent->parent;
				$output_str = $parent->levelname.$parent->sequence.' '.$parent->title.' > '.$output_str;
			}
			$ret = array_search($main_parent->levelname, $this->levelname);
			if ($ret < 21) {
				$next_levelname = $this->levelname[$ret+1];
			} else {
				$next_levelname = '';
			}

		} else {
			$output_str = '顶级';
			$main_parent = null;
			$next_levelname = '甲';
		}


		$sutra = Sutra::find($sutraid);
		if (empty($sutra)) {
			//错误处理
			exit();
		}

		return view('kepan.form', ['sutra'=>$sutra, 'parent'=>$main_parent, 'parent_id'=>$kpid, 'parent_str'=>$output_str, 'next_levelname'=>$next_levelname]);
	}

	public function store(Request $request)
	{
		//TODO validate

		$kepan = new Kepan();
		$kepan->sutra_id = $request->input('sutraid');
		$kepan->parent_id = $request->input('parentid');
		$kepan->levelname = $request->input('levelname');
		$kepan->levelnumber = $this->levelnumber[$request->input('levelname')];
		$kepan->sequence = $request->input('sequence');
		$kepan->title = $request->input('title');
		$kepan->content = $request->input('content');
		$kepan->pin = $request->input('pin');
		$kepan->juan = $request->input('juan');
		$kepan->page = $request->input('page');
		$kepan->user_id = Auth::id();
		$kepan->save();

		return redirect('/sutras/'.$request->input('sutraid').'/kepans');

	}

	public function show($kpid)
	{
		$kepan = Kepan::find($kpid);
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

		$shu = Shuwen::where('kepan_id', $kpid)->orderBy('sequence', 'asc')->get();

		return view('kepan.view', ['sutra'=>$sutra, 'parent'=>$main_parent, 'parent_id'=>$parent_id, 'parent_str'=>$output_str, 'edit'=>1, 'kepan'=>$kepan, 'shu'=>$shu]);
	}

	public function edit($kpid)
	{
		$kepan = Kepan::find($kpid);
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

		return view('kepan.form', ['sutra'=>$sutra, 'parent'=>$main_parent, 'parent_id'=>$parent_id, 'parent_str'=>$output_str, 'edit'=>1, 'kepan'=>$kepan]);
	}

	public function update(Request $request)
	{
		$kepan = Kepan::find($request->input('kepanid'));
		$kepan->levelname = $request->input('levelname');
		$kepan->levelnumber = $this->levelnumber[$request->input('levelname')];
		$kepan->sequence = $request->input('sequence');
		$kepan->title = $request->input('title');
		$kepan->content = $request->input('content');
		$kepan->pin = $request->input('pin');
		$kepan->juan = $request->input('juan');
		$kepan->page = $request->input('page');
		$kepan->user_id = Auth::id();
		$kepan->save();

		return redirect('/sutras/'.$request->input('sutraid').'/kepans');
	}

	public function destroy($kpid)
	{
		Kepan::destroy($kpid);
		return '1';
	}
}
