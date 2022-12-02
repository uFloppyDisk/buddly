@extends('layouts.app')

@section('assets')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>

<script>
    $(document).ready(function () {
        const last_message = document.getElementById("last-message");
        last_message.scrollIntoView(false);
    })
</script>
@endsection

@section('content')
@php
    $profile = $user->profile;

    $initiator = $conv->initiator;
    $participant = $conv->participant;

    $other = $initiator;
    if ($user->id == $other->id) {
        $other = $participant;
    };

    $messages = $conv->messages_asc;
@endphp
<div class="container-fluid d-flex align-self-stretch">
    <div class="row flex-nowrap align-items-center">
        <div class="col-lg-3 d-lg-block d-none">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                <div class="card">
                    <img src="{{ fake()->imageUrl(1000, 1000, 'buddly.ca')}}" class="card-img-top" alt="...">
                        @if ($user->type == 100)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary fs-6 shadow">
                                {{ __('Buddly+') }}
                            </span>
                        @endif
                    </img>
                    <div class="card-body">
                        <div class="card-title row">
                            <h5 class="col">{{ $other->name_full }}</h5>
                            <x-user-demographic :birthdate="$other->profile->birthdate" :gender="$other->profile->gender"/>
                        </div>
                        <p class="card-text">{{ $other->profile->bio }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="d-flex flex-column flex-shrink-0 py-3 bg-light">
                <div class="container">
                    <div class="card">
                        <div class="card-body overflow-scroll perfect-scrollbar ps ps--active-y" data-mdb-perfect-scrollbar="true" style="position: relative; height: 800px">
                            @foreach ($messages as $index => $message)
                                @php
                                    $target = $message->created_at->setTimezone(new DateTimeZone("PST"));

                                    $now = new DateTime("now", new DateTimeZone("PST"));
                                    $time_elapsed = $now->diff($target);
                                @endphp
                                <div class="row mx-0">
                                    <div class="d-flex col-md-12 col-lg-10 col-xl-8 card px-0 mb-3 @if ($user->id == $message->author_id) @endif"
                                        @if ($index == (count($messages) - 1)) id="last-message" @endif
                                    >
                                        <div class="card-header d-flex justify-content-between p-3">
                                            <p class="fw-bold mb-0">{{ $message->author->name_full }}</p>
                                            <p class="text-muted small mb-0">
                                                <i class="far fa-clock"></i> 
                                                @if ($time_elapsed->days == false)
                                                    {{ $target->format("g:i A")}}
                                                @elseif ($time_elapsed->days == 1)
                                                    yesterday @ {{ $target->format("g:i A")}}
                                                @elseif ($time_elapsed->days < 7)
                                                    {{ $target->format("l") }}
                                                @elseif ($time_elapsed->days < 365)
                                                    {{ $target->format("M j") }}
                                                @else
                                                    {{ $target->format("M j, Y") }}
                                                @endif
                                            </p>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0">{{ $message->message }}</p>
                                        </div>
                                    </div>
                                    <div class="col @if ($user->id == $message->author_id)order-first @endif"></div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <form method="POST" action="{{ route('chat.new-message', ['conversation_id' => $conv->id]) }}">
                                @csrf

                                <div class="row align-items-center">
                                    <div class="col">
                                        <input type="hidden" name="author_id" value="{{ $user->id }}">
                                        <div class="form-group mb-0">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="fa fa-message"></span>
                                            </div>
                                            <input type="text" class="form-control" name="message" placeholder="Type a message">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-primary" type="submit">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection