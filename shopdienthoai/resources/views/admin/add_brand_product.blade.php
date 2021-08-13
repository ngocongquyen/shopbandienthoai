@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thương hiệu sản phẩm
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
                        <form role="form" action="{{URL::to('/save-brand-product')}}" method="post" id="save-brand" enctype="multipart/form-data"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" name="brand_product_name" class="form-control" id="brand_name" placeholder="Tên danh mục">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea style="resize:none" row="5" name="brand_product_desc" type="text" class="form-control" id="brand_desc" placeholder="Mô tả danh mục"></textarea>
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Hiện thị</label>
                            <select name="brand_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiện thị</option>
                                <option value="1">Ẩn</option>
                        
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ảnh</label>
                            </br>
                            <input type="file" name="brand_slide" class="form-control" id="brand_image">
                            <span class="auth-form__message"></span>
                        </div>
                        <button type="submit" name="add_brand_product" class="btn btn-info" style="display:flex;margin:auto">Thêm thương hiệu</button>
                        
                    </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()