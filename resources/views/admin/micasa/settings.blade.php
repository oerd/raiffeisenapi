@extends('admin.micasa.panel')

@section('content')
<div id="content" class="mob-max" style="margin-top:10%; margin-right:10%;">
    <div class="rightContainer" >                      
        <form action="{{url('/admin/change/password')}}"  method="post">   
            {{csrf_field()}}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name= "password" class="form-control">
                        </div>
                    </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name= "confirm_password" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id = "change">Change Password</button>
        </form>         
    </div>
</div>
@endsection