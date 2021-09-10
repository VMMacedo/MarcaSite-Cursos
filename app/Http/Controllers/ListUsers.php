<?php

namespace App\Http\Controllers;

use App\Http\Requests\createUserPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Validation\Rule;

class ListUsers extends Controller
{
    public function index()
    {
        $users = DB::table('users')
            ->select(array('users.id', 'users.name', 'perfils.nome', 'users.email', 'perfils.id as perfilid'))
            ->join('perfils', 'users.id_perfil', '=', 'perfils.id')
            ->orderBy('users.id', 'desc')
            ->get();
        return view('layouts.users.index', compact('users'));
    }

    public function show($id)
    {
        $post = User::where('id', $id)->first();
        if (!$post) {
            return false;
        } else {
            return $post;
        }
    }

    public function destroy($id)
    {
        $post = User::where('id', $id)->first();
        if (!$post) {
            return false;
        } else {

            $post->delete();
            return true;
        }
    }

    public function create(createUserPost $request)
    {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'id_perfil' => $request->id_perfil,
            'password' => Hash::make($request->password)
        ]);

        return true;
        //return redirect()->route('users.index');

    }

    public function put(Request $request, $id)
    {
        $user = User::find($id);
        $input = array(
            'name' => $request->name,
            'email' => $request->email,
            'id_perfil' => $request->id_perfil,
            'password' => $request->password,
        );


        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'id_perfil' => ['required', 'int']
        ])->validateWithBag('updateProfileInformation');


        if (!$user) {
            return redirect()->back();
        } else {

            if (
                $input['email'] !== $user->email &&
                $user instanceof MustVerifyEmail
            ) {
                $this->updateVerifiedUser($user, $input);
            } else {
                $user->forceFill([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'id_perfil' => $input['id_perfil'],
                    'password' => Hash::make($input['password'])
                ])->save();
            }
            return true;
        }
    }
}
