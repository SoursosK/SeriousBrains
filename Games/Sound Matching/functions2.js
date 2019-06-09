var level2 = getUserDifficulty();
var timeFunc2 = null;
var roundFunc2 = null;
var gameover2 = false;
var maxTime2 = 0;
var lives2 = 0;
var round2 = 0;
var result2 = null;
var answers2 = 0;
var starttimestamp2 = Math.round(+new Date()/1000); 

var sounds_original = ['Games/Sound Matching/airplane.mp3', 'Games/Sound Matching/bells.mp3', 'Games/Sound Matching/cat.mp3', 'Games/Sound Matching/cow.mp3', 'Games/Sound Matching/dog.mp3', 'Games/Sound Matching/duck.mp3', 'Games/Sound Matching/elephant.mp3', 'Games/Sound Matching/ferrari.mp3', 'Games/Sound Matching/guitar.mp3', 'Games/Sound Matching/horse.mp3', 'Games/Sound Matching/lion.mp3', 'Games/Sound Matching/parrot.mp3', 'Games/Sound Matching/piano.mp3', 'Games/Sound Matching/rooster.mp3', 'Games/Sound Matching/wolf.mp3'];
var images_original = ['Games/Sound Matching/airplane.jpg', 'Games/Sound Matching/bells.jpg', 'Games/Sound Matching/cat.jpg', 'Games/Sound Matching/cow.jpg', 'Games/Sound Matching/dog.jpg', 'Games/Sound Matching/duck.jpg', 'Games/Sound Matching/elephant.jpg', 'Games/Sound Matching/ferrari.jpg', 'Games/Sound Matching/guitar.jpg', 'Games/Sound Matching/horse.jpg', 'Games/Sound Matching/lion.jpg', 'Games/Sound Matching/parrot.jpg', 'Games/Sound Matching/piano.jpg', 'Games/Sound Matching/rooster.jpg', 'Games/Sound Matching/wolf.jpg'];

var options2 = [
    {
        level2: 1,
        rounds: 3,
        images: 6,
        points: 10
    },
    {
        level2: 2,
        rounds: 3,
        images: 9,
        points: 20
    },
    {
        level2: 3,
        rounds: 3,
        images: 12,
        points: 40
    },
    {
        level2: 4,
        rounds: 4,
        images: [6, 6, 9, 9],
        points: 60
    },
    {
        level2: 5,
        rounds: 6,
        images: [6, 6, 9, 9, 12, 12],
        points: 80
    }
];

var data2 = {
    sound: '',
    correctImage: '',
    selectedImages: []
}

function setupValues2() {
    // Select a index from 0 to sounds.length - 1
    var sounds = [];
    var images = [];

    // Make a copy of sounds array
    for (var i = 0; i < sounds_original.length; i++) {
        sounds.push(sounds_original[i]);
    }
    var idx = Math.floor(Math.random() * sounds.length);

    data2.sound = sounds.splice(idx, 1)[0];
    data2.correctImage = data2.sound.replace('.mp3', '.jpg');
    data2.selectedImages = [];

    // Make a copy of images array
    for (i = 0; i < images_original.length; i++) {
        images.push(images_original[i]);
    }

    // Add the correct image as first array element
    data2.selectedImages.push(data2.correctImage);

    // Remove the correct image from available images
    for (i = 0; i < images.length; i++) {
        if (images[i] == data2.correctImage)
            images.splice(i, 1);
    }

    // Choose random images from the available images array
    var imgnumber = 0;
    if (level2 > 3)
        imgnumber = options2[level2 - 1].images[round2];
    else
        imgnumber = options2[level2 - 1].images;
    console.log(imgnumber);
    while (data2.selectedImages.length < imgnumber) {
        idx = Math.floor(Math.random() * images.length);
        data2.selectedImages.push(images[idx]);
        images.splice(idx, 1);
    }
    console.log(data2.sound + ' ' + data2.selectedImages.length);
}

function counter2() {
    maxTime2 -= 10;
    $('.counter').html(Math.round(maxTime2 / 1000));
    // Check if the game is over
    //	console.log(maxTime2 + ' ' + lives2 + ' ' + round2 + ' ' + options2[level2-1].rounds);
    gameover2 = maxTime2 <= 0 || lives2 == 0 || round2 == options2[level2 - 1].rounds;
    if (gameover2) {
        result2 = maxTime2 && lives2;
        clearInterval(roundFunc2);
        clearInterval(timeFunc2);
        displayResults2();
    }
}

function displayResults2() {
    $('.stage > div').html('');
    var container = (result2 ? '.success' : '.failed');
    $(container).find('.time').html(Math.round(maxTime2 / 1000));
    var points = options2[level2 - 1].points;
    //	points = points * (1 - (30000 - maxTime2) / 30000);
    points = points * maxTime2 / 30000;
    $(container).find('.points').html(points);
    $(container).find('.answers2').html(answers2);
    $(container).show();

    if (level < 4)
        postGameStats(3, nswers2, 3 - lives2, 0, points, answers2 / 3, (30000 - maxTime2) / 3, 30000 - maxTime2, starttimestamp2, Math.round(+new Date()/1000) );
    else if (level < 5)
        postGameStats(3, answers2, 3 - lives2, 0, points, answers2 / 3, (30000 - maxTime2) / 4, 30000 - maxTime2, starttimestamp2, Math.round(+new Date()/1000) );
    else
        postGameStats(3, answers2, 3 - lives2, 0, points, answers2 / 3, (30000 - maxTime2) / 6, 30000 - maxTime2, starttimestamp2, Math.round(+new Date()/1000) );
}

function playRound2(r) {
    var idx;
    setupValues2();
    new Audio(data2.sound).play();

    while (data2.selectedImages.length) {
        idx = Math.floor(Math.random() * data2.selectedImages.length);
        $('.photos').append('<img class="photo" src="' + data2.selectedImages[idx] + '" />');
        data2.selectedImages.splice(idx, 1);
    }
    $('.photos img').click(function (e) {
        var imgName = $(e.target).attr('src');
        if (data2.sound == imgName.replace('jpg', 'mp3')) {
            // success
            answers2++
        } else {
            lives2--;
        }
        round2++;
        init2(round2);

    });
}

function init2(r) {

    $('.form').html('<button onclick="stop()">Stop</button>');
    $('.stage > div').html('');
    $('.success, .failed').hide();

    if (r == -1) {
        round2 = 0;
        lives2 = 3;
        maxTime2 = 30000;
        result2 = null;
        answers2 = 0;
        timeFunc2 = setInterval('counter2()', 10);
    }
    roundFunc2 = setTimeout('playRound2(' + round2 + ')', 15);
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

