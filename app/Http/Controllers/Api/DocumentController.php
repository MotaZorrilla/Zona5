<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Repository;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Repository $repository)
    {
        $document = Repository::with('uploader')->findOrFail($repository->id);
        
        return response()->json([
            'id' => $document->id,
            'title' => $document->title,
            'description' => $document->description,
            'file_path' => $document->file_path,
            'file_name' => $document->file_name,
            'file_type' => $document->file_type,
            'file_size' => $document->file_size,
            'category' => $document->category,
            'grade_level' => $document->grade_level,
            'uploaded_by' => $document->uploaded_by,
            'uploaded_at' => $document->uploaded_at,
            'created_at' => $document->created_at,
            'updated_at' => $document->updated_at,
            'uploader' => $document->uploader ? [
                'id' => $document->uploader->id,
                'name' => $document->uploader->name,
                'email' => $document->uploader->email,
            ] : null,
        ]);
    }
}