@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê bài viết
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
    <?php
      $message = Session::get('message');
      if($message) {
          echo '<span class="text">'.$message.'</span>';
          Session::put('message',null);
      }
    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên bài viết</th>
            <th>Hình ảnh</th>
            <th>Slug</th>
            <th>Mô tả bài viết</th>
          
            <th>Danh mục bài viết</th>
            <th>Hiện thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_post as $key => $post)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            
            <td>{{$post->post_title}}</td>
            <td><img src="public/uploads/post/{{$post->post_image}}" style="width:100px;height:100px"></td>
            <td>{{$post->post_slug}}</td>
            <td>{!!$post->post_desc!!}</td>
           
            <td>{{$post->cate_post->cate_post_name}}</td>
            <td><span class="text-ellipsis">
             
                @if($post->post_status==0)
                    Hiện thị
                @else 
                    Ẩn
                @endif
            </span></td>
            <td>
              <a href="{{URL::to('/edit-post/'.$post->post_id)}}" class="active style-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>

              </a>
              <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không')" href="{{URL::to('/delete-post/'.$post->post_id)}}" class="active style-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>

              </a>
              
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        {!!$all_post->links()!!}
      </div>
    </footer>
  </div>
@endsection()