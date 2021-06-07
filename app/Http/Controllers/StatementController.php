<?php

namespace App\Http\Controllers;


use App\Models\Statement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
	$all = Statement::all()->pluck('value','key');
	return $all;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // add new statement
        $req=$request->all();

	//validate keys
	$passed = [];
	$failed = [];
        foreach($req as $key => $val){
	    $validator = Validator::make([$key], ['required|unique:statements,key|min:1']);
	    if ($validator->passes()){
		$passed[$key] = $val;
	    }
	    else {
		$failed[$key] = $val;
	    }
	}

	if ($failed) {
	    return response()->json($failed, 400);
	}
	if ($passed){
	    foreach($passed as $key => $val){
		Statement::create(['key' => $key, 'value' => $val]);
	    }
	    return response()->json($passed, 202);
	}
	
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // 
	$all = Statement::all();
        $req=$request->all();

	//validate keys
	$passed = [];
	$failed = [];
        foreach($req as $key => $val){
	    $validator = Validator::make([$key], ['required|exists:statements,key|min:1']);
	    if ($validator->passes()){
		array_push($passed, $key);
	    }
	    else {
		array_push($failed, $key);
	    }
	}

	if ($failed) {
	    $reply = [];
	    foreach($failed as $key){
		$reply["error ".(count($reply))] = "key not exist: ".$key;
	    };
	    return $reply;
	}
	else {
	    return $all->whereIn('key', $passed)->pluck('value','key');
	}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $req=$request->all();

	//validate keys
	$passed = [];
	$failed = [];
        foreach($req as $key => $val){
	    $validator = Validator::make([$key], ['required|exists:statements,key|min:1']);
	    if ($validator->passes()){
		$passed[$key] = $val;
	    }
	    else {
		$failed[$key] = $val;
	    }
	}

	if ($failed) {
	    return response()->json($failed, 400);
	}
	if ($passed){
	    foreach($passed as $key => $val){
		Statement::where('key', $key)->update(['value' => $val]);
	    }
	    return response()->json($passed, 202);
	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $req=$request->all();
	$reply = [];

	//validate keys
	$passed = [];
	$failed = [];
        foreach($req as $key => $val){
	    $validator = Validator::make([$key], ['required|exists:statements,key|min:1']);
	    if ($validator->passes()){
		$passed[$key] = $val;
	    }
	    else {
		$failed[$key] = $val;
	    }
	}

	if ($failed) {
            return response()->json($failed, 400);
	}
	if ($passed){
	    foreach($passed as $key => $val){
		Statement::where('key', $key)->delete();
	    }
            return response()->json($passed, 202);
	}

	return $reply;
    }
}
