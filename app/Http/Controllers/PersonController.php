<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all people
	return Person::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	//validate the data first
	//$request->validate([
	//    'key' => 'required|unique:App\Models\Person,firstName'
	//]);
//	if ($request->isJson())
//	{
//	    dd($request->all());
//	}
//	$a = array_keys($request->all());
//	dd($a);
//	$person = Person::create(
	$arr=$request->all();
	foreach($arr as $key => $val){
	    
	    Person::create([$key, $val]);
	}
//	);
//	return $person;	

        //add person
	//dd($request);
//	$key = $request->content->first_field;
//	dd($key);
	//return Person::fill($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show($key)//(Person $person)
    {
        //show person
//	return Person::find($person);
//	$target = Person::where('firstName', $key)->orWhere('lastName', $key)->get()->first();
//	//dd($target);
//	$success = (is_null($target) ? false : $target->delete());
//	return [
//	    'success' => $success,
//	];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //update person
//	dd($person);
//	dd($request);
//	$process = Person::find($person);
//	dd($process);
	$person->update($request->all());
	return $person;
//	$process = Person::find($person);
//	$process->update($request->all());
//	return $process;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy($key)//(Person $person)
    {
        //delete person
	//dd($person);
	//dd($key);
	//return Person::destroy($person);
	//$success = Person::destroy($key);
	//$target = Person::where('firstName', $key)->get()->first();
	$target = Person::where('firstName', $key)->orWhere('lastName', $key)->get()->first();
	//dd($target);
	$success = (is_null($target) ? false : $target->delete());
	return [
	    'success' => $success,
	];
    }
}
