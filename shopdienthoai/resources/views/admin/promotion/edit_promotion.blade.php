@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa khuyến mãi
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
                        <form role="form" action="{{URL::to('/update-promotion/'.$promotion->promotion_id)}}" method="post"> 
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phần trăm khuyến mãi</label>
                            <input type="text" value="{{$promotion->promotion_type}}" name="promotion_type" class="form-control"  placeholder="Tên danh mục" autocomplete="off">
                        </div>
                        <button type="submit" name="add_post_cate" class="btn btn-info" style="display:flex;margin:auto">Sửa khuyến mãi</button>
                    </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection()