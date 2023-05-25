<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// Str support module import
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // metodo statico che restituisce tutti i progetti del db
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        $statuses = ['pending', 'in progress', 'completed'];
        return view('admin.projects.create', compact('project', 'types', 'statuses', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        // Perform an authorization check
        $formData = $request->all();
        //$formData['budget'] = '$' . number_format($formData['budget'], 2);

        $newProject = new Project();

        // we use the fill method to fill the model with the data from the request, in the model we must specify the fillable attributes
        $newProject->fill($formData);

        // Assign the slug value based on the 'name' attribute
        $newProject->slug = Str::slug($formData['name']);

        // save must be done before the pivot table insertion, because when we save the row in the db the id gets created
        $newProject->save();

        // insert the technologies relative to the project in the pivot table
        if (array_key_exists('technologies', $formData)) {
            $newProject->technologies()->attach($formData['technologies']);
        }

        return redirect()->route('admin.projects.show', $newProject->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin/projects/show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $statuses = ['pending', 'in progress', 'completed'];
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'statuses', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validation($request);

        $formData = $request->all();
        $project->update($formData);

        // Assign the slug value based on the 'name' attribute
        $project->slug = Str::slug($formData['name']);

        $project->save();
        // sync the technologies relative to the project in the pivot table
        if (array_key_exists('technologies', $formData)) {
            $project->technologies()->sync($formData['technologies']);
        } else {
            // if the technologies are not selected, we delete the respective rows in the pivot table
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
    // custom method
    private function validation($request)
    {
        // dobbiamo prendere solo i parametri del form, utilizziamo quindi il metodo all()
        $formData = $request->all();


        $validator = Validator::make($formData, [

            'name' => 'required|max:50|min:6',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required|max:20',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id',


        ], [
            // dobbiamo inserire qui un insieme di messaggi da comunicare all'utente per ogni errore che vogliamo modificare
            'name.required' => 'The project name must be inserted',
            'name.max' => 'The project name must be longer than 50 characters',
            'name.min' => 'The project name must be at least 6 characters',
            'description.required' => "The project description must be inserted",
            'start_date.required' => "The start date must be inserted",
            'end_date.required' => "The end date must be inserted",
            'status.required' => "The status of the project must be inserted",
            'type_id.exists' => 'The project type must be selected',
            'technologies.exists' => 'The project technology must be selected',


        ])->validate();

        // we need to return a value because we are inside a function
        return $validator;
    }
}
