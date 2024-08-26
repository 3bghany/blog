<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreCommentRequest;


class CommentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $comment=new Comment;
        $comment->content=$request->content;
        $comment->post_id=$request->post_id;
        $comment->user_id=auth()->user()->id;
        $comment->save();

        return redirect()->back();
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment=Comment::findOrFail($id);
        if(Gate::allows('isMyComment',$comment)){
            $comment->delete();
        return response(['status'=>'success','message'=>'the comment deleted successfully']);

        }

        return response(['status'=>'error','message'=>'Couldn\'t delete this comment']);

    }
}
