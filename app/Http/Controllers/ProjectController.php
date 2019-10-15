<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Project;

class ProjectController extends Controller
{
    public function index(){
    	$datas = Project::where('user_id', Auth::user()->id)
    	->get();
    	return view('project.index', compact('datas'));
    }

    public function create(){
    	return view('project.form');
    }

    public function store(Request $request){
    	$this->validate_form($request);

    	$data_project = $request->all();
    	$data_project['user_id'] = Auth::user()->id;
    	$data_project['status'] = 'New';

    	$create_project = Project::create($data_project);

    	if($create_project->id != ""){
    		return redirect()->route('project.index');
    	}else{
    		return back()->withInput($request->all());
    	}
    }

    public function validate_form($request){
    	$request->validate([
    		'title' => ["required"],
    		'start' => ["required"],
    	]);
    }

    public function edit($id){
    	$data = Project::find($id);

    	if(empty($data)){
    		abort(404);
    	}

    	return view('project.form', compact('data'));
    }

    public function update($id, Request $request){
    	$data = Project::find($id);

    	if(empty($data)){
    		abort(404);
    	}

    	$update_project = $data->update($request->all());
    	if($update_project){
    		return redirect()->route('project.index');
    	}else{
    		return back()->withInput($request->all());
    	}
    }

    public function delete($id){
    	$data = Project::find($id);

    	if(empty($data)){
    		abort(404);
    	}

    	$delete_project = $data->delete();

    	if($delete_project){
    		return redirect()->route('project.index');
    	}else{
    		return back();
    	}
    }

    public function take($id){
        $data = Project::find($id);
        $update_status = $this->update_status($data, 'Progress');

        if($update_status){
            return redirect()->route('project.index');
        }else{
            return back();
        }
    }

    public function finish($id){
        $data = Project::find($id);
        $update_status = $this->update_status($data, 'Finish');

        if($update_status){
            return redirect()->route('project.index');
        }else{
            return back();
        }
    }

    public function update_status($project, $status){
        $update_status = $project->update([
            'status' => $status
        ]);

        if($update_status){
            return true;
        }else{
            return false;
        }
    }
}
