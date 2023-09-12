@extends('admin.admin_dashboard')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <div class="page-content">

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property Details</h6>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td>Property Name</td>
                                    <td><code>{{ $property->property_name }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Status</td>
                                    <td><code>{{ $property->property_status }}</code></td>
                                </tr>
                                <tr>
                                    <td>Lowest Price</td>
                                    <td><code>{{ $property->lowest_price }}</code></td>
                                </tr>
                                <tr>
                                    <td>Maximum price</td>
                                    <td><code>{{ $property->max_price }}</code></td>
                                </tr>
                                <tr>
                                    <td>Bedrooms</td>
                                    <td><code>{{ $property->bedrooms }}</code></td>
                                </tr>
                                <tr>
                                    <td>Bathrooms</td>
                                    <td><code>{{ $property->bathrooms }}</code></td>
                                </tr>
                                <tr>
                                    <td>Garage</td>
                                    <td><code>{{ $property->garage }}</code></td>
                                </tr>
                                <tr>
                                    <td>Garage Size</td>
                                    <td><code>{{ $property->garage_size }}</code></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><code>{{ $property->address }}</code></td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td><code>{{ $property->city }}</code></td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td><code>{{ $property->state }}</code></td>
                                </tr>
                                <tr>
                                    <td>Postal code</td>
                                    <td><code>{{ $property->postal_code }}</code></td>
                                </tr>
                                <tr>
                                    <td>Main Image</td>
                                    <td>
                                        <img src="{{ asset($property->property_thumbnail) }}" style="width:100px; height:70px" alt="thumbnail" >
                                    </td>
                                </tr>
                                <tr>
                                    <td> Property status </td>
                                    <td>
                                        @if($property->status == 1)
                                            <span class="badge rounded-pill bg-success" >Active</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger" >Inactive</span>
                                        @endif
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property Details</h6>
                        <div class="table-responsive">
                            <table class="table table-striped">

                                <tbody>
                                <tr>
                                    <td>Property Code</td>
                                    <td><code>{{ $property->property_code }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Size</td>
                                    <td><code>{{ $property->property_size }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Video</td>
                                    <td><code>{{ $property->property_video }}</code></td>
                                </tr>

                                <tr>
                                    <td>Neighborhood</td>
                                    <td><code>{{ $property->neighborhood }}</code></td>
                                </tr>
                                <tr>
                                    <td>Latitude</td>
                                    <td><code>{{ $property->latitude }}</code></td>
                                </tr>
                                <tr>
                                    <td>Longitude</td>
                                    <td><code>{{ $property->longitude }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Type</td>
                                    <td><code>{{ $property['type']['type_name'] }}</code></td> <!-- 'type' = metoda v property controlleru = uvádí spojitost mezi tabulkami. -->
                                </tr>
                                <tr>
                                    <td>Property Amenities</td>
                                    <td>
                                        <select class="js-example-basic-multiple form-select"
                                                name="amenities_id[]" multiple="multiple" data-width="100%">
                                            @foreach($amenities as $amenity)
                                                <option
                                                    value="{{ $amenity->id }}" {{ (in_array($amenity->id,$property_amenities)) ? 'selected' : '' }} > {{ $amenity->amenities_name }} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Agent</td>
                                    <td>
                                        @if($property->agent_id == null)
                                         <code> Admin </code>
                                        @else
                                         <code> {{ $property['user']['name'] }} </code>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Short Description</td>
                                    <td><code>{{ $property->short_description }}</code></td>
                                </tr>
                                </tbody>
                            </table>
<br><br>
                            @if($property->status == 1)
                                <form method="post" action="{{ route('deactivate.property') }}"  >
                                @csrf
                                    <input type="hidden" name="id" value="{{ $property->id }}">
                                    <button type="submit" class="btn btn-primary">Deactivate</button>
                                </form>
                            @else
                                <form method="post" action="{{ route('activate.property') }}"  >
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $property->id }}">
                                    <button type="submit" class="btn btn-primary">Activate</button>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
