<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Emi Generated for Loan Request Number: {{$emis[0]['loan_requests_id']}}</title>
    <style>
    .page-break {
        page-break-after: always;
    }
    table{
          max-width: 100%;
    }
    </style>
</head>
<body>
    <table border="1px" >
    <tr><td  style="width:20%;">EMI Date</td><td style="width:20%;">EMI Number</td><td style="width:20%;">EMI Amount</td><td style="width:20%;">Interest</td><td style="width:20%;">Remaining Amount</td></tr>
    @foreach($emis as $emi)
        <tr><td>{{$emi['emi_date']}}</td><td>{{$emi['emi_number']}}</td><td>{{round($emi['emi_amount'])}}</td><td>{{$emi['rate_of_interest']}}</td><td>{{round($emi['remaining_amount'])}}</td></tr>
    @endforeach
    </table>
</body>
</html>