
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">

<!--Page Title-->
<title>{{trans('interface.title')}} - {{trans('interface.header_slogan')}}</title>

<!--Device Width Check-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>

<!--Meta Keywords and Description-->
<meta name="keywords" content="{{trans('interface.metaKeywords')}}">
<meta name="description" content="{{trans('interface.metaDesc')}}">

<!--Favicon-->
<link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}" title="Favicon" />

<!--Fixes for Internet Explorer CSS3 and HTML5-->
<!--[if gte IE 9]>
<style type="text/css">
	.gradient { filter: none!important;}
</style>
<![endif]-->

<!--[if lt IE 9]>
<script>
  'article aside footer header nav section time'.replace(/\w+/g,function(n){document.createElement(n)})
</script>
<![endif]-->

<!--Main CSS-->

{{ HTML::style('css/style.css') }}


<!--[if lt IE 9]>
{{ HTML::style('css/style_ie8.css') }}
<![endif]-->

<!--Icon Fonts-->
{{ HTML::style('css/font-awesome.min.css') }}

<!--[if IE 7]>
{{ HTML::style('css/font-awesome-ie7.min.css') }}
<![endif]-->

<!--Google Webfonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300,600|Bree+Serif' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('a[href*=#]').on('click', function(event){
	    event.preventDefault();
	    $('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
	});
});
</script>

<meta property="og:title" content="{{trans('interface.title')}}" />
<meta property="og:description" content="{{trans('interface.fbShareDialog')}}" />
<meta property="og:image" content="https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/851565_496755187057665_544240989_n.jpg" />

</head>