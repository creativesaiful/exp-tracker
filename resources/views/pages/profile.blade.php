@extends('layouts.app')

@section('content')


    <div class="card card-body" id="profile">
        <div class="row justify-content-center align-items-center">
            <div class="col-sm-auto col-4">
                <div class="avatar avatar-xl position-relative">
                    <img src="{{ $user->profile_photo_path ? asset('storage/uploads/' . $user->profile_photo_path) : asset('assets/img/placeholder.png') }}" alt="bruce" class="w-100 rounded-circle shadow-sm">
                </div>
            </div>
            <div class="col-sm-auto col-8 my-auto">
                <div class="h-100">
                    <h5 class="mb-1 font-weight-bolder">
                        {{ $user->name }}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        {{ $user->email }}
                    </p>
                </div>
            </div>

        </div>

        <div class="card mt-4" id="basic-info">
            <div class="card-header">
                <h5>Basic Info</h5>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="multisteps-form__form">

                @if (count($errors) > 0)
                <div class="alert alert-danger text-white">
                    <ul>
               
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

               @csrf
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group input-group-static">
                                <label>First Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-static">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" name="phone"
                                    value="{{ @$user->phone ? $user->phone : '+880123456789' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6">
                            <label class="form-control ms-0">Default Currency</label>
                            <select class="form-control p-2 border" name="default_currency" id="choices-category">
                                <option selected="" disabled>Select</option>
                                <option value="usd" > USD </option>
                                <option value="bdt">BDT </option>
                                <option value="uae">UAE</option>
                                <option value="euro">EURO</option>
                            </select>
                        </div>

                     

                        <div class="col-6">
                            <label class="form-control mb-0">Profile images</label>
                            <input type="file" name="profile_image" class="form-control"  >
                        </div>

                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-6">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </div>

                </div>

            </form>
        </div>
    @endsection

    @section('scripts')
            {{-- I want to add currecny exchange rate scripts --}}


    @endsection 
