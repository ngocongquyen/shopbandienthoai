@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật bài viết 
                </header>
                <?php
                    $message = Session::get('message');
                    if($message) {
                        echo '<span class="text">'.$message.'</span>';
                        Session::put('message',null);
                    }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                    @foreach($edit_post as $key => $edit_p)
                        <form role="form" action="{{URL::to('/update-post/'.$edit_p->post_id)}}" method="post" enctype="multipart/form-data"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" value="{{$edit_p->post_title}}" name="post_name" class="form-control"  onkeyup="ChangeToSlug()" id="slug" placeholder="Tên danh mục" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" value="{{$edit_p->post_slug}}" name="post_slug" class="form-control" id="convert_slug" onkeyup="ChangeToSlug()" id="slug" placeholder="Tên danh mục" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                            <textarea style="resize:none"  row="5" name="post_desc" type="text" class="form-control" id="ckeditor1" placeholder="Mô tả danh mục">
                            {{$edit_p->post_desc}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung bài viết</label>
                            <textarea style="resize:none" row="5"  name="post_content" type="text" class="form-control" id="ckeditor2" placeholder="Mô tả danh mục">
                            {{$edit_p->post_content}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                            <input type="file" name="post_image" v class="form-control"   placeholder="Hình ảnh bài viết" >
                            <img src="{{asset('public/uploads/post/'.$edit_p->post_image)}}" style="width:100px;height:100px">
                        </div>

                        <div class="form-group">
                        <label for="exampleInputPassword1">Danh mục bài viết</label>
                            <select name="cate_post_id" class="form-control input-sm m-bot15">
                                @foreach($cate_post as $key => $cate)
                                    <option {{$edit_p->cate_post_id==$cate->cate_post_id ? 'selected' : ""}} value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                @endforeach
    
                        
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Hiện thị</label>
                            <select name="post_status" class="form-control input-sm m-bot15">
                            @if($edit_p->post_status==0)
                                <option selected value="0">Hiện thị</option>
                                <option value="1">Ẩn</option>
                            @else 
                                <option  value="0">Hiện thị</option>
                                <option selected value="1">Ẩn</option>
                            @endif    
                            </select>
                        </div>

                        <button type="submit" name="update_post" class="btn btn-info" style="display:flex;margin:auto">Cập nhật bài viết</button>
                    </form>
                    @endforeach
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()