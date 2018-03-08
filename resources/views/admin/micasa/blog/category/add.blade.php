@extends('admin.micasa.panel')

@section('content')
    <div style="background:#f3f3f3" class="maincontent">
        <div style="width: 100%;" id="content" class="mob-max" >
            <div class="rightContainer">
                <form action="{{ url('/admin/blog/category/add') }}" method="POST">
                     {{ csrf_field() }}
                    <h1>Add new category</h1>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input id="title" type="text" name="title" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button id="addcategory" class="btn btn-green btn-lg isThemeBtn">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection