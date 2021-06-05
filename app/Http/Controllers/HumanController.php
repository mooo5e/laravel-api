<?php

namespace App\Http\Controllers;

use App\Models\Human;
use Illuminate\Http\Request;

class HumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return all keys
	return Human::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //add new key
        $arr=$request->all();
	$human = new Human;
        foreach($arr as $key => $val){    
	    $human->key = $key;
	    $human->value = $val;
	    $human->save();
        }
	return $human;
	
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Human  $human
     * @return \Illuminate\Http\Response
     */
    public function show($key)//(Human $human)
    {
        //return decent key-value
      $target = Human::where('key', $key)->get()->first();//->orWhere('lastName', $key)->get()->first();
      //dd($target);
      $value = (is_null($target) ? false : $target->value);
      return [
          $key => $value,
      ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Human  $human
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)//, Human $human)
    {
        //update key-value
	$arr=$request->all();
dd($arr);
//	extract($arr, EXTR_PREFIX_SAME, "wddx");
//        foreach($arr as $key => $val){    
//	    $human->key = $key;
//	    $human->value = $val;
//	    $human->save();
//        }
	$target = Human::where('key', $key)->get()->first();
dd($target);
//        $target->update($key->all());
//	$human->update($request->all());
        return $human;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Human  $human
     * @return \Illuminate\Http\Response
     */
    public function destroy(Human $human)
    {
        //delete key
    }
}
