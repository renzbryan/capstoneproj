<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store a new comment
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'content' => 'required|string|max:255',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string',
        ]);

        // Ensure the user is an admin
        if (auth()->user()->is_admin) {
            // Create a new comment
            Comment::create([
                'user_id' => auth()->id(),
                'commentable_id' => $request->commentable_id,
                'commentable_type' => $request->commentable_type,
                'content' => $request->content,
            ]);

            return back()->with('message', 'Comment added successfully');
        }

        return back()->with('error', 'Only admins can add comments');
    }

    // Delete a comment
    public function destroy(Comment $comment)
    {
        // Authorize the user to delete the comment
        $this->authorize('delete', $comment);

        // Delete the comment
        $comment->delete();

        return back()->with('message', 'Comment deleted successfully');
    }
}
