<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCount = User::all()->count();
        $carCount = Car::all()->count();
        return view('index', compact('userCount', 'carCount'));
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }



    public function viewLogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {

        $fileds = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::all()->where('email', $fileds['email']);
        $errors = [];
        if (!empty($admin->all())) {
            $myAdmin = $admin->all()[0] ?? '';

            if ($myAdmin && ($fileds['password'] == $myAdmin->password)) {
                session()->push('myAdmin', $fileds);
                return redirect('/');
            } else {

                $errors['password'] = "Password is incorrect";
            }
        } else {
            $errors['email'] = "Email is incorrect";
        }

        return redirect('/login')->with('errors', $errors);
    }

    public function logout()
    {
        session()->forget('myAdmin');
        return redirect('/');
    }



    // Users
    // Users
    // Users
    // Users
    // Users
    public function usersIndex()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function usersCreate()
    {
        return view('users.create');
    }
    public function usersStore(Request $request)
    {
        // dd($request->all());
        $fields = $request->validate([
            'name' => 'required|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required',
            'image' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $fields['image'] = $imageName;
            $request->file('image')->storeAs('public/uploads', $imageName);
        }

        $user = User::create($fields);


        return redirect('/dashboard/users')->with('message', 'user created successfuly');
    }
    public function usersDestroy(User $user)
    {
        unlink(storage_path('app/public/uploads/' . $user->image));

        $user->delete();
        return redirect('/dashboard/users')->with('message', 'user deleted successfuly');
    }


    public function usersEdit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    public function usersUpdate(Request $request, User $user)
    {
        $fields = $request->validate([
            'name' => 'required|min:3unique:users,name,' . $user->id,
            'email' =>  'required|email|unique:users,email,' . $user->id,
            'password' => 'required',
            'role' => 'required',
        ]);

        if ($request->hasFile('image')) {
            unlink(storage_path('app/public/uploads/' . $user->image));
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $fields['image'] = $imageName;
            $request->file('image')->storeAs('public/uploads', $imageName);
        } else {
            $fields['image'] = $user->image;
        }


        $user->update($fields);

        return redirect('/dashboard/users')->with('message', 'user updated successfuly');
    }


    // cars
    // cars
    // cars
    // cars
    // cars
    // cars
    // cars

    public function carsIndex()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function carsDestroy(Car $car)
    {
        unlink(storage_path('app/public/uploads/' . $car->image));

        $car->delete();
        return redirect('/dashboard/cars')->with('message', 'Car deleted successfuly');
    }
}