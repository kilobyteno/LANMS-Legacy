<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        .invoice-box{max-width:800px;margin:auto;padding:30px;border:1px solid #eee;box-shadow:0 0 10px rgba(0,0,0,.15);font-size:16px;line-height:24px;font-family:'Helvetica Neue',Helvetica,Helvetica,Arial,sans-serif;color:#555}
        .invoice-box table{width:100%;line-height:inherit;text-align:left}
        .invoice-box table td{padding:5px;vertical-align:top}
        .invoice-box table tr td:nth-child(2){text-align:right}
        .invoice-box table tr.top table td{padding-bottom:20px}
        .invoice-box table tr.top table td.title{font-size:45px;line-height:45px;color:#333}
        .invoice-box table tr.information table td{padding-bottom:40px}
        .invoice-box table tr.heading td{background:#eee;border-bottom:1px solid #ddd;font-weight:700}
        .invoice-box table tr.details td{padding-bottom:20px}
        .invoice-box table tr.item td{border-bottom:1px solid #eee}
        .invoice-box table tr.item.last td{border-bottom:none}
        .invoice-box table tr.total td:nth-child(2){border-top:2px solid #eee;font-weight:700}
        @media only screen and (max-width:600px){.invoice-box table tr.information table td,.invoice-box table tr.top table td{width:100%;display:block;text-align:center}}
        .rtl{direction:rtl;font-family:Tahoma,'Helvetica Neue',Helvetica,Helvetica,Arial,sans-serif}
        .rtl table{text-align:right}
        .rtl table tr td:nth-child(2){text-align:left}
        @media print{.invoice-box{box-shadow:none;border:none}}
    </style>
</head>
<body onload="window.print()">
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ Setting::get('WEB_LOGO_ALT') }}" style="width:100%; max-width:300px;">
                            </td>
                            <td>
                                {{ trans('pdf.receipt.reservationnumber') }}: {{ $payment->reservation->id }}<br>
                                {{ trans('global.date') }}: {{ ucfirst(\Carbon::parse($payment->reservation->created_at)->isoFormat('LLLL')) }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                            	{{ Setting::get('WEB_NAME') }}<br>
                                {{ LANMS\Info::getContent('address_street') }}<br>
                                {{ LANMS\Info::getContent('address_postal_code') }}, {{ LANMS\Info::getContent('address_city') }}<br>
                                {{ LANMS\Info::getContent('address_county') }}, {{ LANMS\Info::getContent('address_country') }}<br>
                            </td>
                            <td>
                                {{ $payment->user->username }}<br>
                                {{ $payment->user->firstname }} {{ $payment->user->lastname }}<br>
                                {{ $payment->user->email }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>{{ trans('pdf.receipt.paymentmethod') }}</td>
                <td>{{ trans('pdf.receipt.paymentinfo') }}</td>
            </tr>
            <tr class="details">
                <td>{{ trans('pdf.receipt.card') }}</td>
                <td>#{{ $payment->id }} &middot; {{ ucfirst(\Carbon::parse($payment->created_at)->isoFormat('LLLL')) }}</td>
            </tr>
            <tr class="heading">
                <td>{{ trans('pdf.receipt.item') }}</td>
                <td>{{ trans('pdf.receipt.price') }}</td>
            </tr>
            <tr class="item last">
                <td>{{ trans('pdf.receipt.ticket') }} {{ $payment->reservation->year }} - {{ $payment->reservation->seat->name }}</td>
                <td>{{ substr($charge['amount'], 0, -2) }} {{ strtoupper($charge['currency']) }}</td>
            </tr>
            <tr class="total">
                <td></td>
                <td>{{ trans('pdf.receipt.total') }}: {{ substr($charge['amount'], 0, -2) }} {{ strtoupper($charge['currency']) }}</td>
            </tr>
        </table>
    </div>
</body>
</html>