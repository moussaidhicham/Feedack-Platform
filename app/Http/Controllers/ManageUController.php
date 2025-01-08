<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Assurez-vous d'ajouter cette ligne


class ManageUController extends Controller
{
    // Afficher la liste des cours
    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->get();
        return view('admin.index', compact('courses'));
    }

    // Afficher le formulaire de création d'un nouveau cours
    public function create()
    {
        return view('admin.create');
    }

    // Ajouter un nouveau cours
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image',
            'pdf' => 'nullable|mimes:pdf|max:10240', // Validation pour le fichier PDF
            'instructor' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);

        $data = $request->all();

        // Gestion de l'image
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        // Gestion du fichier PDF
    if ($request->hasFile('pdf')) {
        $data['pdf'] = $request->file('pdf')->store('pdfs', 'public');
    }

        // Créer un nouveau cours
        Course::create($data);

        return redirect()->route('admin.index')->with('success', 'Cours ajouté avec succès.');
    }

    // Afficher le formulaire d'édition d'un cours existant
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.edit', compact('course'));
    }

    // Mettre à jour un cours existant
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image',
            'pdf' => 'nullable|mimes:pdf|max:10240', // Validation pour le fichier PDF
            'instructor' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);

        $data = $request->all();

        // Gestion de l'image
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        // Gestion du fichier PDF
    if ($request->hasFile('pdf')) {
        $data['pdf'] = $request->file('pdf')->store('pdfs', 'public');
    }

        // Mise à jour du cours
        $course->update($data);

        return redirect()->route('admin.index')->with('success', 'Cours modifié avec succès.');
    }

    // Supprimer un cours
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        // Supprimer le fichier de la miniature si elle existe
        if ($course->thumbnail) {
            Storage::delete('public/' .$course->thumbnail);
        }
        if ($course->pdf) {
            Storage::delete('public/' . $course->pdf);
        }
        

        // Supprimer le cours
        $course->delete();

        return redirect()->route('admin.index')->with('success', 'Cours supprimé avec succès.');
    }
}
