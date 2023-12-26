const socket = io(urls.socket);

// Menu
$("#gamesWrapper .container .gamingPart1 .iconsWrapper i.btn.btn-success.fa-solid.fa-bars").click(function () {
    $(this).addClass('d-none');
    $("#gamesWrapper .container .gamingPart1 .iconsWrapper i.d-none.btn.btn-danger.fa-solid.fa-xmark").removeClass('d-none');
    $("#gamesWrapper .container .gamingPart1 .iconsWrapper .menuBarWrapper").removeClass('d-none');
});
$("#gamesWrapper .container .gamingPart1 .iconsWrapper i.d-none.btn.btn-danger.fa-solid.fa-xmark").click(function () {
    $(this).addClass('d-none');
    $("#gamesWrapper .container .gamingPart1 .iconsWrapper i.btn.btn-success.fa-solid.fa-bars").removeClass('d-none');
    $("#gamesWrapper .container .gamingPart1 .iconsWrapper .menuBarWrapper").addClass('d-none');
});

// Click In coins
var coins = $("#gamesWrapper .container_wrapper .gamingPart3 .coinsWrapper .right .coinWrapper");
coins.click(function () {
    coins.removeClass('active');
    $(this).addClass('active');

    coins.find('#coinAnimationWrapper').html("");
    $(this).find('#coinAnimationWrapper').html(
        `
        <div class="coinWrapperCircle">
            <i style="--i:1" class="fa-solid fa-caret-left"></i>
            <i style="--i:2" class="fa-solid fa-caret-left"></i>
            <i style="--i:3" class="fa-solid fa-caret-left"></i>
            <i style="--i:4" class="fa-solid fa-caret-left"></i>
            <i style="--i:5" class="fa-solid fa-caret-left"></i>
        </div>
        `
    );
});

// Bet Insert
let board = $("#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board");
board.click(function () {
    let board_name = $(this).children('input').val();
    board.attr('disabled', true);

    // check borad active
    $(this).addClass("active");
    let boardActive = $("#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board.active");
    if (boardActive.length > 3) {
        $(this).removeClass("active");
        $("#customModel").removeClass("d-none");
        $("#customModel .notice").html("You can't select 4 board at a time!");
        setTimeout(() => {
            $("#customModel").addClass("d-none");
            board.attr('disabled', false);
        }, 1500);
        return false;
    }

    let amount = $('#gamesWrapper .container_wrapper .gamingPart3 .coinsWrapper .right .coinWrapper.active').children('input').val();

    // Amount With Coins
    var coin = "";
    if (amount == 100) {
        coin = "coin1";
    } else if (amount == 500) {
        coin = "coin2";
    } else if (amount == 1000) {
        coin = "coin3";
    } else if (amount == 10000) {
        coin = "coin4";
    } else {
        coin = "coin5";
    }
    // Button animation
    let id = new Date().getTime();
    let top = Number((Math.random() * 27) + 25).toFixed(0);
    let left = Number((Math.random() * 65) + 3).toFixed(0);
    const coins_data = {
        amount,
        "emenets": board_name,
        "id": id + 1,
        top,
        left,
        "img": `<img id="${id + 1}" class="users" src="${urls.url}/images/jili/${coin}.png" alt="" />`
    };

    $.ajax({
        "url": urls.BetInsert,
        "method": "POST",
        "data": {
            "user_id": $('#id').val(),
            "amount": amount,
            "winner": $(this).children('input').val(),
        },
        success: function (data) {
            if (data.st == true) {

                let img = `<img id="${id}" class="${coin}" src="${urls.url}/images/jili/${coin}.png" alt="" />`;
                $(`#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board.${board_name} .inputCoinsWrapper`).append(img);

                let my_bet = $(`#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board.${board_name} .your span`);
                my_bet.html(Number(my_bet.html()) + Number(amount));

                let all_bet = $(`#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board.${board_name} .all span`);
                all_bet.html(Number(all_bet.html()) + Number(amount));

                $(`#${id}`).animate({
                    "top": top + "%",
                    "left": left + "%"
                }, { duration: 200 });

                // amount
                $("#games_amount").val(Number($("#games_amount").val()) - amount);

                // send node server
                socket.emit('coin_input', coins_data);

                // disabled
                board.attr('disabled', false);
            } else {
                $("#customModel").removeClass("d-none");
                $("#customModel .notice").html(data.msg);
                setTimeout(() => {
                    $("#customModel").addClass("d-none");
                    board.attr('disabled', true);
                }, 2000);
            }

            if (Number($("#clockWrapper .title").html()) < 2) {
                board.attr('disabled', true);
            }
        }
    })
});
socket.on("coin_output", function (data) {
    console.log(data);
    $(`#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board.${data["emenets"]} .inputCoinsWrapper`).append(data['img']);

    let my_bet = $(`#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board.${data["emenets"]} .all span`);
    my_bet.html(Number(my_bet.html()) + Number(data['amount']));

    $(`#${data['id']}`).animate({
        "top": data['top'] + "%",
        "left": data['left'] + "%"
    }, { duration: 200 });
});

