var level = getUserDifficulty();
var timeFunc = null;
var roundFunc = null;
var gameover = false;
var maxTime = 0;
var lives = 0;
var round = 0;
var result = null;
var answers = 0;
var starttimestamp = Math.round(+new Date()/1000);

var game = {

    data: [
        {
            folder: 'Fruit',
            choices: ['apple.jpg', 'banana.jpg', 'cherry.jpg', 'strawberry.jpg', 'orange.jpg']
        },
        {
            folder: 'Animals',
            choices: ['cat.jpg', 'dog.jpg', 'rooster.jpg', 'horse.jpg', 'cow.jpg']
        },
        {
            folder: 'Transportation',
            choices: ['bike.jpg', 'bus.jpg', 'car.jpg', 'motorcycle.jpg', 'train.jpg']
        }
    ],

    wrong: [

        ['guitar.jpg', 'bells.jpg', 'elephant.jpg'],

        ['ice-cream.jpg', 'fish.jpg', 'airplane.jpg'],

        ['carrot.jpg', 'elephant.jpg', 'ferrari.jpg']
    ]

}

var options = [
    {
        level: 1,
        rounds: 3,
        stages: 0,
        points: 10
    },
    {
        level: 2,
        rounds: 3,
        stages: 1,
        points: 20
    },
    {
        level: 3,
        rounds: 3,
        stages: 2,
        points: 40
    },
    {
        level: 4,
        rounds: 4,
        stages: [0, 0, 1, 1],
        points: 60
    },
    {
        level: 5,
        rounds: 6,
        stages: [0, 0, 1, 1, 2, 2],
        points: 80
    }
];

var data = {
    correctImage: '',
    selectedImages: []
}
var difficulty = 0;

function setupValues() {

    var images = [];
    var idx;

    if (level > 3)
        difficulty = options[level - 1].stages[round];
    else
        difficulty = options[level - 1].stages;

    data.correctImage = game.wrong[difficulty][round % 3];
    images.push(data.correctImage);


    // Make a copy of images array
    images = images.concat(game.data[round % 3].choices);

    while (data.selectedImages.length < 6) {
        idx = Math.floor(Math.random() * images.length);
        data.selectedImages.push(images[idx]);
        images.splice(idx, 1);
    }

    console.log(data.selectedImages);
}

function counter() {
    maxTime -= 10;
    $('.counter').html(Math.round(maxTime / 1000));
    // Check if the game is over
    //	console.log(maxTime + ' ' + lives + ' ' + round + ' ' + options[level-1].rounds);
    gameover = maxTime <= 0 || lives == 0 || round == options[level - 1].rounds;
    if (gameover) {
        result = maxTime && lives;
        clearInterval(roundFunc);
        clearInterval(timeFunc);
        displayResults();
    }
}

function displayResults() {
    $('.stage > div').html('');
    var container = (result ? '.success' : '.failed');
    $(container).find('.time').html(Math.round(maxTime / 1000));
    var points = options[level - 1].points;
    //	points = points * (1 - (30000 - maxTime) / 30000);
    points = points * maxTime / 15000;
    $(container).find('.points').html(points);
    $(container).find('.answers').html(answers);
    $(container).show();

    if (level < 4)
        postGameStats(1, answers, 3 - lives, 0, points, answers / 3, (15000 - maxTime) / 3, 15000 - maxTime, starttimestamp, Math.round(+new Date()/1000) );
    else if (level < 5)
        postGameStats(1, answers, 3 - lives, 0, points, answers / 3, (15000 - maxTime) / 4, 15000 - maxTime, starttimestamp, Math.round(+new Date()/1000) );
    else
        postGameStats(1, answers, 3 - lives, 0, points, answers / 3, (15000 - maxTime) / 6, 15000 - maxTime, starttimestamp, Math.round(+new Date()/1000) );
}

function playRound(r) {
    var idx;
    setupValues();


    while (data.selectedImages.length) {
        idx = Math.floor(Math.random() * data.selectedImages.length);
        $('.Photos').append('<img class="photo" src="Games/Find the Odd One Out/Photos\\' + game.data[r % 3].folder + '\\' +
            data.selectedImages[idx] + '" />');
        data.selectedImages.splice(idx, 1);

    }
    $('.Photos img').click(function (e) {
        var imgName = $(e.target).attr('src').split('\\').reverse()[0];
        console.log(imgName + ' ' + game.wrong[difficulty][r % 3]);
        if (game.wrong[difficulty][r % 3] == imgName) {
            // success
            answers++
        } else {
            lives--;
        }
        round++;
        init(round);

    });
}

function init(r) {

    $('.form').html('<button onclick="stop()">Stop</button>');
    $('.stage > div').html('');
    $('.success, .failed').hide();

    if (r == -1) {
        round = 0;
        lives = 3;
        maxTime = 15000;
        result = null;
        answers = 0;
        timeFunc = setInterval('counter()', 10);
    }
    roundFunc = setTimeout('playRound(' + round + ')', 15);
}

//window.addEventListener('load', init());


function getUserDifficulty() {
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "getUserDifficulty.php", false);
    xhttp.send();
    if (xhttp.readyState == 4 && xhttp.status == 200) {
        return xhttp.responseText;
    }
}

function postGameStats(hit, miss, quit, score, accuracy, avgspeed, playtime, starttimestamp, endtimestamp) {
    var xhttp = new XMLHttpRequest();

    //console.log(hit, miss, quit, score, accuracy, avgspeed, playtime, starttimestamp, endtimestamp);

    // xhttp.onreadystatechange = function () {
    //     if (this.readyState == 4 && this.status == 200) {
    //         console.log(this.responseText);
            
    //     }
    // };

    xhttp.open("POST", "postGameStats.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("gameid=" + "3" + "&hit=" + hit + "&miss=" + miss + "&quit=" + quit + "&score=" + score + "&accuracy=" + accuracy + "&avgspeed=" + avgspeed + "&playtime=" + playtime + "&starttimestamp=" + starttimestamp + "&endtimestamp=" + endtimestamp);
}
