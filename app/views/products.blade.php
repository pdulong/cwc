@extends("masters.default") @section("content")

<section id="banner" role="banner">
    <div class="row">
        <div id="header_region">

            <div id="logo" class="two_thirds">
                <h1><img src="{{ URL::asset('images/logo.png') }}" alt="{{trans('interface.header_title')}}" title="Go to homepage" height="41" width="41">{{trans('interface.header_title')}}</h1>
                <h2>{{trans('interface.header_slogan')}}</h2>
            </div>

            <aside id="social_elements" class="one_third last">
                <ul class="language_bar_chooser">
				    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
				        <li>
				            <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
				                <img src="{{asset('images/flags/' . $localeCode .'.png')}}" alt="{{{ $properties['native'] }}}" />
				            </a>
				        </li>
				    @endforeach
				</ul>
            </aside>
        </div>

        <div id="shelf" class="one_half"><img src="{{ URL::asset('images/book_dummy.png')}}" height="451" width="331" alt="{{trans('interface.header_slogan')}}"></div>

        <div class="one_half last">
            <h1>{{trans('interface.intro_title')}}</h1>
            <h2 class="subheader">{{trans('interface.intro_subtitle')}}</h2>
            <p>{{trans('interface.intro_desc')}}</p>

            <div class="button_buy">
                <a href="#pricing" class="gradient" title="{{trans('interface.home_buyMc')}}"><span class="button_price">&euro; {{Product::formatCurrency($cheapestPrice)}}</span> <span class="button_text">{{trans('interface.home_buyMcFull')}}</span></a>
                <p class="hint">{{trans('interface.intro_hint', array('return' => '&euro; ' . Product::formatCurrency(2520)))}}</p>
            </div>
        </div>
    </div>
</section>

