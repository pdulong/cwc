@include('masters.header')
<body class="content_page">

<!--Start of Product Banner-->
<section id="banner" role="banner">
<div class="row">

<!--Start of Header Logo-->
<div id="logo" class="two_thirds">
<hgroup>
<h1><img src="{{ URL::asset('images/logo.png') }}" alt="{{trans('interface.header_title')}}" title="Go to homepage" height="41" width="41">{{trans('interface.header_title')}}</h1>
<h2>{{trans('interface.header_slogan')}}</h2>
</hgroup>
</div>
<!--End of Header Logo-->

<!--Start of Social Elements-->
<aside id="social_elements" class="one_third last">
<ul>
<li><a class="twitter" target="_blank" title="Twitter" href="http://www.twitter.com/WavePumpCapital"><span>Twitter</span></a></li>
<li><a class="facebook" target="_blank" title="Facebook" href=""><span>Facebook</span></a></li>
</ul>
</aside>
<!--End of Social Elements-->

</div>
</section>
<!--End of Product Banner-->

<!--Start of Main Content-->
<article role="main">
<div id="main_content">

@yield("content")

</div>
</article>

@include('masters.footer')