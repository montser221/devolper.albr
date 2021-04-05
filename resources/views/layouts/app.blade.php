<!doctype html>

<html lang="en">

  <head>


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5WCKZ3P');</script>
<!-- End Google Tag Manager -->

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="AL20H8J2tRxn9nVKtTWcqR3VxKEEoEw00Jh_aMl13jE" />

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

     <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content=" 
				تهدف جمعية البر الخيرية بمحافظة المويه إلى تقديم الخدمات التي تحتاجها المحافظة والمراكز التابعة له												 
		"/>
    <meta name="keywords" content=" 	 جميعة خيرية 
جمعية البر 
جمعية البر بمحافظة المويه
	"/>
     <meta property="og:site_name" content="جمعية البر الخيرية بمحافظة المويه"/>
     <meta property="og:title" content="جمعية البر الخيرية بمحافظة المويه " />
      <meta property="og:description" content="المملكة العربيه السعودية-بمحافظة المويه - منطقة مكه المكرمة 01285208000555570381">
     <meta property="og:type" content="website"/>
     <meta property="og:image" content="uploads/logo.png"/>
    <meta property="og:url" content="https://biralmuwayh.com/"/>
    <!-- Bootstrap CSS -->

    <!-- <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}"> -->
    <link rel="stylesheet" href="{{url('css/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{ url('css/font-awesome.css') }}" >
  <link rel="stylesheet" href="{{ url('css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ url('css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ url('css/style.css') }}" >


    <title>@yield('title','title')</title>

  </head>

  <body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5WCKZ3P"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <div  >

        @yield('header')

    </div>



    <div >



        @yield('content')

 

    </div>





    <div>

       @yield('footer')

    </div>

    <!-- Optional JavaScript -->

    <!-- jQuery first, thenPopper.js, then Bootstrap JS -->
    <script src="{{url('js/jquery.min.js')}}"></script>
    <script src="{{url('js/popper.min.js')}}"></script>
    <script src="{{url("js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{url("js/owl.carousel.min.js")}}"></script>
    <script src="{{url("js/main.js")}}"></script>
    
    {{-- <!-- <script src="{{url("js/jquery.animateNumber.min.js") }}"></script> --> --}}

</body>

</html>

