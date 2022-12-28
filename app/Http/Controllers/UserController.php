<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return response($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $fields['image'] = $imageName;
            $request->file('image')->storeAs('public/uploads', $imageName);
        }

        $user = User::create($fields);


        $message = [
            'message' => 'user created successfuly',
            'user' => $user
        ];
        return response($message, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $message = [
            'message' => 'user created successfuly',
            'user' => $user
        ];
        return response($message, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $fields = $request->validate([
            'name' => 'required|min:3',
            'email' =>  'required|email|unique:users,email,' . $user->id,
            'password' => 'required',
            'role' => 'required',
        ]);

        if ($request->hasFile('image')) {
            unlink(storage_path('app/public/uploads/' . $user->image));
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $fields['image'] = $imageName;
            $request->file('image')->storeAs('public/uploads', $imageName);
        }


        $user->update($fields);


        $message = [
            'message' => 'user updated successfuly',
            'car' => $user
        ];
        return response($message, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        unlink(storage_path('app/public/uploads/' . $user->image));

        $user->delete();
        $message = [
            'message' => 'user deleted successfuly',
        ];
        return response($message, 200);
    }


    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required',
            'image' => 'required',
        ]);

        if ($request->has('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $fields['image'] = $imageName;
            $request->file('image')->storeAs('public/uploads', $imageName);
        }


        $user = User::create($fields);


        $message = [
            'message' => 'user registerd successfuly',
            'user' => $user
        ];
        return response($message, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);

        $user = User::where('email', $fields['email'])->first(['password']);;
        $msg = '';
        if (!empty($user->password)) {
            if (($fields['password'] == $user->password)) {
                $msg = 'Account is exist and the password is correct';
            } else {

                $msg = "Password is incorrect";
            }
        } else {
            $msg = "Email is incorrect";
        }
        $message = [
            'message' => $msg,
            'user' => User::where('email', $fields['email'])->first()
        ];
        return response($message, 201);
    }
}