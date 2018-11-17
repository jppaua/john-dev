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

    public function vote()
    {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->votes()->where($attributes)->exists())
        {

            return $this->upVote();


        } 
        else 
        { 

            return $this->downVote();

        }
    }

    public function upVote()
    {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->votes()->where($attributes)->exists())
        {

            return $this->votes()->create($attributes);

        } 
        else if ($this->votes->where(['type' => 'down_vote'])->exists()) 
        {

            return $this->votes->update(['type' => 'up_vote']);

        }
    }

    public function downVote()
    {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->votes()->where($attributes)->exists())
        {
            if ($this->votes->where(['type' => 'up_vote'])->exists()) 
            {
               return $this->votes()->create($attributes);
            }    

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
        $attributes = ['type' => 'up_vote'];
        return $this->votes->where($attributes)->count();
    }

    public function downVoteCount()
    {
        $attributes = ['type' => 'down_vote'];
        return $this->votes->where($attributes)->count();
    }

}