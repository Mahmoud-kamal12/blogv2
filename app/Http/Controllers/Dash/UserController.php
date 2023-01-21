<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('vertifyisadmin')->only(['index' , 'makeAdmin']);
        $this->middleware('vertifyisadmin')->except(['profile' , 'update']);
    }

    public function index(){
        return view('dashboard.users.index')->with('users' , User::orderBy('updated_at','DESC')->paginate(10)->onEachSide(0));
    }

    public function makeAdmin(User $user){
        $user->role = 'admin';
        $user->save();
        return view('dashboard.users.index')->with('users' , User::orderBy('updated_at','DESC')->paginate(10)->onEachSide(0));
    }

    public function profile(){
        $user = auth()->user();
        return view('dashboard.users.profile')->with('user' , $user);
    }

    public function update(Request $request){

        $user = User::find(auth()->user()->id);
        $validated = $request->validate([
            'email' => 'required|unique:users,email,'.$user->id,
        ]);
        $profile = $user->profile;
        $profiledata = $request->only(['about' , 'facebook' , 'twitter']);
        $userdata = $request->only(['name']);
        $userdata['email'] = $validated['email'];
        if ($request->hasFile('image')) {
            $profiledata['image'] = "uploads/".Storage::disk('public')->putFile('images/profile', $request->file('image'));
            Storage::disk('public')->delete($profile->image);
        }
        $profile->update($profiledata);
        $user->update($userdata);
        return redirect(route('home'));
    }





}
