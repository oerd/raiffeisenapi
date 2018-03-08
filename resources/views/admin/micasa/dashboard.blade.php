@extends('admin.micasa.panel')

@section('content')
<div class="maincontent">
    <div class="adminroute">
        <i class="material-icons">&#xE88A;</i>
        <span> <b> / </b> Shtepia Ime Admin Panel <b> / </b> </span>
        <span class="partup"> Dashboard </span>
    </div>
    <div class="adminpage">
        <span class="partdown">DASHBOARD</span>
        <text class="partdesc">Welcome back Raiffeisen Bank</text>
    </div>
    <div class="loadhere">
      <div class="infocards">
              <div class="cards firstcard">
                  <i class="material-icons">&#xE425;</i>
                  <span><b>{{$countProp}} </b>PROPERTIES <text>added last week</text></span>
              </div>
              <div class="cards secondcard">
                  <span><b>214 </b>APP DOWNLOADS <text>for Android & iOS last week</text></span>
                  <i class="material-icons">&#xE325;</i>
              </div>
              <div class="cards thirdcard">
                  <i class="material-icons">&#xE7FF;</i>
                  <span><b>{{$countUsers}} </b>NEW USERS<text>  <br/>have registerd their personal information</text></span>
              </div>
              <div class="cards fourthcard">
                  <span><b>+42% </b><text>properly views</text></span>
                  <i class="material-icons">&#xE8E5;</i>
              </div>
          </div>
          <div class="fchart">
              <div class="firstc">
                  <div class="charthead">
                          <span>STATS</span>
                  </div>
                  <div class="chartdiv">
                          <div id="chartContainer" style="height: 200px; width: 90%;"></div>
                  </div>
              </div>
              <div class="chartitem1">
                  <div class="citem1head">
                      <span>LISTING AWAITING APPROVAL</span>
                  </div>
                  <div class="citem1body">
                    @foreach($offersWaiting as $offer)
                      <div class="singleitem">
                          <img src="{{url('/storage/'.$offer->photos[0]->photo)}}" />
                            <span> "{{$offer->address}}" </span>
                      </div>
                    @endforeach

                  </div>
              </div>
              <div class="chartitem1">
                  <div class="citem1head">
                      <span>USERS</span>
                  </div>
                  <div class="citem1body">
                      <div class="singleitem1">
                          <b>{{$userAll}}</b>
                          <span>REGISTERD USERS</span>
                          <text>25min ago</text>
                      </div>
                      <div class="singleitem1">
                          <b>{{$countUsers}}</b>
                          <span>NEW <br>USERS</span>
                          <text>25min ago</text>
                      </div>
                      <div class="singleitem1">
                          <b>{{$countApp}}</b>
                          <span>APPLICATION FORMS</span>
                          <text>25min ago</text>
                      </div>
                      <div class="singleitem1">
                          <b>856</b>
                          <span>HOME APPLICATION</span>
                          <text>25min ago</text>
                      </div>
                  </div>
              </div>
          </div>

          <div class="fchart">
              <div class="chartitem1">
                  <div class="citem1head">
                      <span>LATEST APPROVED LISTINGS</span>
                  </div>
                  <div class="citem1body">
                      <div class="singleitem">
                        @foreach($offersAppRec as $offers)
                          <div class="singleitem">
                              <img src="{{url('/storage/'.$offers->photos[0]->photo)}}" />
                                <span> "{{ $offers->address }}" </span>
                          </div>
                        @endforeach
                      </div>

                  </div>
              </div>
              <div class="chartitem1">
                  <div class="citem1head">
                      <span>USERS</span>
                  </div>
                  <div class="citem1body">
                      <div class="totaldown">
                          <text><b>238</b>DOWNLOADS</text>
                      </div>
                      <div class="singleitem si">
                          <div class="daydown">
                              <span class="day">Monday</span>
                              <text class="progress">76/238</text>
                          </div>
                          <div id="myProgress">
                              <div id="myBar"></div>
                          </div>
                      </div>
                      <div class="singleitem si">
                          <div class="daydown">
                                  <span class="day">Monday</span>
                                  <text class="progress">76/238</text>
                          </div>
                          <div id="myProgress1">
                              <div id="myBar1"></div>
                          </div>
                      </div>
                      <div class="singleitem si">
                          <div class="daydown">
                                  <span class="day">Monday</span>
                                  <text class="progress">76/238</text>
                          </div>
                          <div id="myProgress2">
                              <div id="myBar2"></div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="firstc">
                  <div class="charthead">
                          <span>PROPERTY TYPES</span>
                  </div>
                  <div class="chartdiv">
                      <div id="chartContainer1" style="height: 200px; width: 90%;"></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script>
      var offers = JSON.parse("{{ json_encode($countOffer) }}");
      var home = JSON.parse("{{ json_encode($countHome) }}");
      var apartments = JSON.parse("{{ json_encode($countAppartments) }}");
      var houseLand = JSON.parse("{{ json_encode($counthouseLand) }}");
      var newLand = JSON.parse("{{ json_encode($countNewLand) }}");
      var rural = JSON.parse("{{ json_encode($countRural) }}");
      var countAll = home + apartments + houseLand + newLand + rural;

  </script>

@endsection
