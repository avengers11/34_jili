<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JILI-GAMES</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/js/bootstrap.min.js" integrity="sha512-8qmis31OQi6hIRgvkht0s6mCOittjMa9GMqtK9hes5iEQBQE/Ca6yGE5FsW36vyipGoWQswBj/QBm2JR086Rkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('style\jili\style.css') }}">

    @if (env('MR_ENV') == "local")
        @vite(['resources\js\JiliGames.js'])
    @else
        <script src="{{ asset('build\assets\app-db2cfa5d.js') }}"></script>
    @endif


</head>
<body>

<div id="gamesWrapper">
    <div class="container container_wrapper">

        <!--
            =================
            gamingPart1 Start
            ==================
        -->
        <div class="gamingPart1">
            <div class="iconsWrapper">
                <i class="btn btn-success fa-solid fa-bars"></i>
                <i class="d-none btn btn-danger fa-solid fa-xmark"></i>
                <span class="menuBarWrapper d-none">
                    <i data-toggle="modal" data-target="#allUserShow" class="btn title btn-primary fa-solid fa-users"></i>
                    <i data-toggle="modal" data-target="#soundSettingShow" class="btn title btn-primary fa-solid fa-music"></i>
                    <i data-toggle="modal" data-target="#WnningResultShow" class="btn title btn-primary fa-solid fa-square-poll-vertical"></i>
                    {{-- <i class="btn title btn-primary fa-solid fa-circle-info"></i> --}}
                </span>
            </div>
        </div>


        <!--
            =================
            gamingPart2 Start
            ==================
        -->
        <div class="gamingPart2">
            <div class="spinnerWrapper">
                <img class="mainFram" src="{{ asset('images/jili/circle_outer.png') }}" alt="">
                <img class="mainFramUnder" src="{{ asset('images/jili/circle_middle.png') }}" alt="">
                <img class="indicator" src="{{ asset('images\jili\indicator.png') }}" alt="">
                <div class="allPartWrapper">
                    <span class="win1 part" style="--i:1;"><span class="number">3x</span></span>
                    <span class="win3 part" style="--i:2;"><span class="number">3x</span></span>
                    <span class="win1 part" style="--i:3;"><span class="number">3x</span></span>
                    <span class="win3 part" style="--i:4;"><span class="number">3x</span></span>

                    <span class="win1 part" style="--i:5;"><span class="number">3x</span></span>
                    <span class="win3 part" style="--i:6;"><span class="number">3x</span></span>
                    <span class="win1 part" style="--i:7;"><span class="number">3x</span></span>
                    <span class="win3 part" style="--i:8;"><span class="number">3x</span></span>

                    <span class="win2 part" style="--i:9;"><span class="number">3x</span></span>
                    <span class="win2 part" style="--i:10;"><span class="number">3x</span></span>
                    <span class="win4 part" style="--i:11;"><span class="number">5x</span></span>
                    <span class="win2 part" style="--i:12;"><span class="number">3x</span></span>

                    <span class="win4 part" style="--i:13;"><span class="number">5x</span></span>
                    <span class="win2 part" style="--i:14;"><span class="number">3x</span></span>
                    <span class="win4 part" style="--i:15;"><span class="number">5x</span></span>
                    <span class="win2 part" style="--i:16;"><span class="number">3x</span></span>

                    <span class="win4 part" style="--i:17;"><span class="number">5x</span></span>
                </div>
            </div>
        </div>


        <!--
            =================
            gamingPart3 Start
            ==================
        -->
            <div class="gamingPart3">

                <div id="clockWrapper" class="d-none">
                    <h2 class="title">0</h2>
                    <img class="clock" src="{{ asset('images/jili/clock.png') }}" alt="">
                </div>

                <div class="boardWrapper">
                    <button disabled class="board board1">
                        <input type="hidden" value="board1" />
                        <p class="title all">All : <span>00</span></p>
                        <img src="{{ asset('images\jili\win1_board.png') }}" alt="">
                        <p class="title your">YOUR : <span>00</span></p>
                        <div class="inputCoinsWrapper">

                        </div>
                    </button>
                    <button disabled class="board board2">
                        <input type="hidden" value="board2" />
                        <p class="title all">All : <span>00</span></p>
                        <img src="{{ asset('images\jili\win2_board.png') }}" alt="">
                        <p class="title your">YOUR : <span>00</span></p>
                        <div class="inputCoinsWrapper">

                        </div>
                    </button>
                    <button disabled class="board board3">
                        <input type="hidden" value="board3" />
                        <p class="title all">All : <span>00</span></p>
                        <img src="{{ asset('images\jili\win3_board.png') }}" alt="">
                        <p class="title your">YOUR : <span>00</span></p>
                        <div class="inputCoinsWrapper">

                        </div>
                    </button>
                    <button disabled class="board board4">
                        <input type="hidden" value="board4" />
                        <p class="title all">All : <span>00</span></p>
                        <img src="{{ asset('images\jili\win4_board.png') }}" alt="">
                        <p class="title your">YOUR : <span>00</span></p>
                        <div class="inputCoinsWrapper">

                        </div>
                    </button>
                </div>

                <div class="coinsWrapper">
                    <div class="left">
                        <img class="users" src="{{ asset('images/jili/users/'.$vudoolive->img) }}" alt="" />
                        <div class="amount">
                            <img src="{{ asset('images\jili\coins.png') }}" alt="">
                            <input type="text" id="games_amount" value="{{ $vudoolive->amount }}" disabled />
                        </div>
                    </div>

                    <div class="right">
                        <div class="coinWrapper active">
                            <img src="{{ asset('images\jili\coin1.png') }}" alt="">
                            {{-- <p>100</p> --}}
                            <input type="hidden" value="100">
                            <span id="coinAnimationWrapper">
                                <div class="coinWrapperCircle">
                                    <i style="--i:1" class="fa-solid fa-caret-left"></i>
                                    <i style="--i:2" class="fa-solid fa-caret-left"></i>
                                    <i style="--i:3" class="fa-solid fa-caret-left"></i>
                                    <i style="--i:4" class="fa-solid fa-caret-left"></i>
                                    <i style="--i:5" class="fa-solid fa-caret-left"></i>
                                </div>
                            </span>
                        </div>

                        <div class="coinWrapper">
                            <img src="{{ asset('images\jili\coin2.png') }}" alt="">
                            {{-- <p>500</p> --}}
                            <input type="hidden" value="500">
                            <span id="coinAnimationWrapper">

                            </span>
                        </div>

                        <div class="coinWrapper">
                            <img src="{{ asset('images\jili\coin3.png') }}" alt="">
                            {{-- <p>1K</p> --}}
                            <input type="hidden" value="1000">
                            <span id="coinAnimationWrapper">

                            </span>
                        </div>

                        <div class="coinWrapper">
                            <img src="{{ asset('images\jili\coin4.png') }}" alt="">
                            {{-- <p>10K</p> --}}
                            <input type="hidden" value="10000">
                            <span id="coinAnimationWrapper">

                            </span>
                        </div>

                        <div class="coinWrapper">
                            <img src="{{ asset('images\jili\coin5.png') }}" alt="">
                            {{-- <p>100K</p> --}}
                            <input type="hidden" value="100000">
                            <span id="coinAnimationWrapper">

                            </span>
                        </div>
                    </div>
                </div>

            </div>

    </div>
