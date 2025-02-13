<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Vehicle;
use App\Models\Propulsion;
use App\Models\Auditable;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Models\Image;


class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request):view
    {
      

        $models=VehicleModel::all();
        $makes=VehicleMake::all();
        $categories=Category::all();
        $propulsions=Propulsion::all();
        $modelIdColumns = VehicleModel::select('make_id')->get();
        $makesIdColumns = VehicleMake::select('id')->get();




        // log::info($makes);
        // log::info($categories);
        

        return view('manufacturers.create-vehicle', compact('categories','propulsions', 'makes', 'models','makesIdColumns', 'modelIdColumns'));
    }

    //hii ndo inf
    public function store(Request $request){
    $validatedData = $request->validate([
        'make_id' => 'required|exists:vehicle_makes,id',
        'model_id' => 'required|exists:vehicle_models,id',
        'category_id' => 'required|exists:categories,id',
        'propulsion_id' => 'required|exists:propulsions,id',
        'year_of_manufacture' => 'required|integer|min:1900|max:' . now()->year,
        'colour' => 'required|string|max:50',
        'numberplate' => 'required|string|max:50|unique:vehicles,numberplate',
        'images.*' => 'required|image',
    ]);



    // Create the vehicle entry first
    $vehicle = Vehicle::create([
        'make_id'=>$request->make_id,
        'model_id'=>$request->model_id,
        'category_id' => $request->category_id,
        'propulsion_id' => $request->propulsion_id,
        'colour' => $request->colour,
        'numberplate' => $request->numberplate, 

    ]);

    log::info($request);
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('imageOfVehicles', 'public');
            Image::create([
                'image_path' => $path,  
                'vehicle_id' => $vehicle->id,



            ]);
        }
    }

    return view('manufacturers.confirmation');
    }

    /**
     * Display the specified resource.
     */
    public function show_one_vehicle(string $id)
    {
       


        $vehicle = Vehicle::findOrFail($id);
        return view('manufacturers.cars-details', compact('vehicle'));
    }





    public function vehicles_show_all()
    {
       


        $vehicles = Vehicle::get();
        return view('manufacturers.more-car-details', compact('vehicles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'make_id' => 'required|exists:vehicle_makes,id',
            'model_id' => 'required|exists:vehicle_models,id',
            'category_id' => 'required|exists:categories,id',
            'propulsion_id' => 'required|exists:propulsions,id',
            'year_of_manufacture' => 'required|integer|min:1900|max:' . now()->year,
            'colour' => 'required|string|max:50',
            'numberplate' => 'required|string|max:50|unique:vehicles,numberplate,' . $id,
            'images.*' => 'nullable|image',
        ]);
    
        
        $vehicle = Vehicle::findOrFail($id);
    
       
        $vehicle->update([
            'make_id' => $request->make_id,
            'model_id' => $request->model_id,
            'category_id' => $request->category_id,
            'propulsion_id' => $request->propulsion_id,
            'colour' => $request->colour,
            'numberplate' => $request->numberplate,
        ]);
    
        
        if ($request->hasFile('images')) {
            // Optionally, delete old images before saving new ones
            foreach ($vehicle->images as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }
            
            foreach ($request->file('images') as $image) {
                $path = $image->store('imageOfVehicles', 'public');
                Image::create([
                    'image_path' => $path,
                    'vehicle_id' => $vehicle->id,
                ]);
            }
        }
    
        return redirect()->route('vehicles.show', $vehicle->id)->with('success', 'Vehicle updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
