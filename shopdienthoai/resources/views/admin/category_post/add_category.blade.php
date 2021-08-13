@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục bài viết
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
                        <form role="form" action="{{URL::to('/save-category-post')}}" id="save-category" method="post"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="cate_post_name" class="form-control cate_post_name"  onkeyup="ChangeToSlug()" id="slug" placeholder="Tên danh mục" >
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="cate_post_slug" class="form-control" id="convert_slug" onkeyup="ChangeToSlug()" id="slug" placeholder="Tên danh mục" >
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize:none" row="5" name="cate_post_desc" type="text" class="form-control" id="cate_post_desc" placeholder="Mô tả danh mục"></textarea>
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Hiện thị</label>
                            <select name="cate_post_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiện thị</option>
                                <option value="1">Ẩn</option>
                        
                            </select>
                        </div>

                        <button type="submit" name="add_post_cate" class="btn btn-info" style="display:flex;margin:auto">Thêm danh mục bài viết</button>
                    </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()