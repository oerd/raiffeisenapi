@extends('admin.micasa.panel')

@section('content')
<script>
    $(document).ready(function(){
        $('.prbutton').click(function(){
            $(this).hide();
            $('.interes').show();
            $('td span').hide();
            $('.sendbutton').show()
        })
    })
</script>
<div class="maincontent">
    <div class="adminroute">
        <i class="material-icons">&#xE88A;</i>
        <span> <b> / </b> Shtepia Ime Admin Panel <b> / </b> </span>
        <span class="partup"> Configuration </span>
    </div>
    <div class="adminpage">
        <span class="partdown">Configuration</span>
        <text class="partdesc">Welcome back Raiffeisen Bank</text>
    </div>
         <table style="margin: 0 auto" class="listing-table">
          <thead>
              <tr>
                  <th>First Year</th>
                  <th>Next Year</th>
                  <th>Status</th>
                  <th>Control</th>
              </tr>
          </thead>
          <tbody>
            <tr>
                <td><input class="interes" style='display:none' ><span>{{ $interes }}</span></td>
                <td><input class="interes" style='display:none' ><span>{{ $interes }}</span></td>
                <td>Active</td>
                <td style="width: 23% !important">
                    <a style="width: 30%;display:none" href="#" class="sendbutton">OK</a>
                    <a style="width: 30%;" href="#" class="prbutton">Edit</a>
                    <a style="width: 30%;" href="#" class="dlbutton">Delete</a>
                </td>
            </tr>

          </tbody>
      </table>
  </div>


@endsection
