@extends('admin.micasa.panel')

@section('content')
  <script>
    $(document).ready(function(){           
        $('.deletebtn').click(function(){
            $.post('/admin/listings/delete/', function(response){
                if(response.response == 'Success'){
                    console.log(response.message);
                    $('#exampleModal').hide();
                }else if (response.response == 'Error'){
                    console.log(response.message);
                }
            });
        });
    });
</script>
<div class="maincontent">
    <div class="adminroute">
        <i class="material-icons">&#xE88A;</i>
        <span> <b> / </b> Shtepia Ime Admin Panel <b> / </b> </span>
        <span class="partup"> Listing </span>
    </div>
    <div class="adminpage">
        <span class="partdown">LISTING</span>
        <text class="partdesc">All listing for Shtepia ime</text>
    </div>
    <div class="loadhere">
      <table class="listing-table">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Data</th>
                  <th>Agency</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Control</th>
              </tr>
          </thead>
          <tbody>
          <input type="hidden" value = '{{$i = 1}}'>
              @foreach ($user as $agency)
                @foreach($agency->offer as $offer)

                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $offer->created_at }}</td>
                    <td>{{ $agency->agency->name}}</td>
                    <td>{{ $offer->address }}</td>

                    <td>  @if($offer->active == 0)
                            Not approved
                          @endif
                          @if($offer->active == 1)
                            Approved
                          @endif
                          @if($offer->active == 2)
                            Waiting
                          @endif
                    </td>
                    <td>
                        <a href="{{url('admin/listings/view/'.$offer->id_offer)}} " class="prbutton">View</a>
                        <a href="{{url('admin/listings/edit/'.$offer->id_offer)}}" class="prbutton">Edit</a>
                        <a data-toggle="modal" data-target="#exampleModal"  class="dlbutton">Delete</a>
                    </td>
                    <input type="hidden" value = '{{ $i++ }}'>
                </tr>
              
                  @endforeach
              @endforeach
          </tbody>
      </table>
    </div>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure u want to delete this?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="text-align: center;" class="modal-body">
         <button type="button" class="btn btn-primary deletebtn" id="deletbtn">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>        
      </div>

    </div>
  </div>
</div>
@endsection
