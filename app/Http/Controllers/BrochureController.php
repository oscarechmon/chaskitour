<?php

namespace App\Http\Controllers;

use App\Models\Brochure;
use Illuminate\Http\Request;

class BrochureController extends Controller
{
    function index(){
        $brochures=Brochure::orderBy('id','desc')->get();
        return view('admin.brochures',compact('brochures'));
    }
    function store(Request $request){
        $brochure = new Brochure();
        
        if ($request->hasFile('file_pdf')) {
            $file_pdf = $request->file('file_pdf');
            $brochure_name = time() . '.' . $file_pdf->getClientOriginalExtension();
            $file_pdf->storeAs('public/brochure', $brochure_name);
            $brochure->url_brochure = $brochure_name;
        }
        $brochure->status  = 1;
        $brochure->save();
        return back()->with('brochureupdate','¡Brochure ha sido creado con éxito!');
    }
    public function brochureSelected($id){
        $brochure=Brochure::where('id',$id)->first();
        return response()->json($brochure);
    }
    function update(Request $request){
        $brochure = Brochure::findOrFail($request->id);
        if ($request->hasFile('file_pdf')) {
            $file_pdf = $request->file('file_pdf');
            $brochure_name = time() . '.' . $file_pdf->getClientOriginalExtension();
            $file_pdf->storeAs('public/brochure', $brochure_name);
            $brochure->url_brochure = $brochure_name;
        }
        $brochure->status  = 1;
        $brochure->save();
        return back()->with('brochureupdate','¡Brochure ha sido modificado con éxito!');
    }
    public function disable(Request $request){
        $brochure = Brochure::findOrFail($request->id);
        $brochure->status = 0;
        $brochure->save();
        return back()->with('brochuredisable','Brochure inhabilitado');
    }
    public function enable(Request $request){
        $brochure = Brochure::findOrFail($request->id);
        $brochure->status = 1;
        $brochure->save();
        return back()->with('brochureenable','Brochure habilitado');
    }
    public function destroyBrochure($id){
        $brochure = Brochure::findOrFail($id);
        $brochure->delete();
        return back()->with('brochuredisable','Brochure ha sido eliminado');
    }
}
