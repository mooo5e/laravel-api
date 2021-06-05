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
//dd($request);
        $arr=$request->all();
//	dd(array_keys($arr)[0]);
//dd($arr);
//	$request->validate([
//            'key' => 'required|unique:App\Models\Statemet,key'
//        ]);

//	validate($request->[
//            'key' => 'required|unique:statements,key'
//        ]);




//	$validator = Validator::make($request->all(), [
//            'key' => 'required|unique:statements|min:1'
//        ]);
//dd($validator->getRules());//passes());
        
	$reply = [];//new Human;
        foreach($arr as $key => $val){
	    //validate the data first
/*    	    $arr->validate([
        	'key' => 'required|unique:App\Models\Person,firstName'
    	    ]);
*/
//dd([$key, $val]);
//	$all = DB::table('statements')->select('key')->get();
//dd($all);
//dd($key);
//$all->each(function($item) {if ($item->key == $key) {return false;}});
//dd($all->toArray());
//	for 
	    $validator = Validator::make([$key], ['required|unique:statements,key|min:1']);
//dd($all->has($key));
//dd($validator->getRules());
//dd($validator->passes());
	    //if ($validator->passes()){
    		$st = new Statement;
        	$st->key = $key;
        	$st->value = $val;
//		$st->validate()
//        	if ($st->save() == true){
//		    st->success = "success";
	    if ($validator->passes()){
	    $st->save();
		    array_push($reply, ["success" => "success", "statement" => $st]);
	    }
	    else {
//		    st->success = "failed";
		    array_push($reply, ["success" => "failed", "statement" => $st]);
		}
//	    };
        }
        return $reply;

	
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

	//if found non-existing keys in request -> return error
	if ($failed) {
	    $reply = [];
	    foreach($failed as $key){
		$reply["error ".(count($reply))] = "key not exist: ".$key;
	    };
	    return $reply;
	}
	//else -> return key:value json
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
	if ($passed){
	    foreach($passed as $key => $val){
		Statement::where('key', $key)->update(['value' => $val]);
	    }
	    $reply["passed"] = $passed;
	}
	if ($failed) {
	    $reply["failed"] = $failed;
	}
	return $reply;
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

	if ($passed){
	    foreach($passed as $key => $val){
		Statement::where('key', $key)->delete();
	    }
	    $reply["deleted"] = $passed;
	}
	if ($failed) {
	    $reply["not found"] = $failed;
	}
	return $reply;
    }
}
