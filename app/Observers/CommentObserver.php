<?php

namespace App\Observers;

use App\Models\Comment;
use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Mail;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        $user=$comment->post->user;
        if( $comment->user_id != $comment->post->user_id){
            Mail::to($comment->post->user->email)->send(new EmailNotification($comment));
        }
    }

    /**
     * Handle the Comment "updated" event.
     */
    public function updated(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "deleted" event.
     */
    public function deleted(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "restored" event.
     */
    public function restored(Comment $comment): void
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     */
    public function forceDeleted(Comment $comment): void
    {
        //
    }
}
