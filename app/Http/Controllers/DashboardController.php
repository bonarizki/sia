<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $department = Departments::with('Archive')
            ->withCount('Archive')
            ->select('department_name','id')
            ->get();
            // ->pluck('department_name',)
            // ->toArray();
        return view('dashboard',compact('department'));
    }

    public function grafik()
    {
        $query = "select department_name as x,COUNT(department_id) as y FROM departments
        LEFT JOIN archives ON departments.id = archives.department_id
        WHERE  ISNULL(archives.deleted_at)
        GROUP BY department_name";
        
        return response()->json(DB::select($query));
    }
}
