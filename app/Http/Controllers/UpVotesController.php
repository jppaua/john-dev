<?php

namespace App\Http\Controllers;

use App\Vote;
use App\Thread;
use Illuminate\Http\Request;

class UpVotesController extends Controller
{
	/**
     * VotesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($channelId, Thread $thread)
    {
    	return $thread->upVote();
    }



    public function destroy($channelId, Thread $thread)
    {
        $thread->unVote();
    }
}
