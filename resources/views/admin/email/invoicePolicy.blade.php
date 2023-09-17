<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .email-container {
        
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        background-color: #f5f5f5;
    }

    .header {
        text-align: center;
        padding: 20px 0;
        background-color: #007bff;
        color: #ffffff;
    }

    .content {
        padding: 20px;
        background-color: #ffffff;
        border: 1px solid #ccc;
        margin-top: 10px;
    }

    .footer {
        text-align: center;
        padding: 10px;
        background-color: #f5f5f5;
        border-top: 1px solid #ccc;
    }
</style>

<div class="email-container">
    <div class="header">
    </div>
    <div class="content">
        <p>Dear Sir/Mam,</p>
        <p>
            I hope this email finds you well. We are pleased to inform you about the successful conclusion
            of last month's insurance policies and the corresponding payouts. Please take a moment to review
            the attached payout summary for a detailed breakdown of your earnings.
        </p>
        <p>If you have any questions or concerns, feel free to reach out to our support team.</p>
        <p><strong>NOTE:</strong> This is an auto-generated message. Please do not reply.</p>
        <br>
        <p>Regards,<br>Team GCS</p>
    </div>
    <div class="footer">
        <p>This email is auto-generated. &copy; 2023 Team GCS</p>
    </div>

    <div class="container mt-4" style="font-family: Arial, sans-serif;">
    <h1 style="text-align: center;">PAYOUT REPORT</h1>

    <div class="row mt-4">
        <div class="col-md-6">
            <table class="table table-bordered" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">MONTH</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$invoice->invoice_date ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">REFERENCE NAME</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$invoice->users->name ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Bank Detail</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$invoice->users->bank_name ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">A/C NAME</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$invoice->name ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">A/C NO</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$invoice->bank_detail ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">IFSC CODE</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$invoice->users->ifsc ?? 'N/A'}}</td>
                </tr>
            </table>
        </div>

        <div class="col-md-6">
            <table class="table table-bordered" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">TOTAL PAYOUT</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$invoice->total_Payout}}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">SHORT PREMIUM AMOUNT</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$invoice->short_premium}}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">RECOVERY</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$invoice->recovery_cases}}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">GROSS AMOUNT</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$invoice->amount_transfer}}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">TDS%</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$invoice->tds}}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">NET AMOUNT</th>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$invoice->invoice_amount}}</td>
                </tr>
            </table>
        </div>
    </div>

    <h3 style="margin-top: 20px;">Policies</h3>
    <table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">SR NO</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">POLICY HOLDER NAME</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">TRANSACTION TYPE</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">TYPE OF BUSINESS</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">SUB PRODUCT</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">MODEL</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">VEH NO</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">GROSS PREMIUM</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">NET PREMIUM</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">OD PREMIUM</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">PREMIUM SHORT</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">COMMISSION BASE</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">BASE AMOUNT</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">PAYOUT %GE</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">PAYOUT</th>
            </tr>
        </thead>
        <tbody>
            @if($invoice->policy->count())
            @foreach($invoice->policy as $policy)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->id}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->holder_name}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->mis_transaction_type}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->bussiness_type}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->subProduct->name ?? ''}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->models->name}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->reg_no}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->gross_premium}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->net_premium}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->od_premium}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->mis_short_premium}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->commission_base}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->mis_commissionable_amount}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->mis_percentage}}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{$policy->mis_commission}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
</div>