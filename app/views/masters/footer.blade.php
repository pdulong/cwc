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

<script type="text/javascript">
	$(document).ready(function() {

		// initialize: switcher component
		jQuery('#switcher-light').switcher();

		// click; toggle switcher dropdown
		jQuery('#switcher-light .selected, #switcher-light .toggleControl').bind('click', function(e) {
			// prevent selected options' link from loading
			e.preventDefault();

			jQuery('#switcher-light').switcher('toggle');
		});

		// hide switcher dropdown if clicked anywhere outside its' region
		jQuery('#switcher-light').region('click', function(e, inside) {
			if(!inside) {
				jQuery('#switcher-light').switcher('show', false);
			}
		});

	});
	</script>

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