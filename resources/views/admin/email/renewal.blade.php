 <h4>Dear Sir/Madam,</h4>
 <p>This is for your information following case is due Please find details below:</p>
 <ul>
     <li>Customer Name : {{$policy->holder_name}}</li>
     <li>Product :{{$policy->products->name ?? ''}}</li>
     <li>Sub Product:{{$policy->subProduct->name ?? ''}}</li>
     <li>Registration No. : {{$policy->reg_no}}</li>
     <li>Expiry Date : {{$policy->expiry_date}}</li>
 </ul>
 <p>This is an automated email. Please do not reply </p>
 <p>Regards </p>
 <h5>GCS Services</h5>