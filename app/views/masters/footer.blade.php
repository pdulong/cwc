<!--Start of Landing Page Footer-->
<footer role="contentinfo">
<div id="page_footer" class="row">
<ul>
<li><a href="http://www.cryptowavecapital.com">About</a></li>
</ul>

{{trans('interface.changeLang')}} :
<ul class="language_bar_chooser">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <li>
            <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                <img src="{{asset('images/flags/' . $localeCode .'.png')}}" alt="{{{ $properties['native'] }}}" />
            </a>
        </li>
    @endforeach
</ul>


<p>
&copy; {{trans('interface.copyright')}}
</p>
</div>
</footer>
<!--End of Landing Page Footer-->

<a href="#" class="scrollup">Scroll up</a>

{{ HTML::script('js/foundation.min.js') }}
{{ HTML::script('js/phrases.js') }}


</body>
</html>