<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('id')->get();

        return response()->json([
            'status' => 'success',
            'comments' => $comments
        ]);
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
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->all() + ['user_id' => Auth()->user()->id]);
        return response()->json([
            'status' => true,
            'message' => "Comment Added successfully!",
            'comment' => $comment
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        // $comment->find($comment->id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        return response()->json($comment, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCommentRequest $request, Comment $comment)
    {
        $user = Auth::user();
        if(!$user->can('edit All comment')  && $user->id != $comment->user_id){
            return response()->json([
                'status' => false,
                'message' => "You don't have permission to edit this comment!",
            ], 200);
        }
        $comment->update($request->all());

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        return response()->json([
            'status' => true,
            'message' => "Comment Updated successfully!",
            'comment' => $comment
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $user = Auth::user();
        if(!$user->can('edit All comment')  && $user->id != $comment->user_id){
            return response()->json([
                'status' => false,
                'message' => "You don't have permission to delet this comment!",
            ], 200);
        }
        $comment->delete();

        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Comment deleted successfully'
        ], 200);
    }
}
