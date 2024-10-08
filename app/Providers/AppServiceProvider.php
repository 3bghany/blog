<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\User;
use App\Observers\CommentObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('isMyComment', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id;
        });
        Comment::observe(CommentObserver::class);
    }
}
