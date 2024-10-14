<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){
        $users = User::get();
        return view('admin.users',compact('users'));
    }
    function store(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email  = $request->email;
        $user->password = bcrypt($request->password);
        $user->status  = 1;
        $user->role  = "admin";
        $user->save();
        return back()->with('userupdate','¡Usuario ha sido creado con éxito!');

    }
    public function userSelected($id){
        $user=User::where('id',$id)->first();
        return response()->json($user);
    }
    function update(Request $request){
        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email  = $request->email;
        if($request->password!=null){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return back()->with('userupdate','¡Usuario ha sido modificado con éxito!');
    }
    public function disable(Request $request){
        $user = User::findOrFail($request->id);
        $user->status = 0;
        $user->save();
        return back()->with('userdisable','Usuario inhabilitado');
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('userdisable','Usuario eliminado');
    }
    public function enable(Request $request){
        $user = User::findOrFail($request->id);
        $user->status = 1;
        $user->save();
        return back()->with('userenable','Usuario habilitado');
    }
}
