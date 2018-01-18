@extends('layouts.app')
@section('body')

@php
$intervals = ['month','year'];
@endphp
    <!-- Page Content -->
@include('partials.base-theme.store-nav')
    <div class="container">

        <div class="row">


            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div class="card mt-4 no-shadow">
                    <h1 class="product-title">{{$plan->stripe_plan_name}}</h1>
                    <div class="product-meta">
                        <ul class="list-inline">
                            <li class="list-inline-item"><i class="fa fa-user-o"></i> By <a href="">{{$business->name}}</a></li>
                            <li class="list-inline-item"><i class="fa fa-location-arrow"></i> <a href="">{{$business->city}}, {{$business->state}}</a></li>
                        </ul>
                    </div>
                    <div class="hd-img-top img-fluid" style="background: url({{asset('/storage/'.$plan->featured_photo_path)}}) no-repeat black; height: 320px; max-height: 320px; background-size: contain; background-position: center; "> </div>
                    @if(count($plan->photos))
                        <h5 class="card-body btn theme-background text-default" data-toggle="collapse" href="#photoGallery">
                            <span class="fa fa-photo"></span> View more photos
                        </h5>
                    @endif
                    <div class="card-body row collapse" id="photoGallery">
                        {{--<h6 class="col-md-12 text-info text-center">click to enlarge</h6>--}}
                        @foreach($plan->photos as $photo)

                            <div style="background: url({{asset('/storage/'.$photo->path)}}) no-repeat transparent; width: 32%; height: 100px; background-size: contain; background-position: center; display: inline-block; border: 1px solid lightgray" href="{{asset('/storage/'.$photo->path)}}" data-lity>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <h5>Usage Limit:</h5>
                        <p class="card-text"><strong>{{$plan->use_limit}} times a month</strong></p>
                        <hr>

                        <h4>Service description</h4>
                        <p class="card-text">{{$plan->description}}</p>
                        <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
                        4.0 stars
                    </div>
                </div>
                <!-- /.card -->

                <div class="card card-outline-secondary my-4 no-shadow">
                    <div class="card-header">
                        Product Reviews
                    </div>
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                        <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                        <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                        <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                        <hr>
                        <a href="#" class="btn btn-success">Leave a Review</a>
                    </div>
                </div>
                <!-- /.card -->

            </div>

            <div class="col-lg-3">
                <div class="card my-4 no-shadow">
                    <div class="card-header theme-background text-default">
                        Subscribe
                    </div>
                    <div class="list-group">
                            @foreach($intervals as $interval)

                            <form action="/subscription/subscribe" class=" list-group-item text-center" method="POST">
                                <h5 class="">{{$interval == 'month' ? formatPrice($plan->month_price) . " / month" : formatPrice($plan->year_price) . " / year"}}</h5>
                                <script
                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                        data-key="{{$publicStripeKey}}"
                                        data-amount="{{$interval == 'month' ? $plan->month_price : $plan->year_price}}"
                                        data-name="{{$plan->stripe_plan_name}} {{strtoupper($interval)}}"
                                        data-description="For plan: {{$plan->stripe_plan_id}}_{{$interval}}"
                                        data-image="{{ $haslogo ? asset('/storage/'.$business->logo_path) : ''}}"
                                        data-locale="auto">
                                </script>
                                <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                <input type="hidden" name="stripe_plan_id" value="{{$plan->stripe_plan_id}}_{{$interval}}">
                                <input type="hidden" name="stripe_plan_name" value="{{$plan->stripe_plan_name}} {{strtoupper($interval)}}">
                                <input type="hidden" name="is_app_plan" value="{{$plan->is_app_plan}}">
                                <input type="hidden" name="business_id" value="{{$plan->business_id}}">
                                <input type="hidden" name="price" value="{{$interval == 'month' ? $plan->month_price : $plan->year_price}}">
                                <input type="hidden" name="sm_interval" value="{{$interval}}">
                                {{csrf_field()}}
                                <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                            </form>
                            @endforeach
                    </div>
                </div>
            </div>

            <!-- /.col-lg-9 -->

        </div>

    </div>
 @endsection
