<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <h2>Dear Sir/Madam,</h2>
    <p>
        This is for your information following insurance policies are expiring in coming days</p>
    <p>Please find details below: </p>
    <table style="border: 2px solid black;">
        <thead>
            <th style="border: 1px solid black;">Sr No.</th>
            <th style="border: 1px solid black;">Policy Expiry Date</th>
            <th style="border: 1px solid black;">Policy Holder Name</th>
            <th style="border: 1px solid black;">Sub Product</th>
            <th style="border: 1px solid black;">Make/Model</th>
            <th style="border: 1px solid black;">Reg No.</th>
            <th style="border: 1px solid black;">Last Year Premium</th>
            <th style="border: 1px solid black;">Last Year Ncb</th>
            <th style="border: 1px solid black;">Claim Status</th>
        </thead>
        <tbody>
            @if($user->policies->count())
            @foreach($user->policies as $key => $policies)
            <tr>
                <td style="border: 1px solid black;">{{++$key}}</td>
                <td style="border: 1px solid black;">{{isset($policies->expiry_date) && !empty($policies->expiry_date) ? date("d/m/Y", strtotime($policies->expiry_date)) :  ''}}</td>
                <td style="border: 1px solid black;">{{$policies->holder_name ?? ''}}</td>
                <td style="border: 1px solid black;">{{$policies->subProduct->name ?? ''}}</td>
                <td style="border: 1px solid black;">{{$policies->models->name ?? ''}}</td>
                <td style="border: 1px solid black;">{{$policies->reg_no ?? ''}}</td>
                <td style="border: 1px solid black;">{{$policies->gross_premium ?? ''}}</td>
                <td style="border: 1px solid black;">{{$policies->ncb_in_existing_policy ?? ''}}</td>
                <td style="border: 1px solid black;">{{$policies->claims_in_existing_policy ?? ''}}</td>
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