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