<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Course;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // Soumettre un feedback pour un cours
    public function store(Request $request, $courseId)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $course = Course::findOrFail($courseId);
        $feedback = new Feedback();
        $feedback->user_id = auth()->id(); // Utilisateur connecté
        $feedback->course_id = $course->id;
        $feedback->content = $request->content;
        $feedback->save();

        return redirect()->route('courses.show', $course->id);
    }

    // gerer les feedbacks
    // Afficher la liste des feedbacks
    public function index()
    {

        $feedbacks = Feedback::orderBy('created_at', 'desc')->get();
        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    // Supprimer un feedback
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('feedbacks.index')->with('success', 'Feedback supprimé avec succès.');
    }

    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('admin.feedbacks.show', compact('feedback'));
    }
}