</div>

<!--
|=====================|
|HIDDEN ALL MODEL HERE|
|=====================|
-->
<input type="hidden" id="id" value="{{ $csrf }}">

{{-- preloader  --}}
<div class="LoaddingWrapper">
    <img src="{{ asset('images/logo/preloader.png') }}" alt="" />
    <div class="progress">
        <div class="progress-bar"></div>
    </div>
</div>

{{-- custom model  --}}
{{-- <div id="customModel" class="customModel d-none">
    <div class="container">
        <h2 class="notice">Start Bet</h2>
    </div>
</div> --}}

{{-- custom model  --}}
<div id="customModel" class="d-none customModel">
    <div class="container">
        <h2 class="notice"></h2>
    </div>
</div>

{{-- custom model  --}}
<div id="preloader" class="d-none customModel">
    <div class="container">
        <h2 class="notice"></h2>
    </div>
</div>

{{-- WnningResultShow --}}
<div class="modal fade" id="WnningResultShow" tabindex="-1" role="dialog" aria-labelledby="WnningResultShowTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">GAME RESULTS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="WinnerResult" id="WinnerResultHistory">
                    {{-- <div class="btn win1">3X</div>
                    <div class="btn win2">3X</div>
                    <div class="btn win3">3X</div>
                    <div class="btn win4">5X</div> --}}
                </div>

            </div>
        </div>
    </div>
</div>

