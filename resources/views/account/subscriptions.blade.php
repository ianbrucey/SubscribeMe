@extends('layouts.app')

@section('body')
    @include('partials.account-back')

    <div class="container">
        <div class="row">
            <div class="col-12">
                @if($portalBusiness)
                    <div class="alert alert-success text-center">
                        Success!
                        <br>
                        You can always manage your subscription here on Otruvez or at <b>{{ucfirst($portalBusiness->name)}}</b>
                        <br>
                        @if(!empty($portalBusiness->redirect_to))
                            <a class="btn bg-white theme-color btn-sm m-auto" href="{{$portalBusiness->redirect_to}}">
                                Click here to go back to {{ucfirst($portalBusiness->name)}}
                            </a>
                        @endif
                    </div>


                @endif
            </div>
            <div class="col-12">
                <h3 class="text-center"> My Subscriptions</h3>
                @include('errors.request-errors')
            </div>
            <div class="col-12">
                @if($mustUpdatePaymentMethod)
                    <div class="alert alert-danger">
                        Your subscriptions are suspended. Please update your payment method.
                        If you do not update your payment method soon, your subscriptions will be cancelled<br>
                        <a class="btn btn-danger btn-sm text-white m-auto" href="/account/updatePayment">
                            Update Payment Method
                        </a>
                    </div>


                @endif
            </div>
            <div class="col-md-8 offset-md-2">

                @forelse($subscriptions as $subscription)
                    @php
                        $plan = $subscription->plan();
                        $usesRemaining = calculateRemainingUses($plan, $subscription);

                    @endphp

                <div class="card">
                        <div class="card-header text-center">
                            {{removeLastWord($subscription->name)}}<br>
                            by {{"@".$plan->business->business_handle}}<br>
                            <p>{{$usesRemaining['usesRemaining'] == -1 ? '' : sprintf("You can use this subscription %s more %s this %s", $usesRemaining['usesRemaining'], $usesRemaining['usesRemaining'] > 1 ? 'times' : 'time', $usesRemaining['limitInterval']) }}</p>
                            <form method="POST" id="delete-subscription-form-{{$subscription->id}}" action="/subscription/cancel/{{$subscription->id}}" style="display: inline-block" class="float-right">
                                {{csrf_field()}}
                                {{method_field("DELETE")}}
                                <input type="hidden" name="is_business_account" value="0">
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <img src="{{getImage($plan->featured_photo_path)}}" height="150">
                                </div>
                            </div>
                            <hr>

                            {{--<button class=" col-12 btn-sm theme-background show-sm-modal checkin" data-subscription-id="{{$subscription->id}}" data-plan-id="{{$plan->id}}" data-modal-target="#checkin-{{$subscription->id}}" {{$mustUpdatePaymentMethod ? "disabled" : ""}}><span class="fa fa-check-circle"></span> Check-in </button> --}}{{-- still needs to be worked out --}}
                            {{--<button class=" col-12 btn-sm theme-background show-sm-modal" data-modal-target="#subscription-details-{{$plan->id}}" {{$mustUpdatePaymentMethod ? "disabled" : ""}}><span class="fa fa-eye"></span> View Details </button> --}}{{-- we need a modal for this --}}
                            {{--<a style="display: block" class="col-12 btn-sm theme-background text-center" href="{{$mustUpdatePaymentMethod ? "#" : '/business/viewService/'.$plan->id.'/#review-container'}}" ><span class="fa fa-pencil-square"></span> Write A Review </a>--}}
                            {{--<button class=" col-12 btn-sm theme-background show-sm-modal" data-modal-target="#rate-{{$plan->id}}" {{$mustUpdatePaymentMethod ? "disabled" : ""}}><span class="fa fa-star"></span> Rate </button>--}}
                            {{--<hr>--}}
                            {{--<button type="submit" class="btn-sm btn-danger" data-target="#delete-subscription-form-{{$subscription->id}}" data-subscription-name="{{removeLastWord($subscription->name)}}" onclick="cancelSubscription(event, this)"> Cancel Subscription </button> --}}{{-- still needs to be worked out --}}
                            <table class="table table-striped">
                                <tbody>
                                <tr class=" theme-background text-center checkin" data-subscription-id="{{$subscription->id}}" data-plan-id="{{$plan->id}}" data-modal-target="#checkin-{{$subscription->id}}" {{$mustUpdatePaymentMethod ? "disabled" : ""}}><td><span class="fa fa-check-circle"></span> Check-in </td></tr>
                                <tr class=" theme-background text-center show-sm-modal" data-modal-target="#subscription-details-{{$plan->id}}" {{$mustUpdatePaymentMethod ? "disabled" : ""}}><td><span class="fa fa-eye"></span> View Details</td></tr>
                                <tr class=" theme-background text-center" data-href="{{$mustUpdatePaymentMethod ? "#" : '/business/viewService/'.$plan->id.'/#review-container'}}" onclick="triggerTargetHref(event, this)"><td><span class="fa fa-pencil-square"></span> Write A Review </td></tr>
                                <tr class=" theme-background text-center show-sm-modal" data-modal-target="#rate-{{$plan->id}}" {{$mustUpdatePaymentMethod ? "disabled" : ""}}><td><span class="fa fa-star"></span> Rate </td></tr>
                                </tbody>
                            </table>
                            <hr>
                            <button type="submit" class="btn-sm btn-danger" data-target="#delete-subscription-form-{{$subscription->id}}" data-subscription-name="{{removeLastWord($subscription->name)}}" onclick="cancelSubscription(event, this)"> Cancel Subscription </button>
                        </div>
                </div>
                @include('modals.custom.checkin-modal')
                @include('modals.custom.ratings-modal')
                @include('modals.custom.subscription-details-modal')
                @empty
                    <div class="card">
                        <div class="card-header">No subscriptions yet!</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{baseUrlConcat('/js/ajax/checkin.js')}}"></script>
@endsection
