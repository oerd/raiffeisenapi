{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Dashboard</div>--}}

                {{--<div class="panel-body">--}}
                  {{--<form class="form-horizontal" method="POST" action="{{ url('agency/edit/'.$offers->id_offer) }}">--}}
                      {{--{{ csrf_field() }}--}}
                      {{--<p>{{$agency->name}}</p>--}}

                      {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                          {{--<label for="name" class="col-md-4 control-label">Name</label>--}}

                          {{--<div class="col-md-6">--}}
                              {{--<input id="name" type="text" class="form-control" name="name" value="{{ $offers->name }}" required autofocus>--}}

                              {{--@if ($errors->has('name'))--}}
                                  {{--<span class="help-block">--}}
                                      {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                  {{--</span>--}}
                              {{--@endif--}}
                          {{--</div>--}}
                      {{--</div>--}}

                      {{--<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">--}}
                          {{--<label for="address" class="col-md-4 control-label">Address</label>--}}

                          {{--<div class="col-md-6">--}}
                              {{--<input id="address" type="text" class="form-control" value="{{ $offers->address }}" name="address"  required>--}}

                              {{--@if ($errors->has('address'))--}}
                                  {{--<span class="help-block">--}}
                                      {{--<strong>{{ $errors->first('address') }}</strong>--}}
                                  {{--</span>--}}
                              {{--@endif--}}
                          {{--</div>--}}
                      {{--</div>--}}

                      {{--<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">--}}
                          {{--<label for="password" class="col-md-4 control-label">Description</label>--}}

                          {{--<div class="col-md-6">--}}
                              {{--<input id="description" type="text" class="form-control" value="{{ $offers->description }}" name="description" required>--}}

                              {{--@if ($errors->has('description'))--}}
                                  {{--<span class="help-block">--}}
                                      {{--<strong>{{ $errors->first('description') }}</strong>--}}
                                  {{--</span>--}}
                              {{--@endif--}}
                          {{--</div>--}}
                      {{--</div>--}}

                      {{--<div class="form-group">--}}
                          {{--<label for="leke" class="col-md-4 control-label">Currency</label>--}}

                          {{--<div class="col-md-6">--}}
                              {{--<input id="leke" type="text" class="form-control" name="leke" value="{{ $offers->leke }}" required>--}}
                          {{--</div>--}}
                      {{--</div>--}}

                      {{--<div class="form-group">--}}
                          {{--<label for="bedrooms" class="col-md-4 control-label">Bedrooms</label>--}}

                          {{--<div class="col-md-6">--}}
                              {{--<input id="bedrooms" type="text" class="form-control" name="bedrooms"  value="{{ $offers->bedrooms }}" required>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                      {{--<div class="form-group">--}}
                          {{--<label for="bathrooms" class="col-md-4 control-label">Bathrooms</label>--}}

                          {{--<div class="col-md-6">--}}
                              {{--<input id="bathrooms" type="text" class="form-control" name="bathrooms" value="{{ $offers->bathrooms }}" required>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                      {{--<div class="form-group">--}}
                          {{--<label for="parking_spaces" class="col-md-4 control-label">Parking Spaces</label>--}}

                          {{--<div class="col-md-6">--}}
                              {{--<input id="parking_spaces" type="text" class="form-control" name="parking_spaces" value="{{ $offers->parking_space }}" required>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                      {{--<div class="form-group">--}}
                          {{--<label for="size" class="col-md-4 control-label">Area</label>--}}

                          {{--<div class="col-md-6">--}}
                              {{--<input id="size" type="text" class="form-control" name="size" value="{{ $offers->size }}" required>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                      {{--<div class="form-group">--}}
                          {{--<label for="air_conditioning" class="col-md-4 control-label">Air Conditioning</label>--}}

                          {{--<div class="col-md-6">--}}
                            {{--<div class="radio">--}}
                              {{--<label>--}}
                                {{--<input type="radio" name="air_conditioning" id="air_conditioning1" value="1" >--}}
                                {{--Yes--}}
                              {{--</label>--}}
                            {{--</div>--}}
                            {{--<div class="radio">--}}
                              {{--<label>--}}
                                {{--<input type="radio" name="air_conditioning" id="air_conditioning0" value="0" checked>--}}
                                {{--No--}}
                              {{--</label>--}}
                            {{--</div>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                      {{--<div class="form-group">--}}
                          {{--<label for="heating" class="col-md-4 control-label">Heating</label>--}}

                          {{--<div class="col-md-6">--}}
                            {{--<div class="radio">--}}
                              {{--<label>--}}
                                {{--<input type="radio" name="heating" id="heating1" value="1" >--}}
                                {{--Yes--}}
                              {{--</label>--}}
                            {{--</div>--}}
                            {{--<div class="radio">--}}
                              {{--<label>--}}
                                {{--<input type="radio" name="heating" id="heating0" value="0" checked>--}}
                                {{--No--}}
                              {{--</label>--}}
                            {{--</div>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                      {{--<div class="form-group">--}}
                          {{--<label for="solar_panel" class="col-md-4 control-label">Solar panel</label>--}}

                          {{--<div class="col-md-6">--}}
                            {{--<div class="radio">--}}
                              {{--<label>--}}
                                {{--<input type="radio" name="solar_panel" id="solar_panel1" value="1" >--}}
                                {{--Yes--}}
                              {{--</label>--}}
                            {{--</div>--}}
                            {{--<div class="radio">--}}
                              {{--<label>--}}
                                {{--<input type="radio" name="solar_panel" id="solar_panel0" value="0" checked>--}}
                                {{--No--}}
                              {{--</label>--}}
                            {{--</div>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                      {{--<div class="form-group">--}}
                          {{--<label for="water_tank" class="col-md-4 control-label">Water Tank</label>--}}

                          {{--<div class="col-md-6">--}}
                              {{--<div class="radio">--}}
                                {{--<label>--}}
                                  {{--<input type="radio" name="water_tank" id="water_tank1" value="1" >--}}
                                  {{--Yes--}}
                                {{--</label>--}}
                              {{--</div>--}}
                              {{--<div class="radio">--}}
                                {{--<label>--}}
                                  {{--<input type="radio" name="water_tank" id="water_tank0" value="0" checked>--}}
                                  {{--No--}}
                                {{--</label>--}}
                              {{--</div>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                      {{--<div class="form-group">--}}
                          {{--<label for="active" class="col-md-4 control-label">Sold</label>--}}

                          {{--<div class="col-md-6">--}}
                              {{--<div class="radio">--}}
                                {{--<label>--}}
                                  {{--<input type="radio" name="active" id="active1" value="0" >--}}
                                  {{--Yes--}}
                                {{--</label>--}}
                              {{--</div>--}}
                              {{--<div class="radio">--}}
                                {{--<label>--}}
                                  {{--<input type="radio" name="active" id="active0" value="1" checked>--}}
                                  {{--No--}}
                                {{--</label>--}}
                              {{--</div>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                      {{--<div class="form-group">--}}
                        {{--<label for="water_tank" class="col-md-4 control-label">Lloji prones</label>--}}

                        {{--<div class="col-md-6">--}}
                          {{--<select id="type" name="type">--}}
                            {{--@foreach($types as $type)--}}
                            {{--<option value="{{ $type->id_types }}">{{$type->type}}</option>--}}
                            {{--@endforeach--}}
                          {{--</select>--}}
                        {{--</div>--}}
                      {{--</div>--}}
                       {{--<div id="map-canvas"></div>--}}
                      {{--<br>--}}
                      {{--<div class="form-group">--}}
                          {{--<div class="col-md-6 col-md-offset-3">--}}
                              {{--<button type="submit" class="btn btn-block btn-primary">--}}
                                  {{--Edit Offer--}}
                              {{--</button>--}}
                          {{--</div>--}}
                      {{--</div>--}}
                  {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeC6LGq4kgkPgPRitwvNB3vNoXwPWObhA&callback=initMap" async defer></script>--}}
{{--<script type="text/javascript">--}}
  {{--function initMap(){--}}
      {{--var location = {lat: {{$offers->latitude}}, lng: {{$offers->longitude}}};--}}
      {{--var map = new google.maps.Map(document.getElementById('map-canvas'), {--}}
        {{--zoom: 4,--}}
        {{--center: location--}}
      {{--});--}}
      {{--var marker = new google.maps.Marker({--}}
        {{--position: location,--}}
        {{--map: map,--}}
        {{--title: '{{ $offers->name }}'--}}
      {{--});--}}

  {{--}--}}
{{--</script>--}}
{{--@endsection--}}

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
            var map = new google.maps.Map(document.getElementById('mapView'), {
                center: {lat: {{$offers->latitude}}, lng: {{$offers->longitude}}},
                zoom: 13
            });
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input);

            // Bind the map's bounds (viewport) property to the autocomplete object,
            // so that the autocomplete requests use the current map bounds for the
            // bounds option in the request.
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();
            var infowindowContent = document.getElementById('infowindow-content');
            infowindow.setContent(infowindowContent);
            var marker = new google.maps.Marker({
                map: map,
                draggable:true,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocomplete.addListener('place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                $('#lat').val(place.geometry.location.lat());
                $('#lng').val(place.geometry.location.lng());
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);  // Why 17? Because it looks good.
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            });
            google.maps.event.addListener(marker, 'dragend', function(evt){
                $('#lat').val(evt.latLng.lat());
                $('#lng').val(evt.latLng.lng());
            });
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeC6LGq4kgkPgPRitwvNB3vNoXwPWObhA&libraries=places&callback=initMap"
            async defer></script>
    <div style="background:#f3f3f3" class="maincontent">
        <div id="mapView"></div>
        <div id="content" class="mob-max" >
            <div class="rightContainer">
                <h1>List a New Property</h1>
                <form role="form" method="POST" action="{{ url('/admin/listings/edit/'. $offers->id_offer) }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name= "name"  value="{{$offers->name }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Price</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <select id="currency" name="currency">
                                                <option value="EUR">EUR</option>
                                                <option value="ALL">ALL</option>
                                            </select>
                                        </div>
                                        <input class="form-control" name = "money" value="{{$offers->euro}}" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="5" value="" name="description">{{$offers->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Address <span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                            <input class="form-control" type="text" id="address"  value="{{ $offers->address }}" name="address" placeholder="Enter a Location" >
                            <p class="help-block">You can drag the marker to property position</p>
                            <input style="display:none" type="text" id="lat" name="latitude">
                            <input style="display:none" type="text" id="lng" name="longitude">
                        </div>
                        <div class="form-group">
                            <label>Agency Name</label>
                            <input class="form-control" type="text" id="agency" value="{{$agency->name}}" name="agency" placeholder="Agency Name" >
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label>Bedrooms</label>
                                    <input type="text" name="bedrooms" value="{{$offers->bedrooms}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <div class="form-group">
                                    <label>Bathrooms</label>
                                    <input type="text" name="bathroom" value=" {{$offers->bathrooms}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Area</label>
                                    <div class="input-group">
                                        <input class="form-control" name="size"  value="{{$offers->size}}" type="text">
                                        <div class="input-group-addon">m2</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                <div class="form-group">
                                    <label>Type</label>
                                    <br>
                                    <div class="input-group">
                                        <select id="typehome" name="type">
                                            @foreach($types as $type)
                                                <option value="{{ $type->id_types }}">{{$type->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                {{--<div class="form-group">--}}
                                {{--<label>Image Gallery</label>--}}
                                {{--<div class="file-input file-input-new"><input type="hidden"><div class="file-preview ">--}}
                                {{--</div>--}}


                                {{--<div class="btn btn-o btn-default btn-file"> <i class="material-icons">&#xE2C8;</i> &nbsp;Browse Images <input type="file" class="file" multiple="" data-show-upload="false" data-show-caption="false" data-show-remove="false" accept="image/jpeg,image/png" data-browse-class="btn btn-o btn-default" data-browse-label="Browse Images" id="1513170029698"></div>--}}
                                {{--</div>--}}
                                {{--<p class="help-block">You can select multiple images at once</p>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Amenities</label>
                                        <div class="checkbox custom-checkbox"><label><input type="checkbox" name="parking_space"> Parking Spaces </label></div>
                                        <div class="checkbox custom-checkbox"><label><input type="checkbox" name="water_tank"> Water Tank </label></div>


                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <div class="checkbox custom-checkbox"><label><input type="checkbox" name="air_conditioning"> Air Conditioning</label></div>
                                        <div class="checkbox custom-checkbox"><label><input type="checkbox" name="heating"> Heating</label></div>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <div class="checkbox custom-checkbox"><label><input type="checkbox" name="solar_panel"> Solar Panel </label></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-green btn-lg isThemeBtn">Edit Property</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

@endsection
