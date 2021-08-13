@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm bài viết
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
                        <form role="form" action="{{URL::to('/save-post')}}" id="save-post" method="post" enctype="multipart/form-data"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" name="post_name" class="form-control post_name"  onkeyup="ChangeToSlug()" id="slug" placeholder="Tên danh mục" >
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="post_slug" class="form-control" id="convert_slug" onkeyup="ChangeToSlug()" id="slug" placeholder="Tên danh mục" >
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                            <textarea style="resize:none" row="5" name="post_desc" type="text" class="form-control post_desc" id="ckeditor1" placeholder="Mô tả danh mục"></textarea>
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung bài viết</label>
                            <textarea style="resize:none" row="5" name="post_content" type="text" class="form-control post_content" id="ckeditor2" placeholder="Mô tả danh mục"></textarea>
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                            <input type="file" name="post_image" class="form-control" id="post_image" placeholder="Tên danh mục" >
                            <span class="auth-form__message"></span>
                        </div>

                        <div class="form-group">
                        <label for="exampleInputPassword1">Danh mục bài viết</label>
                            <select name="cate_post_id" class="form-control input-sm m-bot15">
                                @foreach($cate_post as $key => $post)
                                    <option value="{{$post->cate_post_id}}">{{$post->cate_post_name}}</option>
                                @endforeach
    
                        
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Hiện thị</label>
                            <select name="post_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiện thị</option>
                                <option value="1">Ẩn</option>
                        
                            </select>
                        </div>

                        <button type="submit" name="add_post_cate" class="btn btn-info" style="display:flex;margin:auto">Thêm bài viết</button>
                    </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()