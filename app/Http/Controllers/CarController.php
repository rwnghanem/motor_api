<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Http\Request;
use Nette\Utils\Validators;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();

        return response($cars, 200);
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
     * @param  \App\Http\Requests\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|min:3',
            'model' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'author' => 'required',
            'image' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $fields['image'] = $imageName;
            $request->file('image')->storeAs('public/uploads', $imageName);
        }

        $car = Car::create($fields);


        $message = [
            'message' => 'car created successfuly',
            'car' => $car
        ];
        return response($message, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {

        return response($car, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        // dd($request->all());
        $fields = $request->validate([
            'name' => 'required|min:3',
            'model' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'author' => 'required',
        ]);

        if ($request->hasFile('image')) {
            unlink(storage_path('app/public/uploads/' . $car->image));
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $fields['image'] = $imageName;
            $request->file('image')->storeAs('public/uploads', $imageName);
        } else {
            $fields['image'] = $car->image;
        }


        $car->update($fields);


        $message = [
            'message' => 'car updated successfuly',
            'car' => $car
        ];
        return response($message, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        unlink(storage_path('app/public/uploads/' . $car->image));
        $car->delete();
        $message = [
            'message' => 'car deleted successfuly',
        ];
        return response($message, 200);
    }
}