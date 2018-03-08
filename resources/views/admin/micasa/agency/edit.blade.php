@extends('admin.micasa.panel')

@section('content')
    <script>
        $(document).ready(function(){
            $('input[type="checkbox"]').on('change', function(){
                this.value = this.checked ? 1 : 0;
                // alert(this.value);
            }).change();
        });

        function initMap() {
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input);


        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeC6LGq4kgkPgPRitwvNB3vNoXwPWObhA&libraries=places&callback=initMap"
            async defer></script>
    <div style="background:#f3f3f3" class="maincontent">
        <div style="width: 100%;" id="content" class="mob-max" >
            <div class="rightContainer">
                <h1>Edit agency</h1>
                <form role="form" method="POST" action="{{url('admin/agency/edit/'. $agency->id_agency)}}">
                {{csrf_field()}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Name Surname</label>
                                    <input type="text" name= "name" value= "{{$user->name}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Agency Name</label>
                                    <input type="text" name= "agency_name" value="{{$agency->name}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name= "email" value="{{$user->email}}"class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Cel</label>
                                    <input type="number" name= "cel" value="{{$user->phone}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name= "username" value="{{$user->username}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name= "password" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address <span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                        <input class="form-control" type="text" id="address" name="address" value="{{$agency->address}}" placeholder="Enter a Location" >
                        <p class="help-block">You can drag the marker to property position</p>
                        <input style="display:none" type="text" id="lat" name="latitude">
                        <input style="display:none" type="text" id="lng" name="longitude">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="text" name= "url" value="{{$agency->url}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-green btn-lg isThemeBtn">Edit Agency</button>
                        </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    </div>
@endsection
