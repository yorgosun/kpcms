<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sutra;
use Auth;

class SutraController extends Controller
{
    //
	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
		$allsutra = Sutra::orderBy('pinid', 'asc')->get();

		return view('sutra.list', ['sutras' => $allsutra]);
	}

	public function create()
	{
		return view('sutra.form');
	}

	public function store(Request $request)
	{

		$sutra = new Sutra();
		$sutra->user_id = Auth::id();
		$sutra->title = $request->input('title');
		$sutra->hui = $request->input('hui');
		$sutra->pin = $request->input('pin');
		$sutra->pinid = $request->input('pinid');
		$sutra->juan = '';
		$sutra->save();

		return redirect()->action('SutraController@index');

	}

	public function edit($sutraid)
	{
		$sutra = Sutra::find($sutraid);
		return view('sutra.form', ['sutra'=>$sutra, 'edit'=>1]);
	}

	public function update(Request $request)
	{
		$sutra = Sutra::find($request->input('sutraid'));
		$sutra->user_id = Auth::id();
		$sutra->title = $request->input('title');
		$sutra->hui = $request->input('hui');
		$sutra->pin = $request->input('pin');
		$sutra->pinid = $request->input('pinid');
		$sutra->juan = '';
		$sutra->save();

		return redirect()->action('SutraController@index');
	}
}
