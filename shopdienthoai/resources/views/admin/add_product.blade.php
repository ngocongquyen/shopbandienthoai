@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
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
                        <form role="form" action="{{URL::to('/save-product')}}" id="save-product" method="post"  enctype="multipart/form-data"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Tên sản phẩm">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control" id="product_price" placeholder="Giá sản phẩm">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="text" name="product_quantity" class="form-control" id="product_quantity" placeholder="Số lượng">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="product_image" placeholder="Hình ảnh sản phẩm">
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize:none" row="5" name="product_desc" type="text" class="form-control product_desc" id="ckeditor1" placeholder="Mô tả danh mục"></textarea>
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize:none" row="5" name="product_content" type="text" class="form-control product_content" id="ckeditor2" placeholder="Mô tả danh mục"></textarea>
                            <span class="auth-form__message"></span>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                            @foreach($brand_product as $key => $value_brand)
                                <option value="{{$value_brand->brand_id}}">{{$value_brand->brand_name}}</option>
                            @endforeach
                        
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Thông số sản phẩm</label>
                            <select name="product_specification" class="form-control input-sm m-bot15">
                            @foreach($specification_product as $key => $value_spec)
                                <option value="{{$value_spec->IDTSSP}}">{{$value_spec->Hedieuhanh}}</option>
                            @endforeach
                        
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Giảm giá sản phẩm</label>
                            <select name="product_promotion" class="form-control input-sm m-bot15">
                            @foreach($promotion_product as $key => $value_promotion)
                                <option value="{{$value_promotion->promotion_id}}">{{$value_promotion->promotion_type}}</option>
                            @endforeach
                        
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Hiện thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiện thị</option>
                                <option value="1">Ẩn</option>
                        
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info" style="display:flex;margin:auto">Thêm sản phẩm</button>
                    </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()