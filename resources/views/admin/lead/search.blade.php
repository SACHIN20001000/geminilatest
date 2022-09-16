<?php
  $periods = [
    ''    => 'All',
    'D'   => 'This day','W'        => 'This week',
    'M'   => 'This month','Y'      => 'This year',
    'LD'  => 'Yesterday','LW'      => 'Previous week',
    'LY'  => 'Previous year','L7D' => 'Last 7 days',
    'L3D' => 'Last 30 days','L2M'  => 'Last 2 Months',
    'L4M' => 'Last 4 Months','C'   => 'Custom',
  ];

  $orderStatus = [
    1  =>  'New',       2  => 'Process',
    3  => 'Manifested', 4  => 'Cancel',
    5  => 'Hold',       6  => 'Shipped',
    7  => 'RTO',        8  => 'Completed',
  ];

  $paymentStatus = [
    'cod'     =>  'COD',
    'prepaid' =>  'PrePaid'
  ];

  $searchVal         = request()->searchVal ?? '';
  $orderState        = request()->order_status ?? '';
  $paymentType       = request()->payment_type ?? '';
  $courierType       = request()->courier_type ?? '';
  $orderStatusSelect = $orderStatusSelect ?? false;
  $paymentSelect     = $paymentSelect ?? false;
  $courierSelect     = $courierSelect ?? false;
  $perPage           = $perPage ?? 100;

?>
<div class="searchorder">
  <form action="" method="get" id="search_form">
    <div class="input-icon">
        <input type="text" name="searchVal" value="{{ $searchVal }}"  class="form-control" placeholder="Search..." id="kt_datatable_search_query">
        <input type="hidden" name="storeId"  value="{{ $storeId ?? ''}}">
        <span><i class="flaticon2-search-1 text-muted"></i></span>
    </div>
    <div class="orderHistory" id="report_range" style="background: #fff; cursor: pointer; padding: 5px;border: 1px solid #ccc;width: 30%;height: 31px;font-size: 14px;border-radius: 4px;">
      <i class="fa fa-calendar"></i>&nbsp;
      <span></span> <i class="fa fa-caret-down"></i>
    </div>
    <input type="hidden" id="from_date" name="time_from" value="">
    <input type="hidden" id="to_date" name="time_to" value="">
    @if($orderStatusSelect)
      <div class="orderStatus">
        <select name="order_status" id="order_status" class="form-control">
          <option value="">Status</option>
          @foreach($orderStatus as $key => $value)
            <option @if($orderState == $key ) selected  @endif value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>
    @endif
    @if($paymentSelect)
      <div class="PaymentStatus">
        <select name="payment_type" id="payment_type" class="form-control">
          <option value="">Payment</option>
          @foreach($paymentStatus as $key => $value)
            <option @if($paymentType == $key ) selected  @endif value="{{$key}}" >{{$value}}</option>
          @endforeach
        </select>
      </div>
    @endif
    @if($courierSelect)
      <div class="PaymentStatus">
        <select name="courier_type" id="courier_type" class="form-control">
          <option value="">Courier</option>
          @foreach($carriers as $key => $courier)
            <option @if($courierType == $courier->carrier ) selected  @endif value="{{$courier->carrier}}" >{{$courier->carrier}}</option>
          @endforeach
        </select>
      </div>
    @endif
    <div class="">
     <div class="dataTables_length">
       <select id="num_rows" style="width: 60px;"  name="perPage" class="custom-select custom-select-sm form-control form-control-sm">
         <?php
         $numrows_arr = array("5","10","20","40","50","100","150");
         foreach($numrows_arr as $nrow){
           if($perPage == $nrow){
             echo '<option value="'.$nrow.'" selected="selected">'.$nrow.'</option>';
           } else {
             echo '<option value="'.$nrow.'">'.$nrow.'</option>';
           }
         }
         ?>
       </select>
     </div>
   </div>
    <div class="PaymentStatus">
      <!-- <button type="submit" id="custom_search_track" data-toggle="tooltip" data-placement="top" title="Search"  class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button> -->
    </div>
  </form>
  <script>
  document.addEventListener("DOMContentLoaded", function(event) {

  });
  </script>
