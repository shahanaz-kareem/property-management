<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\region;
use App\Models\images;
use App\Models\Property;
use DB;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    public function index(){

        $region = region::get();
        return view('properties.store',compact('region'));
    }

      public function list(){

        $property = Property::get();
        return view('properties.list',compact('property'));
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'featured_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors(),
        ], 422);
    }

    DB::beginTransaction();
    try {
       $properties = new Property();
       $properties->title = $request->title;
       $properties->description = $request->description;
       $properties->type = $request->type;
       $properties->price = $request->price; 
       $properties->location = $request->location;
       $properties->region_id = $request->region_id;
       $properties->save();

         if ($request->hasFile('featured_image')) {
            foreach ($request->file('featured_image') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/property'), $imageName);

                images::create([
                    'property_id' => $properties->id,
                    'name' => $imageName,
                ]);
            }
        }

       
        DB::commit();
        return response()->json(['data' => $properties ]);


        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