// Get Amount
const GetAmount = () => {
    $.ajax({
        "url": urls.AmountShow,
        "method": "POST",
        "data": {
            "id": $("#id").val()
        },
        success: function (data) {
            $("#games_amount").val(Number(data.amount));
        }
    })
}

// all Icons
var AllIcons = $("#gamesWrapper .container_wrapper .gamingPart1 .iconsWrapper .menuBarWrapper i");
// open all users history
AllIcons.eq(0).on('click', function () {
});

// Active Users List
const UserData = mydata;
socket.on('connect', () => {
    socket.emit("UserData", UserData);
});

socket.on('UpdateUserData', (data) => {
    const sortedData = data.sort((a, b) => b.amount - a.amount);
    const mapData = sortedData.map((curE) => {
        return `
            <div class="candidates-list">
                <div class="thumb">
                    <img class="img-fluid" src="${curE.img}" alt="" />
                </div>
                <div class="candidate-list-details">
                    <div class="candidate-list-info">
                        <div class="candidate-list-title">
                            <h5 class="mb-0"><a>${curE.name}</a></h5>
                        </div>
                        <div class="candidate-list-option">
                            <ul class="list-unstyled">
                                <li><i class="fa-solid fa-heart mr-2"></i>${curE.flower} Flowing</li>
                                <li><i class="fa-solid fa-coins mr-2"></i>${curE.amount} Coin</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            `
    })
    $("#allUsersShowTable").html(mapData);
});

// Start Games
$(document).ready(function () {
    winnerBetHistory();
    $.ajax({
        "url": urls.StartGame,
        "method": "POST",
        success: function (data) {
            // console.log(data.data);
            const DatabaseData = data.data;

            var x = setInterval(() => {
                const now = new Date();
                const bdTimeZone = 'Asia/Dhaka';
                const options = {
                    timeZone: bdTimeZone,
                };
                const bdTimeInSeconds = Number(new Date(now.toLocaleString('en-US', options)).getTime() / 1000);
                let timeLeft = DatabaseData.board_id - bdTimeInSeconds;

                // DatabaseData
                if (timeLeft < -10) {
                    $("#preloader").removeClass("d-none");
                    $("#preloader .notice").html("Game is under maintenance!");
                }

                if (timeLeft > 20) {
                    $("#preloader").removeClass("d-none");
                    $("#preloader .notice").html("Connecting with next round...");
                }

                // start game
                if (timeLeft < 20) {
                    $("#preloader").addClass("d-none");
                    $("#clockWrapper").removeClass('d-none');
                    $("#clockWrapper .title").html(timeLeft);
                    $("#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board").attr('disabled', false);
                }

                // clear interval
                if (timeLeft < 1) {
                    $("#clockWrapper").addClass('d-none');
                    clearInterval(x);
                }

                // stop betting
                if (timeLeft < 2) {
                    $("#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board").attr('disabled', true);
                }
                console.log(timeLeft);
            }, 1000);

        }
    })
});

// winner bet history
const winnerBetHistory = () => {
    $.ajax({
        "url": urls.BetHistory,
        "method": "POST",
        success: function (data) {
            const dataMap = data.data;
            console.log(dataMap);
            const mapHtmlData = dataMap.map((curE) => {
                let btn = "";
                let win = "";
                if (curE.winner == "board1") {
                    btn = "win1";
                    win = 3;
                } else if (curE.winner == "board2") {
                    btn = "win2";
                    win = 3;
                } else if (curE.winner == "board3") {
                    btn = "win3";
                    win = 3;
                } else {
                    btn = "win4";
                    win = 5;
                }
                return `
                    <div class="btn ${btn}">${win}X</div>
                `
            });
            $("#WinnerResultHistory").html(mapHtmlData);
        }
    })
}

// preloader
window.addEventListener("load", function () {
    const images = document.querySelectorAll("img");
    let loadedImages = 0;
    function updateLoader() {
        loadedImages++;
        const loadedPercentage = Math.floor((loadedImages / images.length) * 100);
        $(".LoaddingWrapper .progress .progress-bar").css("width", loadedPercentage + "%");
        if (loadedImages >= images.length) {
            $(".LoaddingWrapper").slideUp();
        }
    }

    setTimeout(() => {
        images.forEach((image) => {
            image.addEventListener("load", updateLoader());
        });
    }, 1000);
});

// Function to log the current scroll height
function logScrollHeight() {
    const documentScrollHeight = $(document).height();
    console.log(documentScrollHeight);
    // resize
    if (documentScrollHeight < 500) {
        $('.gamingPart2').css("transform", "translateY(0vh)");
    } else {
        $('.gamingPart2').css("transform", "translateY(30vh)");
    }
}

$(window).resize(function () {
    logScrollHeight();
});

// Initial log of scroll height when the page loads
$(document).ready(function () {
    logScrollHeight();
});
