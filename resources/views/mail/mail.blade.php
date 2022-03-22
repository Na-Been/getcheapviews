<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
<h1>{{ $name }}</h1>
<h3>Hi {{ $userName }}</h3>
<br/>
<p>Thank you for choosing {{ $name }}. We look forward to hosting your stay.
    Thanks For Your Booking And Hope You Like Our Services!!!</p>

<br/>
<p><b>If you need to make changes or require assistance please call {{ $setting->phone ?? ' ' }}  or email us at {{ $setting->email ?? ' '}}. </b></p>
<br/>
<p> We look forward for more orders from you at {{ $name }}!</p>
<br/>
<h2>{{ $name }}</h2>
</body>

</html>
