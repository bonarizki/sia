<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Archive;
use App\Http\Requests\ArchiveRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\AddUpdateArchive;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Archive::orderBy('created_at','desc');
            if (Auth::user()->role != 'admin') {
                $query->where('department_id',Auth::user()->department_id);
            }
            return DataTables::of($query->get())
                ->addIndexColumn()
                ->make(true);
        }
        return view('archive');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArchiveRequest $request, AddUpdateArchive $AddUpdateArchive)
    {
        $AddUpdateArchive->handle($request);
        return response()->json(["status"=>"success" , "message" => "Archive Created"]);
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
    public function edit(Archive $archive)
    {
        return response()->json(["status"=>"success" , "data" => $archive]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddUpdateArchive $AddUpdateArchive)
    {
        $AddUpdateArchive->handle($request);
        return response()->json(["status"=>"success" , "message" => "Archive Updated"]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Archive::find($id)
            ->delete();
        return response()->json(["status"=>"success" , "message" => "Archive Deleted"]);
        
    }
}
