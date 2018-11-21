<?php


namespace App;


trait Votable
{

    protected static function bootVotable()
    {
        static::deleting(function ($model) {
            $model->votes->each->delete();
        });
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voted');
    }

    // public function vote()
    // {
    //     $attributes = ['user_id' => auth()->id()];

    //     if (!$this->votes()->where($attributes)->exists())
    //     {
    //         return $this->votes()->create($attributes);

    //     } 
    //     else if ($this->votes()->where(['upvote' => '1'])->exists()) 
    //     {

    //         $this->votes()->update(['upvote' => '0']);

    //     }
    //     else if ($this->votes()->where(['upvote' => '0'])->exists())
    //     {

    //         $this->votes()->update(['upvote' => '1']);
    //     }
    // }

    public function upVote()
    {

        $attributes = ['user_id' => auth()->id()];

        if (!$this->votes()->where($attributes)->exists())
        {
            $this->votes()->create($attributes);
            $this->votes()->update(['upvote' => '1']);
        }
        else if ($this->votes()->where(['upvote' => '0'])->exists())
        {
            $this->votes()->update(['upvote' => '1']);
        }

    }

    public function downVote()
    {

        $attributes = ['user_id' => auth()->id()];

        if (!$this->votes()->where($attributes)->exists())
        {
            $this->votes()->create($attributes);
            $this->votes()->update(['upvote' => '0']);
        }
        else if ($this->votes()->where(['upvote' => '1'])->exists())
        {
            $this->votes()->update(['upvote' => '0']);
        }

    }

    public function unVote()
    {
        $attributes = ['user_id' => auth()->id()];

        $this->votes()->where($attributes)->get()->each->delete();
    }

    public function isVoted()
    {
        return !!$this->votes->where('user_id', auth()->id())->count();
    }

    public function getIsVotedAttribute()
    {
        return $this->isVoted();
    }

    public function getVotesCountAttribute()
    {
        $upVotes = $this->upVoteCount();
        $downVotes = $this->downVoteCount();
        return $upVotes - $downVotes;
    }

    public function upVoteCount()
    {
        $attributes = ['upvote' => '1'];
        return $this->votes()->where($attributes)->count();
    }

    public function downVoteCount()
    {
        $attributes = ['upvote' => '0'];
        return $this->votes()->where($attributes)->count();
    }

}
//$items