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
                  <form action="{{url('agency/upload/'. $offer->id_offer)}}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      Product photos (can attach more than one):
                      <br />
                      <input type="file" name="photos[]" multiple />
                      <br /><br />
                      <input type="submit" value="Upload " />
                  </form>
                  <form action="{{url('agency/upload/floor/plan/'. $offer->id_offer)}}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      Floor plan photo (You can upload only one photo):
                      <br />
                      <input type="file" name="floor_plan" multiple />
                      <br /><br />
                      <input type="submit" value="Upload Floor Plan" />
                  </form>
                  <p>This is the offers details: </p>
                  <ul>
                    <li>Name: {{$offer->name}}</li>
                    <li>Address: {{$offer->address}}</li>
                    <li>Description: {{$offer->description}}</li>
                    <li>Leke: {{$offer->leke}}</li>
                    <li>Euro: {{$offer->euro}}</li>
                    <li>Bedrooms: {{$offer->bedrooms}}</li>
                    <li>Bathrooms: {{$offer->bathrooms}}</li>
                    <li>Parking Spaces: {{$offer->parking_space}}</li> 
                    <li>Area: {{$offer->size}}</li>
                    <li>Air_conditioning: {{$offer->air_conditioning}}</li>
                    <li>Heating: {{$offer->heating}}</li> 
                    <li>Solar Panel: {{$offer->solar_panel}}</li>
                    <li>Water Tank: {{$offer->water_tank}}</li> 
                    <li>Type: {{$type->type}}</li> 
                    <li>Agency: {{$agency->name}}</li> 
                    <li>Floor Plan: <img src="{{url('/storage/'. $offer->floor_plan)}}" alt=""></li>

                    @foreach ($offer->photos as $photo)
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
      var location = {lat: {{$offer->latitude}}, lng: {{$offer->longitude}}};
      var map = new google.maps.Map(document.getElementById('map-canvasShow'), {
        zoom: 12,
        center: location
      });

      var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: '{{ $offer->name }}'
      });
  }
</script>
@endsection
