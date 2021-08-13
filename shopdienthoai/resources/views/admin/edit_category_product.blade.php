@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục sản phẩm
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
                    @foreach($edit_category_product as $key => $edit_value)
                    <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{$edit_value->category_name}}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize:none" value="" row="5" name="category_product_desc" type="text" class="form-control" id="exampleInputPassword1">{{$edit_value->category_desc}}</textarea>
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info" style="display:flex;margin:auto">Cập nhật danh mục</button>
                    </form> 
                    @endforeach
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()