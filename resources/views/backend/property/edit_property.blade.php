@extends('admin.admin_dashboard')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <div class="page-content">


        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Edit Property</h6>
                            <form method="post" action="{{ route('update.property') }}" id="myForm" enctype="multipart/form-data" >
                                @csrf

                                <input type="hidden" name="id" value="{{ $property->id }}">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Property Name</label>
                                            <input type="text" name="property_name" class="form-control"
                                                   placeholder="Enter property name" value="{{ $property->property_name }}" >
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Property Status</label>
                                            <select class="form-select" name="property_status"
                                                    id="exampleFormControlSelect1">
                                                <option selected="" disabled="">Select status</option>
                                                <option value="rent" {{ $property->property_status =='rent' ? 'selected' : '' }} >Rent</option>
                                                <option value="purchase" {{ $property->property_status =='purchase' ? 'selected' : '' }} >Purchase</option>
                                            </select>
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-group form-label">Lowest Price</label>
                                            <input type="text" name="lowest_price" class="form-control" value="{{ $property->lowest_price }}" >
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-group form-label">Maximum Price</label>
                                            <input type="text" class="form-select" name="max_price"
                                                   id="exampleFormControlSelect1" value="{{ $property->max_price }}" >

                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Bedrooms</label>
                                            <input type="text" class="form-control" name="bedrooms" value="{{ $property->bedrooms }}" >
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Bathrooms</label>
                                            <input type="text" class="form-control" name="bathrooms" value="{{ $property->bathrooms }}" >
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Garage</label>
                                            <input type="text" class="form-control" name="garage" value="{{ $property->garage }}" >
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Garage size</label>
                                            <input type="text" class="form-control" name="garage_size" value="{{ $property->garage_size }}" >
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" value="{{ $property->address }}" >
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" name="city" value="{{ $property->city }}" >
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" name="state" value="{{ $property->state }}" >
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Postal code</label>
                                            <input type="text" class="form-control" name="postal_code" value="{{ $property->postal_code }}" >
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Size</label>
                                            <input type="text" class="form-control" name="property_size" value="{{ $property->property_size }}" >
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Video</label>
                                            <input type="text" class="form-control" name="property_video" value="{{ $property->property_video }}" >
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Neighborhood</label>
                                            <input type="text" class="form-control" name="neighborhood" value="{{ $property->neighborhood }}" >
                                        </div>
                                    </div><!-- Row -->
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Latitude</label>
                                            <input type="text" name="latitude" class="form-control" value="{{ $property->latitude }}" >
                                            <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                               target="_blank"> Address to latitude converter </a>

                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Longitude</label>
                                            <input type="text" name="longitude" class="form-control" value="{{ $property->longitude }}" >
                                            <a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                               target="_blank"> Address to longitude converter </a>

                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class=" mb-3">
                                            <label class="form-label">Property Type</label>
                                            <select class="form-select" name="ptype_id" id="property_type">
                                                <option selected="" disabled="">Select Type</option>
                                                @foreach($propertytype as $ptype)
                                                    <option value="{{ $ptype->id }}" {{ $ptype->id == $property->ptype_id ? 'selected' : '' }} > {{ $ptype->type_name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <div class="mb-3" data-select2-id="7">
                                                <label class="form-label">Select Amenities</label>
                                                <select class="js-example-basic-multiple form-select"
                                                        name="amenities_id[]" multiple="multiple" data-width="100%">
                                                    @foreach($amenities as $amenity)
                                                        <option
                                                            value="{{ $amenity->id }}" {{ (in_array($amenity->id,$property_amenities)) ? 'selected' : '' }} > {{ $amenity->amenities_name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Agent</label>
                                            <select class="form-select" name="agent_id" id="agent_id">
                                                <option selected="" disabled="">Select Agent</option>
                                                @foreach($activeAgent as $agent)
                                                    <option value="{{ $agent->id }}" {{ $agent->id == $property->agent_id ? 'selected' : '' }} > {{ $agent->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div><!-- Row -->
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea class="form-control" id="short_description" name="short_description"
                                                  rows="3"> {{ $property->short_description }} </textarea>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Long Description</label>
                                        <textarea class="form-control" name="long_description" id="tinymceExample"
                                                  rows="10"> {!! $property->long_description !!} </textarea>
                                    </div>
                                </div><!-- Col -->
                                <hr>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="featured" value="1" class="form-check-input"
                                               id="checkInline1" {{ $property->featured == '1' ? 'checked' : '' }} >
                                        <label class="form-check-label" for="checkInline1"  >
                                            Featured Property
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="hot" value="1" class="form-check-input"
                                               id="checkInline2" {{ $property->hot == '1' ? 'checked' : '' }} >
                                        <label class="form-check-label" for="checkInline2">
                                            Hot Property
                                        </label>
                                    </div>
                                </div>

                                <!--- facility  --->



                                <button type="submit" class="btn btn-primary">Save changes</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
        </div>
    </div>

    <!-- Thumbnail image update -->
    <div class="page-content" style="margin-top: -35px" >

        <div class="row profile-body">
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Edit Main Thumbnail Image</h6>
                            <form method="post" action="{{ route('update.property.thumbnail') }}" id="myForm" enctype="multipart/form-data" >
                                @csrf

                                <input type="hidden" name="id" value="{{ $property->id }}" >
                                <input type="hidden" name="old_img" value="{{ $property->property_thumbnail }}" >

                                    <div class="row  mb-3">
                                        <div class="form-group col-md-6">
                                            <label class=" form-label">Main Thumbnail</label>
                                            <input type="file" name="property_thumbnail" class="form-control"
                                                   onchange="mainThumUrl(this)">
                                            <img src="" id="mainThumb">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class=" form-label"></label>
                                            <img src="{{ asset($property->property_thumbnail) }}" style=" width:100px; height:100px; " >
                                        </div>
                                    </div><!-- Col -->

                                <button type="submit" class="btn btn-primary">Save changes</button>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Thumbnail image update end -->
    <!-- multi image update beginning-->
    <div class="page-content" style="margin-top: -35px" >

        <div class="row profile-body">
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Edit Multi Images</h6>
                            <form method="post" action="{{ route('update.property.multiImg') }}" id="myForm" enctype="multipart/form-data" >
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>S1</th>
                                            <th>Image</th>
                                            <th>Change Image</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($multiImages as $key => $img)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td class="py-1">
                                            <img src="{{ asset($img->photo_name) }}" alt="image" style="width:50px; height:50px;" >
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" name="multi_img[{{ $img->id }}]">
                                            </td>
                                            <td>
                                                <input type="submit" class="btn btn-primary px-4" value="Update Image" >
                                                <a href="{{ route('property.multiImg.delete',$img->id) }}" class="btn btn-danger" id="delete" >Delete image</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            </form>
                            <form method="post" action="{{ route('store.new.multiImg') }}" id="myForm" enctype="multipart/form-data" >
                            @csrf
                                <input type="hidden" name="imageId" value="{{ $property->id }}">
                                <table class="table table-striped">
                                <tbody>
                                <tr>
                                <td>
                                    <input type="file" class="form-control" name="multi_img">

                                </td>
                                <td>
                                    <input type="submit"  class="btn btn-info px-4" value="Add image" >
                                </td>
                            </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- facility update -->

    <div class="page-content" style="margin-top: -35px" >

        <div class="row profile-body">
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Edit Property Facilities</h6>
                            <form method="post" action="{{ route('update.property.facilities') }}" id="myForm" enctype="multipart/form-data" >
                                @csrf

                                <input type="hidden" name="id" value="{{ $property->id }}">
                                @foreach($facilities as $item)
                                    <div class="row add_item">
                                    <div class="whole_extra_item_add" id="whole_extra_item_add">

                                    <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                    <div class="container mt-2">
                                        <div class="row">

                                            <div class="form-group col-md-4">
                                                <label for="facility_name">Facilities</label>
                                                <select name="facility_name[]" id="facility_name" class="form-control">
                                                    <option value="">Select Facility</option>
                                                    <option value="Hospital" {{ $item->facility_name == 'Hospital' ? 'selected' : '' }} >Hospital</option>
                                                    <option value="SuperMarket" {{ $item->facility_name == 'SuperMarket' ? 'selected' : '' }} >Super Market</option>
                                                    <option value="School" {{ $item->facility_name == 'School' ? 'selected' : '' }} >School</option>
                                                    <option value="Entertainment" {{ $item->facility_name == 'Entertainment' ? 'selected' : '' }} >Entertainment</option>
                                                    <option value="Pharmacy" {{ $item->facility_name == 'Pharmacy' ? 'selected' : '' }} >Pharmacy</option>
                                                    <option value="Airport" {{ $item->facility_name == 'Airport' ? 'selected' : '' }} >Airport</option>
                                                    <option value="Railways" {{ $item->facility_name == 'Railways' ? 'selected' : '' }} >Railways</option>
                                                    <option value="Bus Stop" {{ $item->facility_name == 'Bus Stop' ? 'selected' : '' }} >Bus Stop</option>
                                                    <option value="Beach" {{ $item->facility_name == 'Beach' ? 'selected' : '' }} >Beach</option>
                                                    <option value="Mall" {{ $item->facility_name == 'Mall' ? 'selected' : '' }} >Mall</option>
                                                    <option value="Bank" {{ $item->facility_name == 'Bank' ? 'selected' : '' }} >Bank</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="distance">Distance</label>
                                                <input type="text" name="distance[]" id="distance" class="form-control" value="{{ $item->distance }}" >
                                            </div>
                                            <div class="form-group col-md-4" style="padding-top: 20px">
                                                <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                                                <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                                    </div>
                                @endforeach
<br><br>
                                <button type="submit" class="btn btn-primary">Save Changes</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- multi image update end-->

    <!--========== Start of add multiple class with ajax ==============-->
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2">
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label for="facility_name">Facilities</label>
                            <select name="facility_name[]" id="facility_name" class="form-control">
                                <option value="">Select Facility</option>
                                <option value="Hospital">Hospital</option>
                                <option value="SuperMarket">Super Market</option>
                                <option value="School">School</option>
                                <option value="Entertainment">Entertainment</option>
                                <option value="Pharmacy">Pharmacy</option>
                                <option value="Airport">Airport</option>
                                <option value="Railways">Railways</option>
                                <option value="Bus Stop">Bus Stop</option>
                                <option value="Beach">Beach</option>
                                <option value="Mall">Mall</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="distance">Distance</label>
                            <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                        </div>
                        <div class="form-group col-md-4" style="padding-top: 20px">
                            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                            <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!----For Section-------->
    <script type="text/javascript">
        $(document).ready(function(){
            var counter = 0;
            $(document).on("click",".addeventmore",function(){
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click",".removeeventmore",function(event){
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>
    <!--========== End of add multiple class with ajax ==============-->



    <script type="text/javascript">
        $(document).ready(function () {
            $('#myForm').validate({
                rules: {
                    property_name: {
                        required: true,
                    },
                    property_status: {
                        required: true,
                    },
                    lowest_price: {
                        required: true,
                    },
                    max_price: {
                        required: true,
                    },
                    property_thumbnail: {
                        required: true,
                    },
                    multi_img: {
                        required: true,
                    },

                },
                messages: {
                    property_name: {
                        required: 'Please Enter Name of the Property',
                    },
                    property_status: {
                        required: 'Please Select Status of the Property',
                    },
                    lowest_price: {
                        required: 'Please Enter the lowest price',
                    },
                    max_price: {
                        required: 'Please Enter the maximum price',
                    },
                    property_thumbnail: {
                        required: 'Please Enter the thumbnail',
                    },
                    multi_img: {
                        required: 'Please Enter images',
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>
    <script type="text/javascript">
        function mainThumUrl(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#mainThumb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#multiImg').on('change', function () { //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function (index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function (file) { //trigger function on successful read
                                return function (e) {
                                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });

    </script>

@endsection
