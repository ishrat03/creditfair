<?php

namespace App\Http\Controllers;
use App\Models\Companies as Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

class Companies extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		Paginator::useBootstrap();
		$limit = 10;
		$data['company'] = Company::orderBy('id', 'DESC')->paginate($limit);

		return view('company/index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('company/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024|dimensions:min_width=100,min_height=100',
			'name' => 'required|min:3|max:100',
			'email' => 'email',
		]);

		$data = $request->post();
		unset($data['_token']);
		$data['logo'] = 'comming_soon.jpg';

		if ($request->logo !== NULL)
		{
			$imageName = time().'.'.$request->logo->extension();  
			$request->logo->storeAs('public', $imageName);
			$data['logo'] = $imageName;
			unset($imageName);
		}

		if (Company::insert($data))
		{
			return redirect('/company')->with('success','Company Added successfully.');
		}

		return redirect('/company')->with('error','Unable to add Company');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$data['company'] = Company::select([
										'id',
										'name',
										'email',
										'website'
									])
									->find($id)
									->toArray();

		return view('company/update', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$request->validate([
			'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024|dimensions:min_width=100,min_height=100',
			'name' => 'required|min:3|max:100',
			'email' => 'email',
		]);

		$data = $request->input();
		unset($data['_method'], $data['_token']);
		if (!empty($request->logo))
		{
			$image = Company::select('logo')->find($id)->toArray()['logo'];

			Storage::delete('/public/' . $image);
			$imageName = time().'.'.$request->logo->extension();  
			$request->logo->storeAs('public', $imageName);
			$data['logo'] = $imageName;
			unset($image);
		}

		if (Company::where('id', $id)->update($data))
		{
			return redirect('/company')->with('success','Company Updated successfully.');
		}

		return redirect('/company')->with('error','Unable to update Company');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$image = Company::select('logo')->find($id)->toArray()['logo'];

		Storage::delete('/public/' . $image);

		if (Company::where('id', $id)->delete())
		{
			return redirect('/company')->with('success','Company Deleted successfully.');
		}

		return redirect('/company')->with('error','Unable to Delete Company');
	}
}
