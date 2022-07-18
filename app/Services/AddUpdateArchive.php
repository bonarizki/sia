<?php 

namespace App\Services;

use App\Models\Archive;

class AddUpdateArchive
{
    public function handle($request)
    {
        $request->merge([
            'archive_file' => $this->uploadFile($request),
            
        ]);
        return Archive::UpdateOrCreate(["id" => $request->id],$request->except(['file','filepond']));
    }

    public function uploadFile($request)
    {
        $archive_file = $request->file('file');
        if ($archive_file) {
            $archive_file->move(public_path('archive_file'),$archive_file->getClientOriginalName());
            return $archive_file->getClientOriginalName();
        }else{
            return NULL;
        }
    }
}