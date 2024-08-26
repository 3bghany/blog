<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Resources\CommentResource;
use App\Http\Requests\StoreCommentRequest;
use Gate;

/**
 * @OA\Info(title="API Documentation", version="1.0")
 */

class CommentController extends Controller
{
     /**
     * @OA\Post(
     *     path="/comment",
     *     summary="Store a new comment",
     *     description="Adds a new comment to a post",
     *     operationId="storeComment",
     *     tags={"Comment"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         required=true,
     *         description="Access token",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"content", "post_id"},
     *             @OA\Property(property="content", type="string", example="This is a comment"),
     *             @OA\Property(property="post_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comment created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="content", type="string", example="This is a comment"),
     *             @OA\Property(property="post_id", type="integer", example=1),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-08-26T14:15:22Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     */

    public function store(StoreCommentRequest $request)
    {
        $user=$request->input('user');
        $comment=new Comment;
        $comment->content=$request->content;
        $comment->post_id=$request->post_id;
        $comment->user_id=$user->id;
        $comment->save();

        return response()->json([[
            'status'=>'success',
            'message'=>'Comment created successfully',
            'data'=> new CommentResource($comment),
        ]]);
    }



    /**
     * @OA\Delete(
     *     path="/comment/{id}",
     *     summary="Delete a comment",
     *     description="Deletes a comment by ID",
     *     operationId="deleteComment",
     *     tags={"Comment"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the comment to delete",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="token",
     *         in="header",
     *         required=true,
     *         description="Access token",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comment deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comment not found"
     *     )
     * )
     */
    public function destroy(Request $request,string $id)
    {
        $user=$request->input('user');
        $comment=Comment::find($id);
        if($comment){
            if(Gate::forUser($user)->allows('isMyComment',$comment)){
                $comment->delete();
            
                return response()->json([[
                    'status'=>'success',
                    'message'=>'the comment deleted successfully',
                ]]);
    
            }

            return response()->json([[
                'status'=>'error',
                'message'=>'Couldn\'t delete this comment',
            ]]);
        }
        return response()->json([[
            'status'=>'error',
            'message'=>'no such record to delete',
        ]]);


    }
}
