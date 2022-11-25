
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
</head>
<body>
<h2>Dear Sir/Madam,</h2>
<p>
This is for your information following insurance policies are expiring in coming days</p>
<p>Please find details below: </p>
<table>
    <thead>
        <th>Sr No.</th>
        <th>Policy Expiry Date</th>
        <th>Policy  Holder Name</th>
        <th>Sub Product</th>
        <th>Make/Model</th>
        <th>Reg No.</th>
        <th>Last Year Premium</th>
        <th>Last Year Ncb</th>
        <th>Claim Status</th>
    </thead>
    <tbody>
    @if($user->policies->count())
    @foreach($user->policies as $key => $policies)
    <tr>
        <td>{{++$key}}</td>
        <td>{{isset($policies->expiry_date) && !empty($policies->expiry_date) ? date("d/m/Y", strtotime($policies->expiry_date)) :  ''}}</td>
        <td>{{$policies->holder_name ?? ''}}</td>
        <td>{{$policies->subProduct->name ?? ''}}</td>
        <td>{{$policies->models->name ?? ''}}</td>
        <td>{{$policies->reg_no ?? ''}}</td>
        <td>{{$policies->gross_premium ?? ''}}</td>
        <td>{{$policies->ncb_in_existing_policy ?? ''}}</td>
        <td>{{$policies->claims_in_existing_policy ?? ''}}</td>
    </tr>
    @endforeach
    @endif
    </tbody>
</table>

<h4>This is an automated email. Please do not reply 
</h4>
<h4>Regards</h4>
<h4>GCS Services</h4>


</body>
</html>