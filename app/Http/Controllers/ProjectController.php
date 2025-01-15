<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order_column')->get();
    return view('dashboard', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'url' => 'required|url',
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
        ]);

        Project::create($validated);
        return redirect()->route('dashboard')->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'url' => 'required|url',
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
        ]);

        $project->update($validated);
        return redirect()->route('dashboard')->with('success', 'Project updated successfully!');
    }


    public function reorder(Request $request)
    {
        $order = $request->input('order'); // Array of project IDs and their new order
    
        if ($order && is_array($order)) {
            foreach ($order as $item) {
                // Update the order_column based on the new position
                Project::where('id', $item['id'])->update(['order_column' => $item['order']]);
            }
    
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false, 'message' => 'Invalid order data']);
    }
    
    
    
    public function destroy(Project $project)
    {

        $project->delete();
        return redirect()->route('dashboard')->with('success', 'Project deleted successfully.');
    }
}

