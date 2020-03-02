<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Hash;
class ProfilController extends Controller
{
    
    public function index(){
	    return view('profil.index');
    }

  

    public function update(Request $request,$id){
           $this->validate($request,[
            'email' => 'required|email',
            'name' => 'required|string',
            'password' => 'sometimes',            
        ]);

       if($request->filled('password') )
        {
             $user=User::where('id',$id)->update([
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);    
        }else{
            $user=User::where('id',$id)->update([
                'email' => $request->email,
                'name' => $request->name
            ]);    
        }
   
        
        Session::flash('flash_message','Data Profil Berhasil Diubah');
        return redirect('/profil');
    }

}
