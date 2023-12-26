import './bootstrap';

Echo.channel('JiliGamesStartChannel')
    .listen('.JiliGamesStartEvent', (e) => {
        // console.log(e);

        // predefine
        $("#customModel").addClass("d-none");

        // animation start
        let winraterandom = "";
        var rowno = "";
        if (e.winner == "board2") {
            winraterandom = Number((Math.random() * 4) + 1).toFixed(0);
            if (winraterandom == 1) {
                rowno = 9;
            } else if (winraterandom == 2) {
                rowno = 10;
            } else if (winraterandom == 3) {
                rowno = 12;
            } else if (winraterandom == 4) {
                rowno = 14;
            } else {
                rowno = 16;
            }
        } else {
            winraterandom = Number((Math.random() * 3) + 1).toFixed(0);
            if (e.winner == "board1") {
                if (winraterandom == 1) {
                    rowno = 1;
                } else if (winraterandom == 2) {
                    rowno = 3;
                } else if (winraterandom == 3) {
                    rowno = 5;
                } else {
                    rowno = 7;
                }
            } else if (e.winner == "board3") {
                if (winraterandom == 1) {
                    rowno = 2;
                } else if (winraterandom == 2) {
                    rowno = 4;
                } else if (winraterandom == 3) {
                    rowno = 6;
                } else {
                    rowno = 8;
                }
            } else {
                if (winraterandom == 1) {
                    rowno = 11;
                } else if (winraterandom == 2) {
                    rowno = 13;
                } else if (winraterandom == 3) {
                    rowno = 15;
                } else {
                    rowno = 17;
                }
            }
        }

        setTimeout(() => {
            // board animation
            $("#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board").css("filter", "grayscale(1)");
            $(`#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board.${e.winner}`).css("filter", "grayscale(0)");
            $(`#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board.${e.winner}`).addClass("active_mr");
            $(`#gamesWrapper .container_wrapper .gamingPart2 .spinnerWrapper .allPartWrapper .part:nth-child(${rowno})`).addClass('active');
            setTimeout(() => {
                $("#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board").css("filter", "grayscale(0)");
                $(`#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board.${e.winner}`).removeClass("active_mr");
                allPart.css('animation', "none");
                // created button & hit
                $("#winnerListShow").addClass("d-block");

                // amount
                GetAmount();

                $("#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board.active").removeClass("active");

                // row
                $(`#gamesWrapper .container_wrapper .gamingPart2 .spinnerWrapper .allPartWrapper .part:nth-child(${rowno})`).removeClass('active');

                setTimeout(() => {
                    $(".inputCoinsWrapper").html("");
                    $(`#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board .your span`).html("");
                    $(`#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board .all span`).html("");
                    $("#winnerListShow").removeClass("d-block");
                }, 3000);
            }, 3000);
        }, 5000);

        let allPart = $("#gamesWrapper .container_wrapper .gamingPart2 .spinnerWrapper .allPartWrapper");
        allPart.css('animation', `whole_${e.winner}_${winraterandom} 5s alternate forwards`);

        var x = setInterval(() => {
            const now = new Date();
            const bdTimeZone = 'Asia/Dhaka';
            const options = {
                timeZone: bdTimeZone,
            };
            const bdTimeInSeconds = Number(new Date(now.toLocaleString('en-US', options)).getTime() / 1000);
            let timeLeft = e.time - bdTimeInSeconds;

            // start game
            if (timeLeft < 20) {
                $("#clockWrapper").removeClass('d-none');
                $("#clockWrapper .title").html(timeLeft);
                $("#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board").attr('disabled', false);
            }

            // clear interval
            if (timeLeft < 1) {
                clearInterval(x);
            }

            // stop betting
            if (timeLeft < 2) {
                $("#clockWrapper").addClass('d-none');
                $("#gamesWrapper .container_wrapper .gamingPart3 .boardWrapper .board").attr('disabled', true);
            }

            console.log(timeLeft);
        }, 1000);
    });


// Winner Show
Echo.channel('JiliGameWinnerChannel')
    .listen('.JiliGameWinnerEvent', (e) => {
        let winner = e.winner;
        let btn = "";
        let win = "";
        if (winner == "board1") {
            btn = "win1";
            win = 3;
        } else if (winner == "board2") {
            btn = "win2";
            win = 3;
        } else if (winner == "board3") {
            btn = "win3";
            win = 3;
        } else {
            btn = "win4";
            win = 5;
        }
        setTimeout(() => {
            $("#WinnerResultHistory").prepend(`<div class="btn ${btn}">${win}X</div>`);
        }, 5000);

        const data = e.array;
        if (!data || data.length === 0) {
            const mapDataE = `<tr class="candidates-list">
                        <td class="title">
                            No one is win!
                        </td >
                    </tr >`;
            console.log(mapDataE);
            $("#letestWinnerShow").html(mapDataE);

        } else {
            const mapData = data.map((curE, i) => {
                var badge = "";
                if (i == 0) {
                    badge = `<p class="btn btn-warning">1st</p>`;
                }
                if (i == 1) {
                    badge = `<p class="btn btn-info">2nd</p>`;
                }
                if (i == 2) {
                    badge = `<p class="btn btn-danger">3rd</p>`;
                }

                return `
                    <tr class="candidates-list">
                        <td class="title">
                            <span>
                                <div class="thumb">
                                    <img class="img-fluid" src="${urls.url}/images/jili/users/${curE.img}" alt="" />
                                </div>
                                <div class="candidate-list-details">
                                    <div class="candidate-list-info">
                                        <div class="candidate-list-title">
                                            <h5 class="mb-0"><a>${curE.name}</a></h5>
                                        </div>
                                        <div class="candidate-list-option">
                                            <ul class="list-unstyled">
                                                <li>${curE.tranction_amount}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            ${badge}
                        </td >
                    </tr >
                `;
            });
            $("#letestWinnerShow").html(mapData);
        }

    });
