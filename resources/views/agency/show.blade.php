@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  @if (count($errors) > 0)
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  @endif
                  <form action="{{url('agency/upload/'. $offer[0]->id_offer)}}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      Product photos (can attach more than one):
                      <br />
                      <input type="file" name="photos[]" multiple />
                      <br /><br />
                      <input type="submit" value="Upload " />
                  </form>
                  <form action="{{url('agency/upload/floor/plan/'. $offer[0]->id_offer)}}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      Floor plan photo (You can upload only one photo):
                      <br />
                      <input type="file" name="floor_plan" multiple />
                      <br /><br />
                      <input type="submit" value="Upload Floor Plan" />
                  </form>
                  <p>This is the offers details: </p>
                  <ul>
                    <li>Name: {{$offer[0]->name}}</li>
                    <li>Address: {{$offer[0]->address}}</li>
                    <li>Description: {{$offer[0]->description}}</li>
                    <li>Leke: {{$offer[0]->leke}}</li>
                    <li>Euro: {{$offer[0]->euro}}</li>
                    <li>Bedrooms: {{$offer[0]->bedrooms}}</li>
                    <li>Bathrooms: {{$offer[0]->bathrooms}}</li>
                    <li>Parking Spaces: {{$offer[0]->parking_space}}</li>
                    <li>Area: {{$offer[0]->size}}</li>
                    <li>Air_conditioning: {{$offer[0]->air_conditioning}}</li>
                    <li>Heating: {{$offer[0]->heating}}</li>
                    <li>Solar Panel: {{$offer[0]->solar_panel}}</li>
                    <li>Water Tank: {{$offer[0]->water_tank}}</li>
                    <li>Type: {{$type[0]->type}}</li>
                    <li>Floor Plan: <img src="{{url('/storage/'. $offer[0]->floor_plan)}}" alt=""></li>

                    @foreach ($offer[0]->photos as $photo)
                      <img src="{{url('/storage/'.$photo->photo) }}" alt="">
                    @endforeach
                  </ul>
                  <div id='map-canvasShow'></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeC6LGq4kgkPgPRitwvNB3vNoXwPWObhA&callback=initMap" async defer></script>
<script type="text/javascript">
  function initMap(){
      var location = {lat: {{$offer[0]->latitude}}, lng: {{$offer[0]->longitude}}};
      var map = new google.maps.Map(document.getElementById('map-canvasShow'), {
        zoom: 12,
        center: location
      });

      var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: '{{ $offer[0]->name }}'
      });
  }
</script>
@endsection
