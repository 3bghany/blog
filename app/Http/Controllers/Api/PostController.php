<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

    /**
     * @OA\Schema(
     *     schema="Post",
     *     type="object",
     *     title="Post",
     *     required={"title", "content"},
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="title", type="string", example="Post Title"),
     *     @OA\Property(property="content", type="string", example="Post content goes here..."),
     *     @OA\Property(property="user_id", type="integer", example=1),
     *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-08-26T15:30:00Z"),
     *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-08-26T15:30:00Z")
     * )
     */

class PostController extends Controller
{



    /**
 * @OA\Get(
 *     path="/post",
 *     summary="Get all posts belongs to logged in user",
 *     description="Returns a all posts belongs to logged in user",
 *     operationId="getPosts",
 *     tags={"Post"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="Authorization",
 *         in="header",
 *         required=true,
 *         description="Access token",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Posts viewed successfully"),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(ref="#/components/schemas/Post")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated"
 *     )
 * )
 */
    
    
    public function index(Request $request)
    {
        $user=$request->input('user');
        $posts=$user->posts;
        return response()->json([[
            'status'=>'success',
            'message'=>'Posts viewed successfully',
            'data'=>PostResource::collection($posts),
        ]]);
    }

    /**
     * @OA\Post(
     *     path="/post",
     *     summary="Store a new Post",
     *     description="Adds a new Post",
     *     operationId="storePost",
     *     tags={"Post"},
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
     *             required={"title","content"},
     *             @OA\Property(property="content", type="text", example="This is a Post content"),
     *             @OA\Property(property="title", type="string", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="content", type="text", example="This is a Post Content"),
     *             @OA\Property(property="title", type="string", example=1),
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
    public function store(StorePostRequest $request)
    {
        $user=$request->input('user');
        $post=new Post;

        $post->title=$request->title;
        $post->content=$request->content;
        $post->user_id=$user->id;
        $post->save();

        return response()->json([[
            'status'=>'success',
            'message'=>'Post created successfully',
            'data'=> new PostResource($post),
        ]]);
    }

    /**
     * @OA\Get(
     *     path="/post/{id}",
     *     summary="Get a specific post",
     *     description="Returns a specific post by ID",
     *     operationId="getPostById",
     *     tags={"Post"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Post viewed successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Post")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post not found"
     *     )
     * )
     */
    public function show(string $id)
    {
        $post= Post::find($id);
        if($post){
            return response()->json([[
                'status'=>'success',
                'message'=>'Post viewed successfully',
                'data'=>new PostResource($post),
            ]]);
        }else{
            return response()->json([[
                'status'=>'error',
                'message'=>'no such record to display',
            ]],404);
        }
        
    }
    
    /**
     * @OA\Put(
     *     path="/post/{id}",
     *     summary="Update a specific Post",
     *     description="update specific Post",
     *     operationId="updatePost",
     *     tags={"Post"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","content"},
     *             @OA\Property(property="content", type="text", example="This is a Post content"),
     *             @OA\Property(property="title", type="string", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post Updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Post updated successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Post")
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
    public function update(UpdatePostRequest $request, string $id)
    {
        $post= Post::findOrFail($id);
        $post->title=$request->title;
        $post->content=$request->content;
        $post->save();

        if($post->wasChanged()){
            return response()->json([[
                'status'=>'success',
                'message'=>'Post updated successfully',
                'data'=>new PostResource($post),
            ]]);
        }else{
            return response()->json([[
                'status'=>'warning',
                'message'=>'No Changes Applied',
                'data'=>new PostResource($post),
            ]]);
        }
    }

    /**
     * @OA\Delete(
     *     path="/post/{id}",
     *     summary="Delete a specific post",
     *     description="Deletes a specific post by ID",
     *     operationId="deletePost",
     *     tags={"Post"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the post to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Post deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post not found"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $post= Post::find($id);
        if($post){
            $post->delete();
            return response()->json([[
                'status'=>'success',
                'message'=>'Post deleted successfully',
            ]]);
        }else{
            return response()->json([[
                'status'=>'error',
                'message'=>'no such record to delete',
            ]]);
        }
    }
}
