@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê thông số kĩ thuật
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
            <th>Hệ điều hành</th>
            <th>Camera sau</th>
            <th>Camera trước</th>
            <th>CPU</th>
            <th>Ram</th>
            <th>Bộ nhớ trong</th>
            <th>Thẻ nhớ</th>
            <th>Thẻ sim</th>
            <th>Dung lượng pin</th>
            <th>Màn hình</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($specification as $key => $specifi)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$specifi->Hedieuhanh}}</td>
            <td>{{$specifi->Camerasau}}</td>
            <td>{{$specifi->Cameratruoc}}</td>
            <td>{{$specifi->CPU}}</td>
            <td>{{$specifi->Ram}}</td>
            <td>{{$specifi->Bonhotrong}}</td>
            <td>{{$specifi->Thenho}}</td>
            <td>{{$specifi->Thesim}}</td>
            <td>{{$specifi->Dungluongpin}}</td>
            <td>{{$specifi->Manhinh}}</td>
            <td>
              <a href="{{URL::to('/edit-specification/'.$specifi->IDTSSP)}}" class="active style-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i>

              </a>
              <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không')" href="{{URL::to('/delete-specification/'.$specifi->IDTSSP)}}" class="active style-edit" ui-toggle-class="">
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
        <div class="col-sm-7 text-right text-center-xs">   
        {{ $specification->links() }}          
        </div>
      </div>
    </footer>
  </div>
@endsection()