<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kepan;
use App\Models\Sutra;

class KepanPreviewController extends Controller
{
    //

	public function index($sutraid)
	{
		$sutra = Sutra::find($sutraid);
		$kepanlist = $this->getChildNodeInfo(0, $sutraid);
		return view('kepanpreview.view', ['kepanlist'=>$kepanlist, 'sutra'=>$sutra]);
	}

	private function getChildNodeInfo($kpid, $sutraid)
	{
		$output_array = array();

		$ret = Kepan::where('sutra_id', $sutraid)->where('parent_id', $kpid)->orderBy('sequence')->get();
		if (empty($ret)) {
			return false;
		}

		foreach ($ret as $item) {
			$output_array[] = $item;
			$tmp = $this->getChildNodeInfo($item->id, $sutraid);
			if (is_array($tmp)) {
				$output_array = array_merge($output_array, $tmp);
			}
		}

		return $output_array;
	}

	public function preview($sutraid)
	{
		$sutra = Sutra::find($sutraid);
		$kepanlist = $this->getChildNodeInfo(0, $sutraid);
		return view('kepanpreview.index', ['kepanlist'=>$kepanlist, 'sutra'=>$sutra]);
	}
}
