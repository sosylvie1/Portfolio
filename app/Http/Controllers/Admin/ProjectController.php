<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Liste des projets (vue admin).
     */
    public function index()
    {
        // ✅ Plus d'appel à PublicProjectController::allProjects()
        $projects = Project::all();
        return view('admin.projets.index', compact('projects'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        return view('admin.projets.create');
    }

    /**
     * Enregistrer un projet.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:projects',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|max:2048',
            'tech'         => 'nullable|string',
            'github'       => 'nullable|url',
            'live'         => 'nullable|url',
            'case'         => 'nullable|url',
            'readme'       => 'nullable|url',
            'video'        => 'nullable|url',
            'video_webm'   => 'nullable|url',
            'figma'        => 'nullable|url',
            'figma_images' => 'nullable|array',
            'date'         => 'nullable|date',
            'is_published' => 'boolean',
            'order'        => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        // ✅ convertir tech en JSON
        $validated['tech'] = json_encode(
            array_filter(array_map('trim', explode(',', $request->input('tech', ''))))
        );

        // ✅ convertir figma_images en JSON
        $validated['figma_images'] = json_encode(
            array_map(function ($img) {
                return 'images/projects/figma/' . $img;
            }, $request->input('figma_images', []))
        );

        Project::create($validated);

        return redirect()->route('admin.projets.index')
                         ->with('success', '✅ Projet ajouté avec succès');
    }

    /**
     * Formulaire d’édition.
     */
    public function edit(Project $project)
    {
        return view('admin.projets.edit', compact('project'));
    }

    /**
     * Mettre à jour un projet.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:projects,slug,' . $project->id,
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|max:2048',
            'tech'         => 'nullable|string',
            'github'       => 'nullable|url',
            'live'         => 'nullable|url',
            'case'         => 'nullable|url',
            'readme'       => 'nullable|url',
            'video'        => 'nullable|url',
            'video_webm'   => 'nullable|url',
            'figma'        => 'nullable|url',
            'figma_images' => 'nullable|array',
            'date'         => 'nullable|date',
            'is_published' => 'boolean',
            'order'        => 'integer',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['tech'] = json_encode(
            array_filter(array_map('trim', explode(',', $request->input('tech', ''))))
        );

        $validated['figma_images'] = json_encode(
            array_map(function ($img) {
                return 'images/projects/figma/' . $img;
            }, $request->input('figma_images', []))
        );

        $project->update($validated);

        return redirect()->route('admin.projets.index')
                         ->with('success', '✏️ Projet modifié avec succès');
    }

    /**
     * Supprimer un projet.
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projets.index')
                         ->with('success', '🗑️ Projet supprimé avec succès');
    }
}
