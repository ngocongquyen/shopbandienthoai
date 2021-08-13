@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật thương hiệu sản phẩm
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
                    @foreach($edit_brand_product as $key => $edit_value)
                    <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" id="update-brand" method="post" enctype="multipart/form-data"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" value="{{$edit_value->brand_name}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize:none" value="" row="5" name="brand_product_desc" type="text" class="form-control" id="exampleInputPassword1">{{$edit_value->brand_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Ảnh</label>
                            <input type="file" name="brand_slide" value="{{$edit_value->brand_images}}" class="form-control" id="brand_image">
                        </div><img src="{{URL::to('public/uploads/brand/'.$edit_value->brand_images)}}"">
                        <button type="submit" name="add_brand_product" class="btn btn-info" style="display:flex;margin:auto">Cập nhật thương hiệu</button>
                    </form> 
                    @endforeach
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()