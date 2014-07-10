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
                <p class="hint">{{trans('interface.intro_hint', array('return' => '&euro; ' . Product::formatCurrency(1680)))}}</p>
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

                <h2 class="section_title"><span>{{trans('interface.hp_features_title')}}</span></h2><!--End of Features Title-->
                <!--Start of Features List-->

                <ul>
                    <li class="one_half">
                    	<i class="icon-dashboard icon-4x"></i>
                        <h4>{{trans('interface.hp_f1_title')}}</h4>
                        <p>{{trans('interface.hp_f1_desc')}}</p>
                    </li>

                    <li class="one_half last">
                        <i class="icon-shopping-cart icon-4x"></i>
                        <h4>{{trans('interface.hp_f2_title')}}</h4>
                        <p>{{trans('interface.hp_f2_desc')}}</p>
                    </li>

                    <li class="one_half">
                    	<i class="icon-ok icon-4x"></i>
                        <h4>{{trans('interface.hp_f3_title')}}</h4>
                        <p>{{trans('interface.hp_f3_desc')}}</p>
                    </li>

                    <li class="one_half last">
                    	<i class="icon-money icon-4x"></i>
                        <h4>{{trans('interface.hp_f4_title')}}</h4>
                        <p>{{trans('interface.hp_f4_desc')}}</p>
                    </li>

                    <li class="one_half">
						<i class="icon-star icon-4x"></i>
                        <h4>{{trans('interface.hp_f5_title')}}</h4>
                        <p>{{trans('interface.hp_f5_desc')}}</p>
                    </li>

                    <li class="one_half last">
						<i class="icon-signal icon-4x"></i>
                        <h4>{{trans('interface.hp_f6_title')}}</h4>
                        <p>{{trans('interface.hp_f6_desc')}}</p>
                    </li>
                </ul><!--End of Features List-->
            </div>
        </section><!--End of Features-->
        <!--Start of Testimonials-->


        <section id="screenshots" class="background_grey">
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
                            <p class="price"><span>&euro;</span>{{Product::formatCurrency(1820)}}</p>

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
                            <p class="price"><span>&euro;</span> {{Product::formatCurrency(1680)}}</p>

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
                            <li>{{trans('interface.hp_maturity')}}</li>
                            <li>{{trans('interface.hp_expect')}}:</li>
                            <li class="last">&euro; {{ Product::formatCurrency($product -> hash * $thisMonthRev * 12)}} *</li>
                        </ul><a href="{{ action('OrderController@getBuy', array('product' => $product -> id)) }}" class="button_buy_table gradient">{{trans('interface.hp_buy_now')}}</a>
                    </div>

                    @endforeach
                </div><!--End of Pricing Table-->

                <div>
	            	<span><strong>* = </strong>{{trans('interface.hp_expectDesc')}}</span>
	            </div>
            </div>


        </section><!--End of Pricing-->

        <section id="author" class="background_white">
            <div class="row">
                <div class="one_half">
                    <h2>{{trans('interface.hp_who_title')}}</h2>
                    <p>{{trans('interface.hp_who_desc_1')}}</p>
                    <p>{{trans('interface.hp_who_desc_2')}}</p>
                    <p style="text-align:center;"><img src="{{URL::asset('images/web300.png')}}" alt="{{ trans('interface.companyName') }}" width="300" /></p>
                </div>

                <div class="one_half last">
                    <h2>{{trans('interface.contact_title')}}</h2>

                    @if(Session::has('contactMessage'))
						<div class="message success"><p>{{ Session::get('contactMessage') }}</p></div>
					@endif

				    @foreach($errors->all() as $error)
				        <div class="message error"><p>{{ $error }}</p></div>
				    @endforeach

                    {{ Form::open(array('url'=>'contact')) }}

                    <div class="fieldRow">
						{{ Form::label('name', trans('interface.contact_name')); }}
					    {{ Form::text('name', null, array('placeholder' => trans('interface.contact_name'))) }}
				    </div>

				    <div class="fieldRow">
						{{ Form::label('email', trans('interface.form_email')); }}
					    {{ Form::text('email', null, array('placeholder' => trans('interface.form_email'))) }}
				    </div>

				    <div class="fieldRow">
						{{ Form::label('message', trans('interface.contact_message')); }}
					    {{ Form::textarea('message', null, array('placeholder' => trans('interface.contact_message'))) }}
				    </div>

                    <p>{{ Form::submit(trans('interface.contact_Send'), array('class'=>'', 'id' => 'submit',  'style'=>'margin-left: 129px;'))}}</p>
					{{ Form::close() }}
                </div>

            </div>
        </section>

        <section class=" background_grey">

        </section>
    </div>
</article>
@stop