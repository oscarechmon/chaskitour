<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index(){
        $categories = Category::orderBy('id','desc')->get();
        return view ('admin.categories',compact('categories'));
    }
    public function categorySelected($id){
        $category=Category::where('id',$id)->first();
        return response()->json($category);
    }
    function store(Request $request){
        $category = new Category();
        $category->category = $request->category;
        if ($request->hasFile('file_image_category')) {
            $file_image_category = $request->file('file_image_category');
            $category_image_name = time() . '.' . $file_image_category->getClientOriginalExtension();
            $file_image_category->storeAs('public/category', $category_image_name);
            $category->urlImage = $category_image_name;
        }
        $category->status  = 1;
        $category->save();
        return back()->with('categoryupdate','Categoría ha sido creado con éxito!');

    }

    function update(Request $request){
        $category = Category::findOrFail($request->id);
        if ($request->hasFile('file_image_category')) {
            $file_image_category = $request->file('file_image_category');
            $category_image_name = time() . '.' . $file_image_category->getClientOriginalExtension();
            $file_image_category->storeAs('public/category', $category_image_name);
            $category->urlPdf = $category_image_name;
        }
        $category->category = $request->category;
        $category->save();
        return back()->with('categoryupdate','Categoría ha sido modificado con éxito!');
    }
    public function disable(Request $request){
        $category = Category::findOrFail($request->id);
        $category->status = 0;
        $category->save();
        return back()->with('categorydisable','Categoría inhabilitado');
    }
    public function enable(Request $request){
        $category = Category::findOrFail($request->id);
        $category->status = 1;
        $category->save();
        return back()->with('categoryenable','Categoría habilitado');
    }


}
