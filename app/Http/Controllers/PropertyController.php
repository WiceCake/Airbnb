<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Address;
use App\Models\Amenity;
use App\Models\Discount;
use App\Models\Property;
use App\Models\Discounts;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\PropertyPolicy;
use App\Models\PropertyAddress;
use App\Models\PropertyAmenity;
use App\Models\PropertyPicture;
use App\Models\PropertyDiscount;
use App\Models\CancellationPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('web')->user();
        $properties = Property::where('manager_id', $user->id)->get();

        return view('property-list')->with(compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $amenities = Amenity::all();
        $types = Type::all();
        $policies = CancellationPolicy::all();

        // if($)

        return view('property-add')->with(compact('amenities', 'types', 'policies'));
    }

    public function getAddress(Request $request){
        if($request->province){
            $city = collect(json_decode(Storage::get('public/city.json')))->filter(function($item) use ($request){
                return $item->province_code == $request->province;
            })->select('city_code', 'city_name');

            return [...$city];
        }

        if($request->city){
            $brgy = collect(json_decode(Storage::get('public/barangay.json')))->filter(function($item) use ($request){
                return $item->city_code == $request->city;
            })->select('brgy_code', 'brgy_name');

            return [...$brgy];
        }

        $province = collect(json_decode(Storage::get('public/province.json')));

        return $province->select('province_code', 'province_name');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::guard('web')->user();

        $validate = $request->validate([
            'title' => 'required|unique:properties,property_title',
            'description' => 'required',
            'slug' => 'required|unique:properties,slug',
            'cp' => 'required',
            'type' => 'required',
            'capacity' => 'required',
            'no_beds' => 'required',
            'no_bedrooms' => 'required',
            'no_bathrooms' => 'required',
            'price' => 'required',
            'brgy' => 'required',
            'municipality' => 'required',
            'province' => 'required',
            'amenities' => 'required'
        ]);

        $property = Property::create([
            "manager_id" => $user->id,
            "property_title" => $request->title,
            "description" => $request->description,
            "slug" => $request->slug,
            "capacity" => $request->capacity,
            "no_of_beds" => $request->no_beds,
            "no_of_bedrooms" => $request->no_bedrooms,
            "no_of_bathrooms" => $request->no_bathrooms,
            "price" => $request->price,
            "status" => "listed"
        ]);

        foreach($request->amenities as $amenity){
            PropertyAmenity::create([
                "property_id" => $property->id,
                "amenity_id" => $amenity
            ]);
        }

        $address = Address::where(['province' => $request->province, 'municipality' => $request->municipality, 'barangay' => $request->brgy])->first();
        
        if ($address == null) {
            $address = Address::create([
                "province" => $request->province,
                "municipality" => $request->municipality,
                "barangay" => $request->brgy
            ]);
        }

        PropertyAddress::create([
            "property_id" => $property->id,
            "address_id" => $address->id
        ]);

        PropertyPolicy::create([
            "property_id" => $property->id,
            "policy_id" => $request->cp
        ]);

        PropertyType::create([
            "property_id" => $property->id,
            "type_id" => $request->type
        ]);

        return redirect('/')->with('message', 'Property Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {     
        $user = Auth::guard('web')->user();
        $property = Property::where('slug', $slug)->first();

        if($property->manager_id != $user->id){
            return redirect('/');
        }

        $pictures = $property->pictures;
        $discountApplied = $property->discounts->pluck('discount_id');
        $discounts = Discount::all()->except(4);
        
        if($discountApplied->count() > 0){
            $discounts = Discount::whereNotIn('id', $discountApplied)->get()->except(4);
        }

        return view('property')->with(compact('property', 'pictures', 'slug', 'discounts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $user = Auth::guard('web')->user();
        $property = Property::where('slug', $slug)->first();

        if($property->manager_id != $user->id){
            return redirect('/');
        }
        
        $amenities = Amenity::all();
        $types = Type::all();
        $policies = CancellationPolicy::all();

        return view('property-edit')->with(compact('property','amenities', 'types', 'policies', 'slug'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {

        $validate = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'slug' => 'required',
            'cp' => 'required',
            'type' => 'required',
            'capacity' => 'required',
            'no_beds' => 'required',
            'no_bedrooms' => 'required',
            'no_bathrooms' => 'required',
            'price' => 'required',
            'brgy' => 'required',
            'municipality' => 'required',
            'province' => 'required',
            'amenities' => 'required'
        ]);

        $property = Property::where('slug', $slug)->first();

        $property->manager_id = 1;
        $property->property_title = $request->title;
        $property->description = $request->description;
        $property->slug = $request->slug;
        $property->capacity = $request->capacity;
        $property->no_of_beds = $request->no_beds;
        $property->no_of_bedrooms = $request->no_bedrooms;
        $property->no_of_bathrooms = $request->no_bathrooms;
        $property->price = $request->price;
        
        $property->save();

        PropertyAmenity::where('property_id', $property->id)->delete();

        foreach($request->amenities as $amenity){
            PropertyAmenity::create([
                "property_id" => $property->id,
                "amenity_id" => $amenity
            ]);
        }

        $address = Address::where(['province' => $request->province, 'municipality' => $request->municipality, 'barangay' => $request->brgy])->first();
        
        if ($address == null) {
            $address = Address::create([
                "province" => $request->province,
                "municipality" => $request->municipality,
                "barangay" => $request->brgy
            ]);
        }

        $propertyAddress = PropertyAddress::where('property_id', $property->id)->first();
        $propertyAddress->property_id = $property->id;
        $propertyAddress->address_id = $address->id;
        $propertyAddress->save();

        $propertyPolicy = PropertyPolicy::where('property_id', $property->id)->first();
        $propertyPolicy->property_id = $property->id;
        $propertyPolicy->policy_id = $request->cp;
        $propertyPolicy->save();

        $propertyType = PropertyType::where('property_id', $property->id)->first();
        $propertyType->property_id = $property->id;
        $propertyType->type_id = $request->type;
        $propertyType->save();

        return redirect('properties/'.$slug)->with('message', 'Property Details Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addPhoto(Request $request, $slug){
        $validate = $request->validate([
            'photo' => 'required|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $file->store('public/pictures');

            $property = Property::where('slug', $slug)->first();
            PropertyPicture::create([
                'property' => $property->id,
                'path' => 'storage/pictures/'.$file->hashName()
            ]);

            return redirect()->back()->with('message', 'Picture Added Successfully');
        }
    }

    public function addDiscount(Request $request, $slug){

        $validate = $request->validate([
            'value' => 'required|numeric|min:1|max:100'
        ]);

        $property = Property::where('slug', $slug)->first();

        PropertyDiscount::create([
            'property_id' => $property->id,
            'discount_id' => $request->discount_id,
            'changed_value' => $request->value / 100
        ]);

        return redirect()->back()->with('message', 'Discount Added Successfully');
    }

    public function removeDiscount(Request $request){
        PropertyDiscount::destroy($request->discount_id);

        return redirect()->back()->with('message', 'Discount Deleted Successfully');
    }

    public function editDiscount(Request $request){
        $validate = $request->validate([
            'percentage' => 'required|numeric|min:1|max:100'
        ]);

        $discount = PropertyDiscount::find($request->discount_id);
        $discount->changed_value = $request->percentage / 100;
        $discount->save();

        return redirect()->back()->with('message', 'Discount Edited Successfully');
    }

    public function editStatus(Request $request, $slug){
        $validate = $request->validate([
            'status' => 'required|in:listed,unlisted'
        ]);

        $property = Property::where('slug', $slug)->first();
        $property->status = $request->status;
        $property->save();

        return back();
    }

    public function showAllReviews($slug){
        $user = Auth::guard('web')->user();
        $property = Property::where('slug', $slug)->first();

        if($property->manager_id != $user->id){
            return redirect('/');
        }

        return view('property-reviews')->with(compact('property'));
    }
}
