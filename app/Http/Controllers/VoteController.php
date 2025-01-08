<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Feedback;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    // Voter sur un feedback (like ou dislike)
    public function store(Request $request, $feedbackId)
    {
        $request->validate([
            'type' => 'required|in:like,dislike',
        ]);
    
        $feedback = Feedback::findOrFail($feedbackId);
    
        // Vérifier si l'utilisateur a déjà voté
        $existingVote = Vote::where('user_id', auth()->id())
                            ->where('feedback_id', $feedback->id)
                            ->first();
    
        if ($existingVote) {
            if ($existingVote->type === $request->type) {
                // Si l'utilisateur clique à nouveau sur le même type, on annule le vote
                $existingVote->delete();
            } else {
                // Sinon, on met à jour le type de vote
                $existingVote->type = $request->type;
                $existingVote->save();
            }
        } else {
            // Sinon, on crée un nouveau vote
            $vote = new Vote();
            $vote->user_id = auth()->id();
            $vote->feedback_id = $feedback->id;
            $vote->type = $request->type;
            $vote->save();
        }
    
        return redirect()->route('courses.show', ['course' => $feedback->course_id]);
    }
    
}
