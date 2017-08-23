<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{

    public function emchange(Request $request)
    {
      if (! \Hash::check($request->password, \Auth::User()->password))
        return redirect()->back()->with('mess', 'Ups! Złe hasło ;/');

      $usr = \Auth::User();
      $usr->email = $request->email;
      $usr->save();
      return redirect('/');
    }

    public function pwchange(Request $request)
    {
      \Validator::make($request->all(), [
          'newpassword' => 'required|string|min:6|confirmed',
      ])->validate();

      if (! \Hash::check($request->password, \Auth::User()->password))
        return redirect()->back()->with('mess', 'Ups! Złe hasło ;/');

      $usr = \Auth::User();
      $usr->password = \Hash::make($request->newpassword);
      $usr->save();
      return redirect('/');
    }

    public function delete(){
      $user = \Auth::User();
      $user->delete();

      return redirect('/');
    }
}
