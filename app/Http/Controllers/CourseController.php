<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        // Filter by category if a category is specified
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Optionally add search functionality
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Optionally add sorting
        $sortBy = $request->get('sort', 'created_at'); // Default to sorting by created_at
        $sortOrder = $request->get('order', 'desc');  // Default to descending order
        $query->orderBy($sortBy, $sortOrder);

        // Paginate the results
        $courses = $query->paginate(6);

        // Get unique categories for the filter dropdown
        $categories = Course::select('category')->distinct()->get();

        return view('home', compact('courses', 'categories'));
    }

    // Afficher un cours spécifique avec ses feedbacks
    public function show($id)
    {
        // Charger le cours avec ses feedbacks triés par la colonne 'created_at'
        $course = Course::with(['feedbacks' => function ($query) {
            $query->orderBy('created_at', 'desc'); // Trier par date de création (plus récent en premier)
        }])->findOrFail($id);

        return view('courses.show', compact('course'));
    }
    // Créer un nouveau cours
    public function create()
    {
    }

    public function store(Request $request)
    {
    }
}
