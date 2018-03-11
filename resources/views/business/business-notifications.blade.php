@extends('layouts.app')
@section('body')
    @include('partials.back')
    {{--@forelse($notifications as $notification)--}}

    {{--@empty--}}
    {{--@endforelse--}}
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3 class="text-center">Business Notifications</h3>
            @forelse($notifications as $notification)
                <div class="card">
                    <div class="card-footer">
                        <p>From: <b>{{$notification->sender_name}}</b><hr></p>
                        <h4><b>The subject goes here</b></h4>
                        <button class="theme-background float-left round-5" data-toggle="collapse" data-target="#bn-{{$notification->id}}">show</button>
                    </div>
                    <div class="card-body collapse" id="bn-{{$notification->id}}">
                        The body of the message goes here and should be able to handle a lot of text know what i'm saying?
                    </div>
                </div><br>
            @empty
                <div class="card">
                    <div class="card-footer">
                        <h4 class="card-header"><b>No notifications yet</b></h4>
                    </div>
                </div><br>
            @endforelse

        </div>
    </div>

@endsection