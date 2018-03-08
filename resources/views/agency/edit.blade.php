@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <form class="form-horizontal" method="POST" action="{{ url('agency/edit/'.$offers[0]->id_offer) }}">
                      {{ csrf_field() }}

                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-4 control-label">Name</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control" name="name" value="{{ $offers[0]->name }}" required autofocus>

                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                          <label for="address" class="col-md-4 control-label">Address</label>

                          <div class="col-md-6">
                              <input id="address" type="text" class="form-control" value="{{ $offers[0]->address }}" name="address"  required>

                              @if ($errors->has('address'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('address') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                          <label for="password" class="col-md-4 control-label">Description</label>

                          <div class="col-md-6">
                              <input id="description" type="text" class="form-control" value="{{ $offers[0]->description }}" name="description" required>

                              @if ($errors->has('description'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="leke" class="col-md-4 control-label">Currency</label>

                          <div class="col-md-6">
                              <input id="leke" type="text" class="form-control" name="leke" value="{{ $offers[0]->leke }}" required>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="bedrooms" class="col-md-4 control-label">Bedrooms</label>

                          <div class="col-md-6">
                              <input id="bedrooms" type="text" class="form-control" name="bedrooms"  value="{{ $offers[0]->bedrooms }}" required>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="bathrooms" class="col-md-4 control-label">Bathrooms</label>

                          <div class="col-md-6">
                              <input id="bathrooms" type="text" class="form-control" name="bathrooms" value="{{ $offers[0]->bathrooms }}" required>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="parking_spaces" class="col-md-4 control-label">Parking Spaces</label>

                          <div class="col-md-6">
                              <input id="parking_spaces" type="text" class="form-control" name="parking_spaces" value="{{ $offers[0]->parking_space }}" required>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="size" class="col-md-4 control-label">Area</label>

                          <div class="col-md-6">
                              <input id="size" type="text" class="form-control" name="size" value="{{ $offers[0]->size }}" required>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="air_conditioning" class="col-md-4 control-label">Air Conditioning</label>

                          <div class="col-md-6">
                            <div class="radio">
                              <label>
                                <input type="radio" name="air_conditioning" id="air_conditioning1" value="1" >
                                Yes
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="air_conditioning" id="air_conditioning0" value="0" checked>
                                No
                              </label>
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="heating" class="col-md-4 control-label">Heating</label>

                          <div class="col-md-6">
                            <div class="radio">
                              <label>
                                <input type="radio" name="heating" id="heating1" value="1" >
                                Yes
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="heating" id="heating0" value="0" checked>
                                No
                              </label>
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="solar_panel" class="col-md-4 control-label">Solar panel</label>

                          <div class="col-md-6">
                            <div class="radio">
                              <label>
                                <input type="radio" name="solar_panel" id="solar_panel1" value="1" >
                                Yes
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="solar_panel" id="solar_panel0" value="0" checked>
                                No
                              </label>
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="water_tank" class="col-md-4 control-label">Water Tank</label>

                          <div class="col-md-6">
                              <div class="radio">
                                <label>
                                  <input type="radio" name="water_tank" id="water_tank1" value="1" >
                                  Yes
                                </label>
                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="water_tank" id="water_tank0" value="0" checked>
                                  No
                                </label>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="active" class="col-md-4 control-label">Sold</label>

                          <div class="col-md-6">
                              <div class="radio">
                                <label>
                                  <input type="radio" name="active" id="active1" value="0" >
                                  Yes
                                </label>
                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="active" id="active0" value="1" checked>
                                  No
                                </label>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="water_tank" class="col-md-4 control-label">Lloji prones</label>

                        <div class="col-md-6">
                          <select id="type" name="type">
                            @foreach($types as $type)
                            <option value="{{ $type->id_types }}">{{$type->type}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                       <div id="map-canvas"></div>
                      <br>
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-3">
                              <button type="submit" class="btn btn-block btn-primary">
                                  Edit Offer
                              </button>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeC6LGq4kgkPgPRitwvNB3vNoXwPWObhA&callback=initMap" async defer></script>
<script type="text/javascript">
  function initMap(){
      var location = {lat: {{$offers[0]->latitude}}, lng: {{$offers[0]->longitude}}};
      var map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 4,
        center: location
      });
      var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: '{{ $offers[0]->name }}'
      });

  }
</script>
@endsection