{{-- winnerListShow --}}
<div class="modal" id="winnerListShow" tabindex="-1" role="dialog" aria-labelledby="winnerListShowTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div style="box-shadow: 5px 5px 5px 100vh #0000007d;" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">WINNER LIST</h5>
            </div>
            <div class="modal-body">

                <table class="table manage-candidates-top card">
                    <tbody id="letestWinnerShow">

                        <!---
                        <tr class="candidates-list">
                            <td class="title">
                                <span>
                                    <div class="thumb">
                                        <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" />
                                    </div>
                                    <div class="candidate-list-details">
                                        <div class="candidate-list-info">
                                            <div class="candidate-list-title">
                                                <h5 class="mb-0"><a href="#">Brooke Kelly</a></h5>
                                            </div>
                                            <div class="candidate-list-option">
                                                <ul class="list-unstyled">
                                                    <li>10 Flowing</li>
                                                    <li>100000 Coin</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <p class="btn btn-warning">1st</p>
                            </td>
                        </tr>

                        <tr class="candidates-list">
                            <td class="title">
                                <span>
                                    <div class="thumb">
                                        <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" />
                                    </div>
                                    <div class="candidate-list-details">
                                        <div class="candidate-list-info">
                                            <div class="candidate-list-title">
                                                <h5 class="mb-0"><a href="#">Brooke Kelly</a></h5>
                                            </div>
                                            <div class="candidate-list-option">
                                                <ul class="list-unstyled">
                                                    <li>10 Flowing</li>
                                                    <li>100000 Coin</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <p class="btn btn-info">2nd</p>
                            </td>
                        </tr>

                        <tr class="candidates-list">
                            <td class="title">
                                <span>
                                    <div class="thumb">
                                        <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" />
                                    </div>
                                    <div class="candidate-list-details">
                                        <div class="candidate-list-info">
                                            <div class="candidate-list-title">
                                                <h5 class="mb-0"><a href="#">Brooke Kelly</a></h5>
                                            </div>
                                            <div class="candidate-list-option">
                                                <ul class="list-unstyled">
                                                    <li>10 Flowing</li>
                                                    <li>100000 Coin</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <p class="btn btn-danger">3rd</p>
                            </td>
                        </tr>

                        <tr class="candidates-list">
                            <td class="title">
                                <span>
                                    <div class="thumb">
                                        <img class="img-fluid" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" />
                                    </div>
                                    <div class="candidate-list-details">
                                        <div class="candidate-list-info">
                                            <div class="candidate-list-title">
                                                <h5 class="mb-0"><a href="#">Brooke Kelly</a></h5>
                                            </div>
                                            <div class="candidate-list-option">
                                                <ul class="list-unstyled">
                                                    <li>10 Flowing</li>
                                                    <li>100000 Coin</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                {{-- <p class="btn btn-warning"></p> --}}
                            </td>
                        </tr>
                        -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- allUserShow --}}
<div class="modal fade" id="allUserShow" tabindex="-1" role="dialog" aria-labelledby="allUserShowTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span></span>
                <h5 class="modal-title">ACTIVE USERS LIST</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="table manage-candidates-top card" id="allUsersShowTable">
                </div>

            </div>
        </div>
    </div>
</div>

{{-- soundSettingShow --}}
<div class="modal fade" id="soundSettingShow" tabindex="-1" role="dialog" aria-labelledby="soundSettingShowTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">SOUND SETTINGS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label class="mb-0" for="soundEffect">Sound Effect</label>
                <input type="range" name="" min="0" max="100" id="soundEffect" value="50" style="width: 100%">
                <br>
                <br>
                <label class="mb-0" for="soundBackground">Background Sound</label>
                <input type="range" name="" min="0" max="100" id="soundBackground" value="50" style="width: 100%">
            </div>
        </div>
    </div>
</div>

<!-- script -->
<script src="https://cdn.socket.io/4.5.4/socket.io.min.js" integrity="sha384-/KNQL8Nu5gCHLqwqfQjA689Hhoqgi2S84SNUxC3roTe4EhJ9AfLkp8QiQcU8AMzI" crossorigin="anonymous"></script>



<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    const urls = {
        "url" : '{{ url('/') }}',
        "BetInsert" : "{{ route('BetInsert') }}",
        "StartGame" : "{{ route('StartGame') }}",
        "AmountShow" : "{{ route('AmountShow') }}",
        "BetHistory" : "{{ route('BetHistory') }}",
        "socket" : "https://run2.masudrana.top/sent_message",
    };
    const mydata = {
        "id": $("#id").val(),
        "flower": $("#id").val(),
        "amount": '{{ $vudoolive->amount }}',
        "name": '{{ $vudoolive->name }}',
        "img": '{{ asset('images/jili/users/'.$vudoolive->img) }}',
    }
</script>
<script src="{{ asset('script\jili\main.js') }}"></script>

</body>
</html>
