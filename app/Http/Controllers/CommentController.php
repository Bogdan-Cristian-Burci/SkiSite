<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Comment::class);

        return CommentResource::collection(Comment::all());
    }

    public function store(CommentRequest $request)
    {
        $this->authorize('create', Comment::class);

        return new CommentResource(Comment::create($request->validated()));
    }

    public function webStore(CommentRequest $request, $blogPostId)
    {
        $this->authorize('create', Comment::class);

        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['blog_post_id'] = $blogPostId;
        $data['aproved_status'] = false; // Comments start as unapproved

        Comment::create($data);

        return redirect()->back()->with('success', __('Your comment has been submitted and is awaiting approval.'));
    }

    public function show(Comment $comment)
    {
        $this->authorize('view', $comment);

        return new CommentResource($comment);
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update($request->validated());

        return new CommentResource($comment);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json();
    }
}
