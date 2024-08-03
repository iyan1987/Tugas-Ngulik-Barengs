<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{


    public function index(){
        $data = User::paginate(5);
        return view('user', ['user' => $data]);
    }

    public function tambah(){        
        return view('user_tambah');
    }

    public function aksi(Request $request)
    {
// validate form
        $this->validate($request, [
            'name'              => 'required',
            'email'             => 'required|unique:users',
            'password'          => 'required|confirmed',
            'password_confirmation'  => 'required',
            'job'               => 'required',
            'gender'            => 'required',
            'hobbies'           => 'required',
            'photo'             => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

//upload image
        $image = $request->file('photo');
        $image->storeAs('public/user', $image->hashName());

// //create post
        User::create([
            'name'     => $request->name,
            'email'   => $request->email,            
            'password'   => $request->password,
            'photo'     => $image->hashName(),
            'job'   => $request->job,
            'gender'   => $request->gender,
            'hobbies'   => implode(",", $request->hobbies),
        ]);

// //redirect to index
        return redirect()->route('user')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit($id){
        $data = User::findOrFail($id);
        return view('user_edit', ['user' => $data]);
    }

    public function update(Request $request,$id)
    {
// validate form
        $this->validate($request, [
            'name'              => 'required',
            'email'             => 'required|unique:users,id',          
            'job'               => 'required',
            'gender'            => 'required',
            'hobbies'           => 'required',
            'photo'             => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($request->password != ""){
            $this->validate($request, [
                'password'          => 'required|confirmed',
                'password_confirmation'  => 'required',
            ]);
        }


        $user = User::findOrFail($id);


// update data
        $user->update([
            'name'     => $request->name,
            'email'   => $request->email,                        
            'job'   => $request->job,
            'gender'   => $request->gender,
            'hobbies'   => implode(",", $request->hobbies),
        ]);

// jika password tidak kosong
        if($request->password != ""){
            $user->update([        
                'password'   => $request->password
            ]);
        }


// jika foto tidak kosong
        if($request->photo != ""){

//upload image
            $image = $request->file('photo');
            $image->storeAs('public/user', $image->hashName());

// hapus foto lama
            Storage::delete('public/user/'.$user->photo);

            $user->update([        
                'photo'     => $image->hashName()
            ]);
        }


// //redirect to index
        return redirect()->route('user')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function hapus($id){

        $user = User::findOrFail($id);

// hapus foto lama
// Storage::delete('public/user/'.$user->photo);

        $user->delete();

        return redirect()->route('user')->with(['success' => 'Data Berhasil dihapus!']);
    }


    public function tong(){
        $data = User::onlyTrashed()->paginate(5);
        return view('user_tong', ['user' => $data]);
    }


    public function kembalikan($id){

        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('user')->with(['success' => 'Data Berhasil Dikembalikan!']);
    }


    public function hapus_permanen($id){

        $user = User::onlyTrashed()->findOrFail($id);
        Storage::delete('public/user/'.$user->photo);
        $user->forceDelete();
        return redirect()->route('user')->with(['success' => 'Data Berhasil Dihapus Permanen!']);
    }



}
