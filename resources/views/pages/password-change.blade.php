@extends('layouts.app')
xxxxxxxxxxxxxxxx
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

        <div class="card mt-4" id="basic-info">`
            <div class="card-header">
                <h5>Update / Change Password</h5>
            </div>
            <form action="{{ route('pages.password-change') }}" method="POST" enctype="multipart/form-data" class="multisteps-form__form">

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
                            <div class="input-group input-group-static text-center">
                                <label>Existing Password</label>
                                <input type="text" name="existing-password" class="form-control" value="{{}}">
                            </div>
                            <div class="input-group input-group-static text-center">
                                <label>New Password</label>
                                <input type="text" name="new-password" class="form-control" value="{{}}">
                            </div>
                            <div class="input-group input-group-static text-center">
                                <label>Confirm Password</label>
                                <input type="text" name="confirm-password" class="form-control" value="{{}}">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-6">
                            <input type="submit" value="Update" class="btn btn-primary d-block">
                            <input type="" value="Change Password" class="btn btn-warning w-25">
                        </div>
                    </div>

                </div>

            </form>
        </div>
    @endsection

    @section('scripts')
            {{-- I want to add currecny exchange rate scripts --}}


    @endsection 
