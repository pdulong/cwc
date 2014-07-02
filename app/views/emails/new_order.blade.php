<h1>{{trans('interface.form_orderSuccess')}}</h1>

<p>{{trans('interface.email_new_order_desc')}}</p>
<p>
<strong>{{trans('interface.email_orderDetails')}}</strong><br/>
<b>{{trans('interface.email_orderId')}}:</b> {{$order['randomString']}}<br/>
<b>{{trans('interface.buy_product')}}:</b> {{trans('interface.productName_' . $order['nameSlug'])}}<br/>
<b>{{trans('interface.buy_certificate_plural')}}:</b> {{$order['hash']}} {{trans('interface.buy_certificate_plural')}}<br/>
<b>{{trans('interface.email_totalPrice')}}:</b> {{Product::formatCurrency($order['priceTotal'])}} {{$order['currency']}}
</p>

<p><a href="{{$paymentLink}}">{{trans('interface.email_paymentLink')}}</a></p>

<p>{{trans('interface.email_regards')}},<br/>{{trans('interface.companyName')}}</p>