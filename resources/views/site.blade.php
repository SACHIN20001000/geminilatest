<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Pet Parents® | Healthy Pets. Happy Family ®</title>
    <link rel="icon" href="{{ !empty(globalSetting()['fav_icon']) ? asset('setting/' . globalSetting()['fav_icon']) : asset('assets/img/brand/favicon.png') }}" type="image/x-icon"/>
	<script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <div id="app">

        <app></app>

    </div>

    <!-- <script src="{{ mix('js/app.js') }}"></script> -->
     <script src="{{asset('js/app.js')}}" ></script>

</body>

</html>