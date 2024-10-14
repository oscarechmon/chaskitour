<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    function index(Request $request){
        $leads = Lead::orderBy('id','desc')->get();
        return view('admin.leads',compact('leads'));
    }
    function store(Request $request){
        $lead = new Lead();
        $lead->name = $request->name;
        $lead->email  = $request->email;
        $lead->phone = $request->phone;
        $lead->save();
        return back()->with('leadupdate','¡Lead ha sido creado con éxito!');
    }
}
