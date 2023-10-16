<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $homes = UserProfile::latest()->get(); 

        return view('index', [
            'homes' => $homes, 
        ]);
    }

    public function storeData(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'age' => 'required',
            'sex' => 'required',
            'user_name' => 'required',
            'image' => 'required',
           
        ]);
        UserProfile::create($request->all());

        return back()->with('success', 'Data created successfully');
    }

   
    public function edit($id)
    {
        $home = UserProfile::find($id);
        return view('edit', compact('home'));
    }

 

    public function update(Request $request)
    {
        $home = UserProfile::find($request->data_id);

        $home->update([
            'name' => $request->name,
            'code' => $request->code,
            'user_name' => $request->user_name,
            'password' => $request->password,
          
        ]);

        return redirect('/')->with('success', 'Update successfully');
    }


    public function destroy(Request $request)
    {
        UserProfile::destroy($request->data_id);

        return back()->with('success', 'Deleted successfully');
    }
   
}
