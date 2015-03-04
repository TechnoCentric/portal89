<?php

class ProjectsController extends BaseController {

	/**
	 * Project Repository
	 *
	 * @var Project
	 */
	protected $project;

	public function __construct(Project $project)
	{
		$this->project = $project;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = $this->project->paginate(10);
		$etypes = Etype::all();

		return View::make('projects.index', compact('projects', 'etypes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('projects.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Project::$rules);

		if ($validation->passes())
		{
			$project = new Project();
			$project->name = Input::get('name');
			$project->type = Input::get('name');
			$project->start = Input::get('start');
			$project->end = Input::get('end');
			$project->save();
			Flash::success('Project Created');
			return Redirect::route('projects.index');
		}

		return Redirect::route('projects.create')
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$project = $this->project->findOrFail($id);

		$Expenses = Expense::where('project_id', 'LIKE', $project->name)->paginate(10);
		$Revenues = Revenue::where('project', 'LIKE', $project->name)->paginate(10);

		return View::make('projects.show', compact('project', 'Expenses', 'Revenues'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$project = $this->project->find($id);

		if (is_null($project))
		{
			Flash::error('Project not found');
			return Redirect::route('projects.index');
		}

		return View::make('projects.edit', compact('project'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Project::$rules);

		if ($validation->passes())
		{
			$project = $this->project->find($id);
			$project->update($input);
			Flash::success('Project updated');
			return Redirect::route('projects.show', $id);
		}

		return Redirect::route('projects.edit', $id)
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->project->find($id)->delete();
		Flash::success('Project Deleted');
		return Redirect::route('projects.index');
	}

}
