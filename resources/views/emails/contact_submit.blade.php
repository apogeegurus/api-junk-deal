<html>
<head>

</head>
<body>
<img src="{{ asset("img/logo.png") }}" alt="junkdeal" height="68" width="202"/>
<br>
<br>
<b>
    Thank you for contacting us, our team will get back to you shortly. <br>
    if you need immediate assistance please call.<a href="tel:6509957500">650-995-7500</a>
</b>
<br>
<p><b>Contact details:</b></p>
<table style="width:600px;border-bottom:1px solid #ccc;border-right:1px solid #ccc" cellspacing="0" cellpadding="3">
    <tr>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Name</td>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{ $contact->name }}</td>
    </tr>
    <tr>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Subject</td>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{ $contact->subject }}</td>
    </tr>
    <tr>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Email</td>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d"><a href="mailto:{{$contact->email}}">{{ $contact->email }}</a></td>
    </tr>
    <tr>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">Message</td>
        <td style="border-top:1px solid #ccc;border-left:1px solid #ccc;padding:10px;color:#3d3d3d">{{ $contact->message  }}</td>
    </tr>
</table>

<p><a href="https://junkdeal.com">www.junkdeal.com</a></p>
</body>
</html>
