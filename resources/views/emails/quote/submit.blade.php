<html>
<head>

</head>
<body>
<img src="{{ asset("img/logo.png") }}" alt="junkdeal" height="68" width="202"/>
<br>
<br>
<b>Thank you for submitting your quote request.</b>
<br>
<p>Our team will get back to you shortly. We appreciate your interest and look forward to helping you with your hauling needs.</p>
<p><b>Quote details:</b></p>
<table style="width:600px;border-bottom:1px solid #ccc;border-right:1px solid #ccc" cellspacing="0" cellpadding="3">
    <tr>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Name</td>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{ $quote->name }}</td>
    </tr>
    <tr>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Phone</td>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d"><a href="tel:{{$quote->phone}}">{{ $quote->phone }}</a></td>
    </tr>
    <tr>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Zip Code</td>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{ $quote->zip_code }}</td>
    </tr>
    <tr>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Email</td>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d"><a href="mailto:{{$quote->email}}">{{ $quote->email }}</a></td>
    </tr>
    <tr>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Date</td>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{ $quote->date_scheduled  }}</td>
    </tr>
    <tr>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Junk description</td>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{ $quote->description  }}</td>
    </tr>
</table>

<p><a href="https://junkdeal.com">www.junkdeal.com</a></p>
</body>
</html>
