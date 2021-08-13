@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê bình luận
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
        <div id="notify_comment"></div>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
    
            <th>Tên người gửi</th>
            <th>Bình luận</th>
            <th>Ngày gửi</th>
            <th>Sản phẩm</th>
            <th>Quản lý</th>
        
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($comment as $key => $comm)
          <tr>
            
            <td>{{$comm->comment_name}}</td>
            <td>{{$comm->comment}}
            <style>
              ul.list_rep li {
                list-style-type: decimal;
                color:red;
                margin:5px 40px;
              }
            </style>
               <ul class="list_rep">
               @foreach($comment_rep as $key =>$comm_reply)
                @if($comm_reply->comment_parent_comment==$comm->comment_id)
                  <li>{{$comm_reply->comment_name}} <span>{{$comm_reply->comment}}</span> </li>
        
                @endif
               @endforeach
               </ul>
                  <br> <textarea class="form-control reply_comment_{{$comm->comment_id}}" rows="4"></textarea>
                  <br> <button type="button" class="btn btn-default btn-reply-comment btn-xs" data-comment_id="{{$comm->comment_id}}" data-product_id="{{$comm->comment_product_id}}">Trả lời bình luận</button>
                
            </td>
               
            <td>{{$comm->comment_date}}</td>
            <td>{{$comm->product->product_name}}</td>
            <td>
              <!-- <a href="" class="active style-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>

              </a> -->
            
              <a onclick="return confirm('Bạn có chắc muốn xóa bình luận này không')" href="{{URL::to('/delete-comment/'.$comm->comment_id)}}" class="active style-edit" ui-toggle-class="">
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
       {!!$comment->links() !!}
      </div>
    </footer>
  </div>
@endsection()