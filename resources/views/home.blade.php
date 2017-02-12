@extends('layouts.app')

@section('content')
<div class="container">
    @include('flash::message')
    @if ($contacts->count())
        <div class="row">
            <div class="col-md-12" style="margin-bottom:2%">
                <a type="button" class="btn btn-primary pull-right create-contact-btn" data-toggle="modal" data-target="#create-contact-modal">
                    Create contact</a>
            </div>

            @foreach($contacts as $contact)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail" style="background-color: #FFFFFF">
                    <div class="caption">
                        <h3><a href="{{route('home.edit', ['contact' => $contact])}}">{{$contact->getFullname()}}</a></h3>
                        <p>
                            <span class="glyphicon glyphicon-earphone"></span> {{$contact->gender}}
                        </p>
                        <p>
                            <span class="glyphicon glyphicon-phone"></span> {{$contact->contact_number}}
                        </p>
                        <p>
                            <span class="glyphicon glyphicon-envelope"></span> {{$contact->email}}
                        </p>
                        <p>
                            <span class="glyphicon glyphicon-earphone"></span> {{$contact->address}}
                        </p>
                        <p>
                            <a href="#" class="btn btn-primary" role="button">Edit</a>
                            <a href="#" class="btn btn-danger" role="button">Delete</a>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-12 text-center">
            {{$contacts->links()}}
        </div>

    @else
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <h2>Here is empty!</h2>

                    <div class="col-md-12">
                        <a type="button" class="btn btn-primary create-contact-btn" data-toggle="modal" data-target="#create-contact-modal">
                            Create first contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="modal fade" id="create-contact-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form name="create-contact-form" method="POST" action="{{route('home.store')}}">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create contact</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <select class="form-control" name="title">
                                    <option>- Title -</option>
                                    <option value="Mr.">Mr</option>
                                    <option value="Mrs.">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Dr.">Dr</option>
                                    <option value="Prof.">Prof</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first-name-input" placeholder="First name">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last-name-input" placeholder="Last name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" id="gender-male-radio" value="Male">Male
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="gender" id="gender-female-radio" value="Female">Female
                                        </label>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="email">Phone Number</label>
                                <input type="text" name="contact_number" class="form-control" id="contact-number-input" placeholder="Phone Number">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email-input" placeholder="Email">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Address</label>
                                <textarea class="form-control" rows="3" name="address" id="address-textarea"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
