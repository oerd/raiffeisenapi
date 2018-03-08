@extends('admin.micasa.panel')

@section('content')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,
                focus: true,
                callbacks: {
                    onKeydown: function (e) {
                        var t = e.currentTarget.innerText;
                        if (t.trim().length >= 255) {
//delete key
                            if (e.keyCode != 8)
                                e.preventDefault();
                        }
                    },
                    onKeyup: function (e) {
                        var t = e.currentTarget.innerText;
                        $('#maxContentPost').text(255 - t.trim().length);
                    },
                    onPaste: function (e) {
                        var t = e.currentTarget.innerText;
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        var all = t + bufferText;
                        document.execCommand('insertText', false, all.trim().substring(0, 255));
                        $('#maxContentPost').text(255 - t.length);
                    }
                }
            });
        });

    </script>
    <style>
        b {
            font-weight: 700 !important;
        }
        .gallery-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            margin: 10px 0 0 0;
        }
        .editimg {
            display: none;
        }
        #btn-example-file-reset {
            display: none;
            position: absolute;
            right: -5px;
            top: 44px;
            font-size: 19px;
            cursor: pointer;
        }
    </style>
    <div style="background:#f3f3f3" class="maincontent">
        <div style="width: 100%;" id="content" class="mob-max" >
            <div class="rightContainer">
                <h1>Add new post</h1>
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input id="title" type="text" name= "title" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group">
                                    <label class="btn btn-lg" for="cover">
                                        <input style="display: none" id="cover" type="file" name= "cover" class="form-control">
                                        <span>Upload a cover for blog!</span>
                                    </label>
                                    <div class="cover-content">
                                        <span id="btn-example-file-reset">X</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <select id="hipotek" name="id_category">
                                        <option value="">Select category</option>
                                        @foreach($category as $cat)
                                             <option value="{{$cat->category_id}}">{{$cat->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <div id="summernote"></div>
                                </div>
                                <div class="editimg"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button id="addblog" class="btn btn-green btn-lg isThemeBtn">Add Post</button>
                    </div>
            </div>
        </div>
    </div>
    </div>
    <div class="clearfix"></div>
    </div>



@endsection
