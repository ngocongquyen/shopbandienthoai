@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm user
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('store-users')}}" id="store-user" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên users</label>
                                    <input type="text" name="admin_name" class="form-control" id="admin_name" placeholder="Tên danh mục">
                                    <span class="auth-form__message"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" name="admin_email" class="form-control" id="admin_email" placeholder="Slug">
                                    <span class="auth-form__message"></span>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="text" name="admin_phone" class="form-control" id="admin_phone" placeholder="Slug">
                                    <span class="auth-form__message"></span>
                                </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="text" name="admin_password" class="form-control" id="admin_password" placeholder="Slug">
                                    <span class="auth-form__message"></span>
                                </div>
                             
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm users</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection