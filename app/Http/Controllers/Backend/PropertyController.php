<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Amenities;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PropertyController extends Controller
{

    public function allProperties()
    {

        $property = Property::latest()->get();
        return view('backend.property.all_properties', compact('property'));

    }

    public function addProperty()
    {

        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status', 'active')->where('role', 'agent')->latest()->get();


        return view('backend.property.add_property', compact('propertytype', 'amenities', 'activeAgent'));
    }

    public function storeProperty(Request $request)
    {
        $amen = $request->amenities_id;
        $amenities = implode(',', $amen);
        $pcode = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);

        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = 'upload/property/thumbnail/' . $name_gen;
        Image::make($image)->resize(370, 250)->save($save_url);

        $property_id = Property::insertGetId([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_description' => $request->short_description,
            'long_Description' => $request->long_description,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'status' => 1,
            'property_thumbnail' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        // Multiple Image Upload from form to another table

        $images = $request->file('multi_img');
        foreach ($images as $img) {

            $multi_name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            $uploadPath = 'upload/property/multi-img/' . $multi_name_gen;
            Image::make($img)->resize(770, 520)->save($uploadPath);

            MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }

        $facilities = count($request->facility_name);

        if ($facilities != NULL) {
            for ($i = 0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->property_id = $property_id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->distance = $request->distance[$i];
                $fcount->save();


            }
        }
        $notification = array(
            'message' => 'Property inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.properties')->with($notification);
    }

    public function editProperty($id)
    {
        $facilities = Facility::where('property_id', $id)->get();
        $property = Property::findOrFail($id);

        $type = $property->amenities_id;
        $property_amenities = explode(',', $type);

        $multiImages = MultiImage::where('property_id', $id)->get();

        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status', 'active')->where('role', 'agent')->latest()->get();


        return view('backend.property.edit_property', compact('property', 'amenities', 'propertytype', 'activeAgent', 'property_amenities', 'multiImages', 'facilities'));

    }

    public function updateProperty(Request $request)
    {
        $property_id = $request->id;
        $amen = $request->amenities_id;
        $amenities = implode(',', $amen);


        Property::findOrFail($property_id)->update([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_description' => $request->short_description,
            'long_Description' => $request->long_description,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Property updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.properties')->with($notification);
    }

    public function updatePropertyThumbnail(Request $request)
    {

        $pro_id = $request->id;
        $oldImg = $request->old_img;
        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = 'upload/property/thumbnail/' . $name_gen;
        Image::make($image)->resize(370, 250)->save($save_url);

        if (file_exists($oldImg)) {
            unlink($oldImg);
        }

        Property::findOrFail($pro_id)->update([
            'property_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Property Thumbnail Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function updatePropertyMultiImg(Request $request)
    {
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            unlink($imgDel->photo_name);

            $multi_name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            $uploadPath = 'upload/property/multi-img/' . $multi_name_gen;
            Image::make($img)->resize(770, 520)->save($uploadPath);

            MultiImage::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Multiple Images Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function propertyMultiImgDelete($id)
    {
        $oldImg = MultiImage::findOrFail($id);
        unlink($oldImg->photo_name);
        MultiImage::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function storeNewMultiImg(Request $request)
    {
        $new_multi = $request->imageId;
        $image = $request->file('multi_img');

        $multi_name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $uploadPath = 'upload/property/multi-img/' . $multi_name_gen;
        Image::make($image)->resize(770, 520)->save($uploadPath);

        MultiImage::insert([
            'property_id' => $new_multi,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Image Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function updatePropertyFacilities(Request $request)
    {
        $pid = $request->id;

        if ($request->facility_name == NULL) {
            return redirect()->back();
        } else {
            Facility::where('property_id', $pid)->delete();
            $facilities = count($request->facility_name);
            for ($i = 0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->property_id = $pid;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->distance = $request->distance[$i];
                $fcount->save();
            }
        }
        $notification = array(
            'message' => 'Property Facilities Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function deleteProperty($id){
        $property = Property::findOrFail($id);
        unlink($property->property_thumbnail);

        Property::findOrFail($id)->delete();
        $image = MultiImage::where('property_id', $id)->get();

        foreach ($image as $img){
            unlink($img->photo_name);
            MultiImage::where('property_id', $id)->delete();
        }
        $facilitiesData = Facility::where('property_id', $id)->get();

        foreach ($facilitiesData as $item){
            Facility::where('property_id', $id)->delete();
        }
        $notification = array(
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function detailsProperty($id){
        $facilities = Facility::where('property_id', $id)->get();
        $property = Property::findOrFail($id);

        $type = $property->amenities_id;
        $property_amenities = explode(',', $type);

        $multiImages = MultiImage::where('property_id', $id)->get();

        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status', 'active')->where('role', 'agent')->latest()->get();


        return view('backend.property.details_property', compact('property', 'amenities', 'propertytype', 'activeAgent', 'property_amenities', 'multiImages', 'facilities'));


    }
    public function deactivateProperty(Request $request){
        $pid = $request->id;
        Property::findOrFail($pid)->update([
           'status' => 0,
        ]);
        $notification = array(
            'message' => 'Property deactivated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.properties')->with($notification);
    }
    public function activateProperty(Request $request){
        $pid = $request->id;
        Property::findOrFail($pid)->update([
            'status' => 1,
        ]);
        $notification = array(
            'message' => 'Property activated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.properties')->with($notification);
    }

}
