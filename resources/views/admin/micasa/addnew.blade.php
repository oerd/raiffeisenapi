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
                center: {lat: 41.3275459, lng: 19.81869819999997},
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
                <form role="form" method="POST" action="{{ url('/admin/add') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name= "name" class="form-control">
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
                                    <input class="form-control" name = "money" type="text"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="4" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label> Address <span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                        <input class="form-control" type="text" id="address" name="address" placeholder="Enter a Location" />
                        <p class="help-block">You can drag the marker to property position</p>
                        <input style="display:none" type="text" id="lat" name="latitude"/>
                        <input style="display:none" type="text" id="lng" name="longitude"/>
                    </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group">
                                    <label>Agency Name</label>
                                    <select id="typehome" name="agency">
                                        @foreach($agency as $agent)
                                            <option value="{{ $agent->id_agency }}">{{$agent->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Hipoteka</label>
                                    <select id="hipotek" name="hipotek">
                                        <option value="1">Me Hipotekë</option>
                                        <option value="0">Pa Hipotekë</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            <div class="form-group">
                                <label>Bedrooms</label>
                                <input type="text" name="bedrooms" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            <div class="form-group">
                                <label>Bathrooms</label>
                                <input type="text" name="bathroom" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label>Area</label>
                                <div class="input-group">
                                    <input class="form-control" name="size" type="text"/>
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
                            <div class="form-group">
                                <label>Image Gallery</label>
                                <div class="file-input file-input-new"><input type="hidden"><div class="file-preview "></div>
                                    <div class="btn btn-o btn-default btn-file"> <i class="material-icons">&#xE2C8;</i> &nbsp;Browse Images <input type="file" name="photo" class="file" multiple="" data-show-upload="false" data-show-caption="false" data-show-remove="false" accept="image/jpeg,image/png" data-browse-class="btn btn-o btn-default" data-browse-label="Browse Images" id="1513170029698"/></div>
                                </div>
                                <p class="help-block">You can select multiple images at once</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label>Amenities</label>
                                <div class="checkbox custom-checkbox"><label><input  type="checkbox" value="0" name="parking_space"/> Parking Spaces </label></div>
                                <div class="checkbox custom-checkbox"><label><input type="checkbox" value="0" name="water_tank"/> Water Tank </label></div>


                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div class="checkbox custom-checkbox"><label><input type="checkbox" value= "0" name="air_conditioning"/> Air Conditioning</label></div>
                                <div class="checkbox custom-checkbox"><label><input type="checkbox" value="0" name="heating"/> Heating</label></div>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div class="checkbox custom-checkbox"><label><input type="checkbox" value="0" name="solar_panel"/> Solar Panel </label></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button style="z-index: 9;position: relative;" type="submit" class="btn btn-green btn-lg isThemeBtn">Add Property</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    </div>

@endsection
