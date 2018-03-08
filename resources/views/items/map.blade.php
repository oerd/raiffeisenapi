<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <style>
       #map-canvas {
         height: 500px;
         margin-top: 50px;
       }

        html, body {
            height: 100%;
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        #description {
          font-family: Roboto;
          font-size: 15px;
          font-weight: 300;
        }

        #infowindow-content .title {
          font-weight: bold;
        }

        #infowindow-content {
          display: none;
        }

        #map #infowindow-content {
          display: inline;
        }

        .pac-card {
          margin: 10px 10px 0 0;
          border-radius: 2px 0 0 2px;
          box-sizing: border-box;
          -moz-box-sizing: border-box;
          outline: none;
          box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
          background-color: #fff;
          font-family: Roboto;
        }

        #pac-container {
          padding-bottom: 12px;
          margin-right: 12px;
        }

        .pac-controls {
          display: inline-block;
          padding: 5px 11px;
        }

        .pac-controls label {
          font-family: Roboto;
          font-size: 13px;
          font-weight: 300;
        }

        #pac-input {
          background-color: #fff;
          font-family: Roboto;
          font-size: 15px;
          font-weight: 300;
          margin-left: 12px;
          padding: 0 11px 0 13px;
          text-overflow: ellipsis;
          width: 400px;
        }

        #pac-input:focus {
          border-color: #4d90fe;
        }

        #title {
          color: #fff;
          background-color: #4d90fe;
          font-size: 25px;
          font-weight: 500;
          padding: 6px 12px;
        }
        #target {
          width: 345px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
          @if (Auth::check())
            @if(Auth::user()->role == 2)
              <a href="{{ url('agency/offers') }}">Agency</a>
            @endif

            @if(Auth::user()->role == 0)
              <p>Admin</p>
              <a href="{{url('/admin')}}">Admin</a>
            @endif

            @if(Auth::user()->role == 1)
              <p>User</p>
              <a href="{{ url('/home') }}">Home</a>
            @endif
          @else
              <a href="{{ url('/login') }}">Login</a>
              <a href="{{ url('/register') }}">Register</a>
          @endif
            <div class="col-lg-6">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
              </span>
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
        </div> <br/> <br/><br/>
    @endif
    <div class="container">
      <div class="row">
        <div id="map-canvas"></div>
      </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeC6LGq4kgkPgPRitwvNB3vNoXwPWObhA&callback=initMap" async
    defer></script>

    <script type="text/javascript">
    function initMap() {
      var location = {lat: {{$offers[0]->latitude}}, lng: {{$offers[0]->longitude}}};
      var mapOptions = {
        zoom: 8,
        center: location,
        mapTypeId: 'roadmap'
      }
      var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
      // Create the search box and link it to the UI element.
      var input = document.getElementById('pac-input');
      var searchBox = new google.maps.places.SearchBox(input);
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

      // Bias the SearchBox results towards current map's viewport.
      map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
      });

      var markers = [];
      // Listen for the event fired when the user selects a prediction and retrieve
      // more details for that place.
      searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
          return;
        }

      @foreach($offers as $offer)
      var marker{{$offer->id}} = new google.maps.Marker({
        position: {lat: {{$offer->latitude}}, lng: {{$offer->longitude}}},
        map: map,
        title: "{{$offer->name}}"
      });
      map.addListener('center_changed', function () {
        window.setTimeout(function () {
          map.panTo(marker{{$offer->id}}.getPosition());
        }, 30000);
      });
      marker{{$offer->id}}.addListener('click', function () {
        map.setZoom(16);
        map.setCenter(marker{{$offer->id}}.getPosition());
      });
      @endforeach
    });
  }
    </script>
    <!-- // <script>
    //   // This example adds a search box to a map, using the Google Place Autocomplete
    //   // feature. People can enter geographical searches. The search box will return a
    //   // pick list containing a mix of places and predicted search terms.
    //
    //   // This example requires the Places library. Include the libraries=places
    //   // parameter when you first load the API. For example:
    //   // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    //
    //   function initAutocomplete() {
    //     var map = new google.maps.Map(document.getElementById('map'), {
    //       center: {lat: -33.8688, lng: 151.2195},
    //       zoom: 13,
    //       mapTypeId: 'roadmap'
    //     });
    //
    //     // Create the search box and link it to the UI element.
    //     var input = document.getElementById('pac-input');
    //     var searchBox = new google.maps.places.SearchBox(input);
    //     map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    //
    //     // Bias the SearchBox results towards current map's viewport.
    //     map.addListener('bounds_changed', function() {
    //       searchBox.setBounds(map.getBounds());
    //     });
    //
    //     var markers = [];
    //     // Listen for the event fired when the user selects a prediction and retrieve
    //     // more details for that place.
    //     searchBox.addListener('places_changed', function() {
    //       var places = searchBox.getPlaces();
    //
    //       if (places.length == 0) {
    //         return;
    //       }
    //
    //       // Clear out the old markers.
    //       markers.forEach(function(marker) {
    //         marker.setMap(null);
    //       });
    //       markers = [];
    //
    //       // For each place, get the icon, name and location.
    //       var bounds = new google.maps.LatLngBounds();
    //       places.forEach(function(place) {
    //         if (!place.geometry) {
    //           console.log("Returned place contains no geometry");
    //           return;
    //         }
    //         var icon = {
    //           url: place.icon,
    //           size: new google.maps.Size(71, 71),
    //           origin: new google.maps.Point(0, 0),
    //           anchor: new google.maps.Point(17, 34),
    //           scaledSize: new google.maps.Size(25, 25)
    //         };
    //
    //         // Create a marker for each place.
    //         markers.push(new google.maps.Marker({
    //           map: map,
    //           icon: icon,
    //           title: place.name,
    //           position: place.geometry.location
    //         }));
    //
    //         if (place.geometry.viewport) {
    //           // Only geocodes have viewport.
    //           bounds.union(place.geometry.viewport);
    //         } else {
    //           bounds.extend(place.geometry.location);
    //         }
    //       });
    //       map.fitBounds(bounds);
    //     });
    //   }
    //
    // </script> -->

</div>
</body>
</html>
