@extends('welcome')
@section('content')
<div class="grid wide">
    <div class="row app__content">
        <div class="col l-3">
            <div class="user-page">
                <img src="{{asset('public/fontend/images/10-logo-dep-nhat-nam-2018-4.jpg')}}" alt="" class="user-page__img">
                <div class="user-page__right">
                    <span class="user-page__username"><?php $customer_name = Session::get('customer_name');
                                            if($customer_name) {
                                                echo $customer_name;
                                            }
                                ?></span>
                    <a href="{{URL::to('my-account')}}" class="user-page__edit" style="text-decoration:none">
                        <i class="fas fa-edit"></i>
                        Sửa hồ sơ
                    </a>
                </div>
            </div>
           
            <ul class="user-page__list">
                <li class="user-page__item">
                    <a href="{{URL::to('my-account')}}" class="user-page__link">
                        <i class="fas fa-user-circle" style="margin-right:4px;"></i>
                        <span class="user-page__item-title">Tài khoản của tôi</span>
                    </a>
                </li>
                <li class="user-page__item">
                    <a href="#" class="user-page__link">
                        <i class="fas fa-file-invoice" style="margin-right:4px;"></i>
                        <span class="user-page__item-title">Lịch sử đơn hàng</span>
                       
                    </a>
                </li>
            </ul>
        </div>
        <div class="col l-9 c-12">
    
            <div class="panel panel-default">
                <div class="panel-heading history-heading" style="text-align:center;font-size:20px;margin-bottom:15px;color:var(--primary-color)">
                    Liệt kê đơn hàng
                </div>

                <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if($message) {
                    echo '<span class="text">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <table class="history-list">
                    <thead>
                    <tr class="history-wrapper">
                        <th class="history-item">Thứ tự</th>
                        <th class="history-item">Mã đơn hàng</th>
                        <th class="history-item">Ngày tháng</th>
                        <th class="history-item">Tình trạng đơn hàng</th>
                        <th class="history-item">Chi tiết đơn hàng</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php 
                        $i=0;
                        @endphp
                    @foreach($get_order as $key => $ord)
                            @php
                                $i++
                            @endphp
                        <tr class="history-wrapper">
                            <td class="history-item"><i>{{$i}}</i></td>
                            <td class="history-item">{{$ord->order_id}}</td>
                            <td class="history-item">{{$ord->created_at}}</td>
                            <td class="history-item">
                                @if($ord->order_status==1) 
                                    <span style="color:green">Đơn hàng mới</span>
                                @elseif($ord->order_status==2)
                                    <span style="color:red">Đã xử lý - Đã giao hàng</span>
                                @else 
                                <span style="color:#333"> Đơn hàng đã bị hủy</span>
                                @endif      
                            </td>
                        
                            <td class="history-item" id="history-item__inline">
                                <!-- Trigger the modal with a button -->
                                @if($ord->order_status!=3 && $ord->order_status!=2)
                                    <div>
                                        <button type="button" class="delete_order btn btn-primary ">Hủy đơn hàng</button>
                                        <form>
                                            @csrf
                                            <div class="confirm-deletion-container" style="display: none;">
                                                <div class="confirm-deletion-overlay"></div>
                                                <div class="confirm-deletion">
                                                    <div class="confirm-deletion__message">
                                                        Lý do hủy đơn
                                                    </div>
                                                    <div class="confirm-body">
                                                        <p><textarea rows="7" class="lydohuydon" cols="80" required placeholder="Lý do hủy đơn hàng...(bắt buộc)"></textarea></p>
                                                    </div>
                                                    <div class="confirm-deletion__btn-wrapper" style="margin-top:20px">
                                                        <a class="btn btn-primary" href="{{url('/history')}}">Trở lại</a>
                                                        <button class="confirm-deletion__btn confirm-deletion__btn--agree clear-btn" style="width:120px;" onclick="Huydonhang(this.id)" id="{{$ord->order_id}}">Gửi lý do hủy</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>    
                                    </div>
                                @endif
                                <!-- Modal -->
                                <!-- <div class="modal fade" id="huydon" role="dialog">
                                    <div class="modal-dialog">
                                  
                                        <form>
                                            @csrf
                                            Modal content
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Lý do hủy đơn</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p><textarea rows="5" class="lydohuydon" cols="75" required placeholder="Lý do hủy đơn hàng...(bắt buộc)"></textarea></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>           
                                                   
                                                </div>
                                            </div>
                                        </form>
                                    
                                    </div>
                                       
                                </div> -->
                                <a  href="{{URL::to('/view-history-order/'.$ord->order_id)}}" class="btn btn-primary " id="history-item__link">
                                    Xem đơn hàng
                                </a>
                            <!-- <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active style-edit" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>

                            </a> -->
                            
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>

            </div>

        </div>
        {!! $get_order->links() !!}
    </div>
</div>
    <script>
        const delBtnMain = document.querySelectorAll('.delete_order');
       
        const confirmCtn = document.querySelectorAll('.confirm-deletion-container'); // get element of deletion confirm container 
       
        const cfmOverlay = document.querySelectorAll('.confirm-deletion-overlay'); // get element of deletion confirm overlay 
        
        delBtnMain.forEach((tab,index) => {
            const a = confirmCtn[index];
            const b = cfmOverlay[index];
            tab.onclick = function() {
                a.style.display="flex";
                b.onclick = function() {
                    a.style.display="none";
            }
        }
            //     a.onclick = () => {
            //     a.style.display = 'none';
            // }
        //     b.onclick = () => {
        //         b.style.display = 'none';
        //     }
            
        })
        // }
    </script>
    <script>
        function Huydonhang(id) {
            var id=id;
            var lydo=$('.lydohuydon').val();
            var _token = $('input[name="_token"]').val();
            
            $.ajax({
                    url:'{{url('/huy-don-hang')}}',
                    method:"POST",
                    data:{id:id,lydo:lydo,_token:_token},
            }).done(function(result) {
                   if(result=='done') {
                       alert('Đạn đã hủy đơn hàng thành công');
                       location.reload();
                   }
               });
        }
    </script>

   
    <!-- <link rel="stylesheet" href="{{asset('public/fontend/css/bootstrap.min.css')}}"> -->
    <script src="{{asset('public/fontend/js/jquery.min.js')}}"></script>
    <!-- <script src="{{asset('public/fontend/js/bootstrap.min.js')}}"></script> -->
@endsection()