@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')
        <div class="row">
            <form name="create-contact-form" method="POST" action="{{route('home.update', ['contact' => $contact])}}">
                <input type="hidden" name="_method" value="put">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Edit contact</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <select class="form-control" name="title">
                                    <option>- Title -</option>
                                    <option value="Mr." {{$contact->title == 'Mr.' ? 'selected' : ''}}>Mr</option>
                                    <option value="Mrs." {{$contact->title == 'Mrs.' ? 'selected' : ''}}>Mrs</option>
                                    <option value="Miss" {{$contact->title == 'Miss.' ? 'selected' : ''}}>Miss</option>
                                    <option value="Dr." {{$contact->title == 'Dr.' ? 'selected' : ''}}>Dr</option>
                                    <option value="Prof." {{$contact->title == 'Prof.' ? 'selected' : ''}}>Prof</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first-name-input"
                                       placeholder="First name" value="{{old('first_name', $contact->first_name)}}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last-name-input"
                                       placeholder="Last name" value="{{old('last_name', $contact->last_name)}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="gender-male-radio" value="Male"
                                                {{$contact->gender == 'Male' ? 'checked' : ''}}>Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="gender-female-radio" value="Female"
                                                {{$contact->gender == 'Female' ? 'checked' : ''}}>Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="email">Phone Number</label>
                                <input type="text" name="contact_number" class="form-control" id="contact-number-input"
                                       placeholder="Phone Number" value="{{old('contact_number', $contact->contact_number)}}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email-input"
                                       placeholder="Email" value="{{old('email', $contact->email)}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Address</label>
                                <textarea class="form-control" rows="3" name="address" id="address-textarea">{{$contact->address}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection