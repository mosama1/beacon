<?php

namespace Beacon\Http\Controllers;

use Beacon\Restaurant;
use Beacon\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use Beacon\Location;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $locatiom = Location::where('user_id', '=', Auth::user()->id)->first();
         
        if ($locatiom):
            $user = User::findOrFail($id);
            
            $restaurant = User::findOrFail($id)->location;
            
            return view('users.edit', ['user' => $user, 'location' => $restaurant ]);
        else:
            return view('beacons.location_add');
        endif;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {

        if (!$request->get('password_update')) {
          $user = User::findOrFail($id);
          $user->language =  $request->get('language');
          $user->name = $request->get('name');
          $user->email = $request->get('email');
          $user->phone = $request->get('phone');
          $user->save();
        } else {
          $user = User::findOrFail($id);
          $user->language =  $request->get('language');
          $user->name = $request->get('name');
          $user->password = bcrypt($request->get('password_update'));
          $user->email = $request->get('email');
          $user->phone = $request->get('phone');
          $user->save();
        }

        return redirect()->route('user_edit_path', $id)->with(['status' => 'Se edito el perfil con exito', 'type' => 'success']);
     }


    /**
     * Change Password the specified resource in storage.
     * 
     * @return \Illuminate\Http\Response
     */
     public function changePassword(Request $request, $id)
     {
        $messages = [
            'current_password'    => 'La contraseña actual no es correcta.',
            'password.confirmed'    => 'El campo confirmación de contraseña no coincide.',
        ];

        $validator = Validator::make($request->all(), [
            'passwordActual' => 'required|current_password',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ],
        $messages);

        if ($validator->fails()) {
            return redirect('user/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }


        $user = User::findOrFail($id);
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return redirect()->route('user_edit_path', $id)->with(['status' => 'Cambio de password exitoso.', 'type' => 'success']);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
