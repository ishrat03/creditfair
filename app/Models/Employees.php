<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
class Employees extends Model
{
	use HasFactory;

	public static function allEmp($limit)
	{
		Paginator::useBootstrap();
		return Employees::select(array(
							'employees.id',
							'employees.first_name',
							'employees.last_name',
							'employees.phone',
							'employees.email',
							'companies.name'
						))
						->join('companies', 'companies.id', '=', 'employees.company_id')
						->orderBy('employees.id', 'DESC')
						->paginate($limit);
	}
}
