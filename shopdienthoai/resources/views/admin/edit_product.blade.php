@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa sản phẩm
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
                    @foreach($edit_product as $key => $product)
                        <form role="form" action="{{URL::to('/update-product/'.$product->product_id)}}" method="post"  enctype="multipart/form-data"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" value="{{$product->product_name}}" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" value="{{$product->product_price}}" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file"  name="product_image" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                            <img src="{{URL::to('public/uploads/product/'.$product->product_images)}}" style="width:100px;height:100px">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize:none"  row="5" name="product_desc" type="text" class="form-control" id="ckeditor1" placeholder="Mô tả danh mục">{{ $product->product_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung danh mục</label>
                            <textarea style="resize:none" row="5" name="product_content" type="text" class="form-control" id="ckeditor2" placeholder="Mô tả danh mục">{{$product->product_content}}</textarea>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                            @foreach($brand_product as $key => $value_brand)
                            @if($value_brand->brand_id==$product->brand_id)
                                <option selected value="{{$value_brand->brand_id}}">{{$value_brand->brand_name}}</option>
                            @else
                                <option value="{{$value_brand->brand_id}}">{{$value_brand->brand_name}}</option>
                            @endif
                            @endforeach
                        
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="exampleInputPassword1">Giảm giá sản phẩm</label>
                            <select name="product_promotion" class="form-control input-sm m-bot15">
                            @foreach($promotion_product as $key => $value_promotion)
                            @if($value_promotion->promotion_id==$product->promotion_id)
                                <option selected value="{{$value_promotion->promotion_id}}">{{$value_promotion->promotion_type}}</option>
                            @else
                                <option value="{{$value_promotion->promotion_id}}">{{$value_promotion->promotion_type}}</option>
                            @endif
                            @endforeach
                        
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="exampleInputPassword1">Thông số sản phẩm</label>
                            <select name="product_specification" class="form-control input-sm m-bot15">
                            @foreach($specification_product as $key => $value_spec)
                            @if($value_spec->IDTSSP==$product->IDTSSP)
                                <option selected value="{{$value_spec->IDTSSP}}">{{$value_spec->IDTSSP}}</option>
                            @else
                                <option value="{{$value_spec->IDTSSP}}">{{$value_spec->IDTSSP}}</option>
                            @endif
                            @endforeach
                        
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Hiện thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                @if($product->product_status==0) 
                                    <option selected value="0">Hiện thị</option>
                                    <option value="1" >Ẩn</option>
                                @else     
                                    <option  value="0">Hiện thị</option>
                                    <option selected value="1" >Ẩn</option>
                                @endif    
                            </select>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info" style="display:flex;margin:auto">Cập nhật sản phẩm</button>
                    </form>
                    @endforeach
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()