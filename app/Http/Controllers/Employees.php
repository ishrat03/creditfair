<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees as Employee;
use App\Models\Companies;

class Employees extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$limit = 10;

		$data['employees'] = Employee::allEmp($limit);

		return view('employee/index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['company'] = Companies::select(array('id', 'name'))->get()->toArray();
		return view('employee/create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate(
			array(
				'first_name' => 'required|min:3|max:20',
				'last_name' => 'required|min:3|max:30',
				'company_id' => 'required',
				'phone' => 'min:10|max:12',
				'email' => 'email',
			)
		);

		$data = $request->post();
		
		unset($data['_token'], $data['_method']);
		if (Employee::insert($data))
		{
			return redirect('/employee')->with('success','Employee Added Successfully.');
		}

		return redirect('/employee')->with('error','Unable to add Employee');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$data['company'] = Companies::select(array('id', 'name'))->get()->toArray();
		$data['employee'] = Employee::find($id)->toArray();
		return view('employee/update', $data);
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
		$request->validate(
			array(
				'first_name' => 'required|min:3|max:20',
				'last_name' => 'required|min:3|max:30',
				'company_id' => 'required',
				'phone' => 'min:10|max:12',
				'email' => 'email',
			)
		);

		$data = $request->input();
		unset($data['_method'], $data['_token']);

		if (Employee::where('id', $id)->update($data))
		{
			return redirect('/employee')->with('success','Employee Updated Successfully.');
		}

		return redirect('/employee')->with('error','Unable to update Employee');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if (Employee::where('id', $id)->delete())
		{
			return redirect('/employee')->with('success','Employee Deleted Successfully.');
		}

		return redirect('/employee')->with('error','Unable to Delete Employee');
	}
}
