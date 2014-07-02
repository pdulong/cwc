<h3>{{trans('interface.email_orderComplete')}}</h3>
<p>{{trans('interface.email_orderComplete_desc')}}</p>
<p>
<strong>{{trans('interface.email_orderDetails')}}</strong><br/>
<b>{{trans('interface.email_orderId')}}:</b> {{$order['randomString']}}<br/>
<b>{{trans('interface.buy_product')}}:</b> {{trans('interface.productName_' . $order['nameSlug'])}}<br/>
<b>{{trans('interface.buy_certificate_plural')}}:</b> {{$order['hash']}} {{trans('interface.buy_certificate_plural')}}<br/>
</p>
<p>{{trans('interface.email_regards')}},<br/>{{trans('interface.companyName')}}</p>