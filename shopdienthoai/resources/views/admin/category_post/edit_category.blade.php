@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục bài viết
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    <?php
                    $message = Session::get('message');
                    if($message) {
                        echo "<span class='text'>$message</span>";
                        Session::put('message',null);
                    }
                ?>
                    @foreach($edit_cate_post as $key => $edit_cate)
                    <form role="form" action="{{URL::to('/update-category-post/'.$edit_cate->cate_post_id)}}" method="post"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{$edit_cate->cate_post_name}}" name="cate_post_name" class="form-control" onkeyup="ChangeToSlug()" id="slug" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" value="{{$edit_cate->cate_post_slug}}" name="cate_post_slug" class="form-control" id="convert_slug" onkeyup="ChangeToSlug()" id="slug" placeholder="Tên danh mục" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize:none" value="" row="5" name="cate_post_desc" type="text" class="form-control" id="exampleInputPassword1">{{$edit_cate->cate_post_desc}}</textarea>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Hiện thị</label>
                            <select name="cate_post_status" class="form-control input-sm m-bot15">
                            @if($edit_cate->cate_post_status==0)
                                <option selected value="0">Hiện thị</option>
                                <option value="1">Ẩn</option>
                            @else 
                                <option  value="0">Hiện thị</option>
                                <option selected value="1">Ẩn</option>
                            @endif    
                            </select>
                        </div>
                        <button type="submit" name="update_category_post" class="btn btn-info" style="display:flex;margin:auto">Cập nhật danh mục</button>
                    </form> 
                    @endforeach
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()