<article role="main">
    <div id="main_content">
        <!--Start of Features-->

        <section id="features">
            <div class="row">
                <!--Start of Features Title-->

                <h2 class="section_title"><span></span></h2><!--End of Features Title-->
                <!--Start of Features List-->

                <ul>
                    <li class="one_half">
                    	<i class="icon-cogs icon-4x"></i>
                        <h4>{{trans('interface.hp_f1_title')}}</h4>
                        <p>{{trans('interface.hp_f1_desc')}}</p>
                    </li>

                    <li class="one_half last">
                        <i class="icon-cogs icon-4x"></i>
                        <h4>{{trans('interface.hp_f2_title')}}</h4>
                        <p>{{trans('interface.hp_f2_desc')}}</p>
                    </li>

                    <li class="one_half">
                    	<i class="icon-cogs icon-4x"></i>
                        <h4>{{trans('interface.hp_f3_title')}}</h4>
                        <p>{{trans('interface.hp_f3_desc')}}</p>
                    </li>

                    <li class="one_half last">
                    	<i class="icon-cogs icon-4x"></i>
                        <h4>{{trans('interface.hp_f4_title')}}</h4>
                        <p>{{trans('interface.hp_f4_desc')}}</p>
                    </li>

                    <li class="one_half">
						<i class="icon-cogs icon-4x"></i>
                        <h4>{{trans('interface.hp_f5_title')}}</h4>
                        <p>{{trans('interface.hp_f5_desc')}}</p>
                    </li>

                    <li class="one_half last">
						<i class="icon-cogs icon-4x"></i>
                        <h4>{{trans('interface.hp_f6_title')}}</h4>
                        <p>{{trans('interface.hp_f6_desc')}}</p>
                    </li>
                </ul><!--End of Features List-->
            </div>
        </section><!--End of Features-->
        <!--Start of Testimonials-->

        <section id="testimonials" class="background_grey">
            <div class="row">
                <!--Start of Testimonial-->

                <blockquote class="one_third">
                    <q>{{trans('interface.test_1_desc')}}</q>

                    <footer>
                        <img src="{{ URL::asset('images/testimonial_author_1.jpg')}}" height="60" width="60" alt="John Doe">

                        <div>
                            {{trans('interface.test_1_name')}}
                        </div>{{trans('interface.test_1_job')}}
                    </footer>
                </blockquote><!--End of Testimonial-->
                <!--Start of Testimonial-->

                <blockquote class="one_third">
                    <q>{{trans('interface.test_2_desc')}}</q>

                    <footer>
                        <img src="{{ URL::asset('images/testimonial_author_2.jpg')}}" height="60" width="60" alt="Jane Doe">

                        <div>
                            {{trans('interface.test_2_name')}}
                        </div>{{trans('interface.test_2_job')}}
                    </footer>
                </blockquote><!--End of Testimonial-->
                <!--Start of Testimonial-->

                <blockquote class="one_third last">
                    <q>{{trans('interface.test_3_desc')}}</q>

                    <footer>
                        <img src="{{ URL::asset('images/testimonial_author_3.jpg')}}" height="60" width="60" alt="Jimmy Doe">

                        <div>
                            {{trans('interface.test_3_name')}}
                        </div>{{trans('interface.test_3_job')}}
                    </footer>
                </blockquote><!--End of Testimonial-->
            </div>
        </section><!--End of Testimonials-->
        <!--Start of Screenshots-->

        <section id="screenshots" class="background_white">
            <div class="row">
                <div class="one_half">
                    <!--Start of Screenshots Title-->

                    <h2>{{trans('interface.hp_profit_title')}}</h2>
                    <h3>{{trans('interface.hp_profit_sub')}}</h3>
                    <p>{{trans('interface.hp_profit_desc')}}</p>

                    <ul class="list_check">
                        <li>{{trans('interface.hp_profit_list_1')}}</li>
                        <li>{{trans('interface.hp_profit_list_2')}}</li>
                        <li>{{trans('interface.hp_profit_list_3')}}</li>
                    </ul><!--End of Check List-->
                </div>

                <div class="one_half last">

                    <div id="" class="pricing_block one_fourth" style="width: 200px;">
                        <div class="pricing_header">
                            <h4>{{trans('interface.hp_retApr')}}</h4>
                        </div>

                        <div class="pricing">
                            <p class="price"><span>&euro;</span>{{Product::formatCurrency(2925)}}</p>

                            <p class="price_sub">{{trans('interface.hp_profitCert')}}</p>
                        </div>

                        <ul>
                            <li>{{trans('interface.hp_profitMade')}}</li>
                        </ul><a href="#pricing" class="button_buy_table gradient">{{trans('interface.hp_getProfit')}}</a>
                    </div><!--End Pricing Block-->
                    <!--Beginn Pricing Block-->

                    <div id="favorite" class="pricing_block one_fourth" style="width: 200px;">
                        <div class="pricing_header">
                            <h4>{{trans('interface.hp_retJune')}}</h4>
                        </div>

                        <div class="pricing">
                            <p class="price"><span>&euro;</span> {{Product::formatCurrency(2520)}}</p>

                            <p class="price_sub">{{trans('interface.hp_profitCert')}}</p>
                        </div>

                        <ul>
                            <li>{{trans('interface.hp_profitMade')}}</li>
                        </ul><a href="#pricing" class="button_buy_table gradient">{{trans('interface.hp_getProfit')}}</a>
                    </div><!--End Pricing Block-->
                </div>
            </div>
        </section><!--End of Screenshots-->

        <section class="background_white">
            <div class="row">
                <div class="one_half"><img src="{{ URL::asset('images/device_dummy.png')}}" alt="{{trans('interface.metaDesc')}}" height="352" width="350"></div>

                <div class="one_half last">
                    <h2>{{trans('interface.hp_hiw_title')}}</h2>
                    <h3>{{trans('interface.hp_hiw_sub')}}</h3>
                    <p>{{trans('interface.hp_hiw_desc_1')}}</p>
                    <p>{{trans('interface.hp_hiw_desc_2')}}</p>
                </div><!--End of How it Works-->
            </div>
        </section><!--Start of Pricing-->

        <section id="pricing" class="background_grey">
            <div class="row">
                <h2 class="section_title"><span>{{trans('interface.hp_products')}}</span></h2>

                <div id="pricing_table">
                    @foreach( $products as $index => $product)

                    <div @if ($product -> fav) id="favorite" @endif class="pricing_block one_fourth @if ($index+1 == count($products)) last @endif ">
                        <div class="pricing_header">
                            <h4>{{ trans('interface.productName_'.$product -> nameSlug) }}</h4>
                        </div>

                        <div class="pricing">
                            <p class="price"><span>&euro;</span> {{ Product::formatCurrency($product -> price_per_hash) }}</p>
                            <p class="price_sub">{{trans('interface.hp_perCert')}}</p>
                        </div>

                        <ul>
                            <li>{{ $product -> hash }} {{{ ( $product -> hash > 1)?trans('interface.buy_certificate_plural'):trans('interface.buy_certificate_single') }}}</li>
                            <li>{{trans('interface.hp_expect')}}:</li>
                            <li class="last">&euro; {{ Product::formatCurrency($product -> hash * $thisMonthRev * 12)}} *</li>
                        </ul><a href="{{ action('OrderController@getBuy', array('product' => $product -> id)) }}" class="button_buy_table gradient">{{trans('interface.hp_buy_now')}}</a>
                    </div>

                    @endforeach
                </div><!--End of Pricing Table-->
            </div>
        </section><!--End of Pricing-->

        <section id="author" class="background_white">
            <div class="row">
                <div class="one_half">
                    <img src="{{ URL::asset('images/author.jpg')}}" height="100" width="100" id="author_image" class="left" alt="{{trans('interface.companyName')}}">

                    <div class="one_third last">
                        <h2>{{trans('interface.hp_who_title')}}</h2>
                        <p>{{trans('interface.hp_who_desc_1')}}</p>
                        <p>{{trans('interface.hp_who_desc_2')}}</p>

                    </div>
                </div>

                <div class="one_half last">
                    <img src="{{ URL::asset('images/book_dummy_content.jpg')}}" alt="{{trans('interface.header_title')}}" height="370" width="320">
                </div>

                <div class="button_buy">
                    <a href="#pricing" class="gradient" title="{{trans('interface.home_buyMc')}}"><span class="button_price">&euro; {{Product::formatCurrency($cheapestPrice)}}</span> <span class="button_text">{{trans('interface.home_buyMcFull')}}</span></a>
                    <p class="hint" style="color: black;">{{trans('interface.intro_hint', array('return' => '&euro; ' . Product::formatCurrency(2520) ))}}</p>
                </div>
            </div>
        </section>
    </div>
</article>
@stop