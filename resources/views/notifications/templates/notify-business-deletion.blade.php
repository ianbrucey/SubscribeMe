<h4><span class="theme-color">{{$business->name}}</span> has chosen to end their partnership with us.
    The following subscription will be canceled:"</h4>
<hr>
<ul style="width: 100%">

    <li>Subscription name: <h4 class="theme-color">{{$plan->stripe_plan_name}}</h4></li>
    <li>Refund Status: {{$refundStatus['refund'] ? sprintf("a refund of %s will be issued back to you", $refundStatus['amount']) : 'No refund is due'}}</li>

</ul>

<p>We apologize for any inconvenience this may have caused. <br>Thank you for your business.</p>
