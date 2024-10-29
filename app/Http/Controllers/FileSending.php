<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileShare;
use Illuminate\Support\Facades\Storage;

class FileSending extends Controller
{
    /**
     * Show the file upload form.
     *
     * @return \Illuminate\View\View
     */
    public function showUploadForm()
    {
        return view('upload');
    }

    /**
     * Handle file upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        // Store the uploaded file
        $file = $request->file('file');
        $path = $file->store('uploads');

        // Save file info in the database or associate it with the user

        // Redirect back with success message
        return redirect('/upload')->with('success', 'File uploaded successfully');
    }

    /**
     * Share a file with a specific user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $fileId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function shareFile(Request $request, $fileId)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Check if the user has permission to share the file

        // Create a new FileShare record
        $fileShare = new FileShare([
            'file_id' => $fileId,
            'user_id' => $request->input('user_id'),
        ]);

        $fileShare->save();

        // Redirect back with success message
        return redirect('/upload')->with('success', 'File shared successfully');
    }
}
