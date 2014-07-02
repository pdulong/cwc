@extends('masters.default_single')

@section('content')

<script type="text/javascript" src="{{asset('js/jquery.urlshortener.min.js');}}"></script>

<script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '332594696892411',
          xfbml      : true,
          version    : 'v2.0'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>

<script type="text/javascript">
$.urlShortener.settings.apiKey='AIzaSyCJGdGAfBxuN_uQfzY9_jzyx1a9xn8bkDU';

$(document).ready(function(){
	$.urlShortener({
	    longUrl: "{{$url}}",
	    success: function (shortUrl) {
	        $("a#shorter_link").prop('href',shortUrl).text(shortUrl);
	    },
	    error: function(err)
	    {
	        alert(JSON.stringify(err));
	    }
	});


});



</script>

<section>
<div class="row">

	<h1>{{trans('interface.complete_title')}}</h1>

	@if(Session::has('successMessage') || isset($successMessage))
		<div class="message success"><p>{{ (isset($successMessage)?$successMessage:Session::get('successMessage')) }}</p></div>
	@endif

	<p>{{trans('interface.complete_desc')}}</p>

	<h2>{{trans('interface.complete_aff_title')}}!</h2>
	<p>{{trans('interface.complete_aff_desc')}}</p>

	<h3>{{trans('interface.complete_aff_dl_title')}}</h3>
	<p>{{trans('interface.complete_aff_dl_desc')}} <strong><a href="#" id="shorter_link">{{$url}}</a></strong> .

	<h3>{{trans('interface.complete_aff_fb_title')}}</h3>
	<p>{{trans('interface.complete_aff_fb_desc')}}</p>
	<div class="fb-share-button" data-href="{{$url}}" data-type="button"></div>

	<h3>{{trans('interface.complete_aff_tw_title')}}</h3>
	<p>{{trans('interface.complete_aff_tw_desc')}}</p>
	<a href="{{$url}}" class="twitter-share-button" data-lang="en">Tweet</a>


<!--
	<p>
		<a href="{{ URL::to('products') }}" class="bigButton">Go back to homepage</a>
	</p>
-->

</div></section>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

@stop
