<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use App\Models\Technology;

use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('pages.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $types = Type::all();

        $technologies = Technology::all();

        return view('pages.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        
        $val_data = $request->validated();

        
        $slug = Project::generateSlug($request->title);
        $val_data['slug'] = $slug;
        

        $val_data['descriptions'] = $request->input('descriptions');
        $val_data['languages'] = $request->input('languages');


        if($request->hasFile('thumb')){
            $img_path=Storage::disk('public')->put('project_images', $request->thumb);
        
            $val_data['thumb'] = $img_path;
        }

        // dd($val_data);
        // $val_data['thumb'] = $request->input('thumb');

        $new_project = Project::create($val_data);


        if( $request->has('technologies') ){
            $new_project->technologies()->attach( $request->technologies );
        }

        return redirect()->route('dashboardprojects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view( 'pages.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        $technologies = Technology::all();
        
        return view('pages.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        $slug = Project::generateSlug($request->title);

        $val_data['slug'] = $slug;

        if( $request->hasFile('thumb') ){
            if( $project->thumb ){
                Storage::delete($project->thumb);
            }

            $path = Storage::disk('public')->put('project_images', $request->thumb);

            $val_data['thumb'] = $path;
        }



        $project->update($val_data);

        if( $request->has('technologies') ){
            $project->technologies()->sync( $request->technologies );
        }

        return redirect()->route('dashboardprojects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        $project->technologies()->sync([]);

        if( $project->thumb ){
            Storage::delete($project->thumb);
        }

        $project->delete();
        
        return redirect()->route('dashboardprojects.index');
    }
}
