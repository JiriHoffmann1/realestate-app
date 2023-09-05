@extends('admin.admin_dashboard')
@section('admin')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <div class="page-content">


        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Edit Property Type</h6>

                            <form method="POST" action="{{ route('update.amenity') }}" class="forms-sample">
                                @csrf

                                <input type="hidden" name="id" value="{{ $amenities->id }}">


                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Amenity Name   </label>
                                    <input type="text" name="amenities_name" class="form-control @error('amenities_name') is-invalid @enderror " value="{{ $amenities->amenities_name }}" >
                                    @error('amenities_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary me-2">Save Changes </button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->

        </div>

    </div>



@endsection
