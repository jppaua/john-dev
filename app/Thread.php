<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use Votable, RecordsActivity;

    protected $guarded = [];
    protected $with = ['creator', 'channel'];


    protected static function boot()
    {
        parent::boot();


        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });

        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });

    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }

    // public function votes()
    // {
    //     return $this->morphMany(Vote::class, 'voted');
    // }

    // public function vote()
    // {
    //     $attributes = ['user_id' => auth()->id()];

    //     if (! $this->votes()->where($attributes)->exists()) {
    //         return $this->votes()->create($attributes);
    //     }
    // }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
