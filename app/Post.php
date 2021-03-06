<?php

namespace App;

use App\Facades\PostProcessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $table = 'posts';

    /**
     * Get the thread containing the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }

    /**
     * Get the original poster of the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function poster()
    {
        return $this->hasOne('App\User\User', 'id', 'poster_id');
    }

    /**
     * Get body of post.
     * Automatically applies filters.
     *
     * @param bool|false $skipFilter Should the post skip the filters?
     * @return string Post content
     */
    public function getBody($skipFilter = false)
    {
        $content = $this->body;

        if (!$skipFilter) {
            // Run post through filters
            $content = PostProcessor::postProcess($content);
        }

        return $content;
    }

    /**
     * Return a blade view of this individual post.
     *
     * @return \Illuminate\View\View
     */
    public function getPostView()
    {
        return view('clearboard.thread.partials.post', ['post' => $this]);
    }

    /**
     * Create a new post
     *
     * @param string $body Content of post, will be run through filters
     * @param integer $threadid Thread ID
     * @param integer| $posterid Poster's ID. Defaults to currently authenticated user
     * @param bool|false $hidden Is the post hidden from normal view?
     * @param bool|true $save Should the post be automatically saved into the database? Also determines whether the parent thread should be bumped.
     * @return Post The resulting post object
     */
    public static function newPost($body, $threadid, $posterid = null, $hidden = false, $save = true)
    {
        // Check users rights
        if ( (!Auth::check()) && $posterid === null ) {
            abort(403); // 403 Forbidden
        }

        // Find thread
        $thread = Thread::findOrFail($threadid);

        // Run post through filters
        $body = PostProcessor::preProcess($body);

        // Create new post
        $post = new Post();
        $post->thread_id = $threadid;
        $post->poster_id = Auth::user()->id;
        $post->body = $body;
        $post->hidden = $hidden; // defaults to false

        if ($save) {
            // Put post into database
            $post->save();

            // Bump thread
            $thread->touch();
        }

        return $post;
    }
}
