@extends('layouts.app')

@section('assets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tag-it/2.0/css/jquery.tagit.css" integrity="sha512-AnT6wBVAnNBZ5ziYQxj+qbWaqUgrX12U8TE4p805hOHrdxm9t9ujv1dTXk1fmVDsectw75iK5Cdfo4UgWMYHpQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script> --}}
<script src="{{ asset('assets/js/jquery-ui.min.js') }}" type="text/javascript" charset="utf-8"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tag-it/2.0/js/tag-it.js" integrity="sha512-cAoWDoS3Z0g6xaQ+SngQIW6YFBxXvRmfRlmJljQ8BmfnhfNuy+ZD0+bpAU2maZxLbcNMM00giRM59OdG/XsN0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="module">
    $(function(){
        var sampleTags = ['c++', 'java', 'php', 'coldfusion', 'javascript', 'asp', 'ruby', 'python', 'c', 'scala', 'groovy', 'haskell', 'perl', 'erlang', 'apl', 'cobol', 'go', 'lua'];

        var tags_interests = $("#interests");
        $('#interests').tagit({
            placeholderText: "None Specified",
            availableTags: sampleTags
        });
    });
</script>

<script defer>
    function expand_input(obj){
        if (!obj.savesize) {
            obj.savesize = obj.size;
        }

        obj.size = Math.max(obj.savesize, obj.value.length);
    }

    $('li.tagit-new input').each(function() {
        $(this).attr("onkeyup", "expand_input(this);");
    });

    $(function () {
        $("[rel='tooltip']").tooltip();
    })
</script>

<style>
    ul.tagit {
        margin-left: 0;
    }

    ul.tagit input { 
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

    .img-frame {
        width: 100px;
        height: 100px;
        vertical-align: middle;
        text-align: center;
        display: table-cell;
    }

    img.user-card {
        height: 100%;

        object-fit: cover;
    }
</style>

@endsection

@section('content')
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-md-3">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                    <span class="fs-4">Search Filters</span>
                </a>
                <hr>
                <div class="container content px-4">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <label class="col ps-2" for="in_interests">Interests</label>
                            </div>
                            <div class="row content">
                                <form>
                                    <ul id="interests" class="tagit ui-widget ui-widget-content ui-corner-all form-control"></ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <hr> --}}
                {{-- <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>mdo</strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div> --}}
            </div>
        </div>
        <div class="col-6">
            <div class="d-flex flex-column flex-shrink-0 py-3 bg-light">
                <div class="row">
                    <div class="col">
                        @foreach ($db_users as $user)
                            @if (is_null($user->email_verified_at))
                                @continue
                            @endif

                            @php
                                $profile = $user->profile;
                            @endphp
                            @if (is_null($profile))
                                @continue
                            @endif
                            
                            @php
                                $interests = $user->interests;
                            @endphp
                            <x-user-card :user="$user" :profile="$profile" :interests="$interests"/>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                <div class="row bg-black">
                    <div class="col-auto"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection