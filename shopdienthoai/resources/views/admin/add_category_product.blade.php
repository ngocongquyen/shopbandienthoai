@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản phẩm
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
                        <form role="form" action="{{URL::to('/save-category-product')}}" method="post"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize:none" row="5" name="category_product_desc" type="text" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Hiện thị</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiện thị</option>
                                <option value="1">Ẩn</option>
                        
                            </select>
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info" style="display:flex;margin:auto">Thêm danh mục</button>
                    </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()