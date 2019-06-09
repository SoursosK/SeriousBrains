function map1() {
    // Maze game created by ProgramFOX; http://www.codeproject.com/Members/ProgramFOX
    // Licensed under CPOL: http://www.codeproject.com/info/cpol10.aspx

    // mazeWidth -70, mazeHeight -50 RECTANGLE
    // 542 (center X), 122 (center Y) CIRCLE
    var starttimestamp2 = Math.round(+new Date() / 1000);
    var canvas = document.getElementById("mazecanvas");
    var context = canvas.getContext("2d");
    var currRectX = mazeWidth - 70;
    var currRectY = mazeHeight - 50;
    var mazeWidth = 556;
    var mazeHeight = 556;
    var intervalVar;
    var maxRound = 2;
    var minutes;
    var secondsToShow;
    var r;
    function drawMazeAndRectangle(rectX, rectY, r) {
        makeWhite(0, 0, canvas.width, canvas.height);
        var mazeImg = new Image();
        mazeImg.onload = function () {
            context.drawImage(mazeImg, 0, 0);
            drawRectangle(rectX, rectY, "#0000FF");
            context.beginPath();
            if (r == 1) {
                context.arc(45, mazeHeight - 60, 7, 0, 2 * Math.PI, false);
            }
            else {
                context.arc(45, mazeHeight / 2 + 60, 7, 0, 2 * Math.PI, false);
            }

            context.closePath();
            context.fillStyle = '#00FF00';
            context.fill();
        };
        mazeImg.src = "Games/Maze/maze1." + r + ".gif";
    }
    function drawRectangle(x, y, style) {
        makeWhite(currRectX, currRectY, 15, 15);
        currRectX = x;
        currRectY = y;
        context.beginPath();
        context.rect(x, y, 15, 15);
        context.closePath();
        context.fillStyle = style;
        context.fill();
    }
    function moveRect(e) {
        var newX;
        var newY;
        var movingAllowed;
        e = e || window.event;
        switch (e.keyCode) {
            case 38:   // arrow up key
            case 87: // W key
                newX = currRectX;
                newY = currRectY - 6;
                break;
            case 37: // arrow left key
            case 65: // A key
                newX = currRectX - 6;
                newY = currRectY;
                break;
            case 40: // arrow down key
            case 83: // S key
                newX = currRectX;
                newY = currRectY + 6;
                break;
            case 39: // arrow right key
            case 68: // D key
                newX = currRectX + 6;
                newY = currRectY;
                break;
            default: return;
        }
        movingAllowed = canMoveTo(newX, newY);
        if (movingAllowed === 1) {      // 1 means 'the rectangle can move'
            drawRectangle(newX, newY, "#0000FF");
            currRectX = newX;
            currRectY = newY;
        }
        else if (movingAllowed === 2) { // 2 means 'the rectangle reached the end point'
            if (maxRound == 1) {
                clearInterval(intervalVar);
                makeWhite(0, 0, canvas.width, canvas.height);
                context.font = "40px Arial";
                context.fillStyle = "blue";
                context.textAlign = "center";
                context.textBaseline = "middle";
                context.fillText("Congratulations!", canvas.width / 2, canvas.height / 2);
                context.fillText("Time left: " + minutes.toString() + ":" + secondsToShow, canvas.width / 2, canvas.height / 2 + 100);
                var time = parseInt(minutes * 60) + parseInt(secondsToShow);
                var points = 10 * time / 90;
                context.fillText("Points: " + points, canvas.width / 2, canvas.height / 2 + 200);
                window.removeEventListener("keydown", moveRect, true);

                postGameStats(2, 2, 0, 0, points, 1, (90000 - time*1000) / 2, (90000 - time*1000), starttimestamp, Math.round(+new Date() / 1000));
            }
            else {
                drawMazeAndRectangle(mazeWidth / 2, 50, 2);
                window.addEventListener("keydown", moveRect, true);
                maxRound--;
            }


        }
    }
    function canMoveTo(destX, destY) {
        var imgData = context.getImageData(destX, destY, 15, 15);
        var data = imgData.data;
        var canMove = 1; // 1 means: the rectangle can move
        if (destX >= 0 && destX <= mazeWidth - 15 && destY >= 0 && destY <= mazeHeight - 15) {
            for (var i = 0; i < 4 * 15 * 15; i += 4) {
                if (data[i] === 0 && data[i + 1] === 0 && data[i + 2] === 0) { // black
                    canMove = 0; // 0 means: the rectangle can't move
                    break;
                }
                else if (data[i] === 0 && data[i + 1] === 255 && data[i + 2] === 0) { // #00FF00
                    canMove = 2; // 2 means: the end point is reached
                    break;
                }
            }
        }
        else {
            canMove = 0;
        }
        return canMove;
    }
    
    function createTimer(seconds) {
        intervalVar = setInterval(function () {
            makeWhite(mazeWidth, 0, canvas.width - mazeWidth, canvas.height);
            if (seconds === 0) {
                clearInterval(intervalVar);
                window.removeEventListener("keydown", moveRect, true);
                makeWhite(0, 0, canvas.width, canvas.height);
                context.font = "40px Arial";
                context.fillStyle = "red";
                context.textAlign = "center";
                context.textBaseline = "middle";
                context.fillText("Time's up!", canvas.width / 2, canvas.height / 2);

                postGameStats(2, 2, 0, 0, points, 1, 45000, 90000, starttimestamp, Math.round(+new Date() / 1000));

                return;
            }
            context.font = "20px Arial";
            if (seconds <= 10 && seconds > 5) {
                context.fillStyle = "orangered";
            }
            else if (seconds <= 5) {
                context.fillStyle = "red";
            }
            else {
                context.fillStyle = "green";
            }
            context.textAlign = "center";
            context.textBaseline = "middle";
            minutes = Math.floor(seconds / 60);
            secondsToShow = (seconds - minutes * 60).toString();
            if (secondsToShow.length === 1) {
                secondsToShow = "0" + secondsToShow; // if the number of seconds is '5' for example, make sure that it is shown as '05'
            }
            context.fillText(minutes.toString() + ":" + secondsToShow, mazeWidth + 30, canvas.height / 2);
            seconds--;
        }, 1000);
    }
    function makeWhite(x, y, w, h) {
        context.beginPath();
        context.rect(x, y, w, h);
        context.closePath();
        context.fillStyle = "white";
        context.fill();
    }
    drawMazeAndRectangle(mazeWidth - 70, mazeHeight - 50, 1);
    window.addEventListener("keydown", moveRect, true);
    createTimer(90); // 1.5 minutes
}

function map2() {
    // Maze game created by ProgramFOX; http://www.codeproject.com/Members/ProgramFOX
    // Licensed under CPOL: http://www.codeproject.com/info/cpol10.aspx

    // mazeWidth -70, mazeHeight -50 RECTANGLE
    // 542 (center X), 122 (center Y) CIRCLE
    var starttimestamp2 = Math.round(+new Date() / 1000);
    var canvas = document.getElementById("mazecanvas");
    var context = canvas.getContext("2d");
    var currRectX = mazeWidth - 70;
    var currRectY = mazeHeight - 50;
    var mazeWidth = 556;
    var mazeHeight = 556;
    var intervalVar;
    var maxRound = 2;
    var r;
    function drawMazeAndRectangle(rectX, rectY, r) {
        makeWhite(0, 0, canvas.width, canvas.height);
        var mazeImg = new Image();
        mazeImg.onload = function () {
            context.drawImage(mazeImg, 0, 0);
            drawRectangle(rectX, rectY, "#0000FF");
            context.beginPath();
            if (r == 1) {
                context.arc(mazeWidth / 2 - 100, 50, 7, 0, 2 * Math.PI, false);
            }
            else {
                context.arc(45, 70, 7, 0, 2 * Math.PI, false);
            }

            context.closePath();
            context.fillStyle = '#00FF00';
            context.fill();
        };
        mazeImg.src = "Games/Maze/maze2." + r + ".gif";
    }
    function drawRectangle(x, y, style) {
        makeWhite(currRectX, currRectY, 15, 15);
        currRectX = x;
        currRectY = y;
        context.beginPath();
        context.rect(x, y, 15, 15);
        context.closePath();
        context.fillStyle = style;
        context.fill();
    }
    function moveRect(e) {
        var newX;
        var newY;
        var movingAllowed;
        e = e || window.event;
        switch (e.keyCode) {
            case 38:   // arrow up key
            case 87: // W key
                newX = currRectX;
                newY = currRectY - 6;
                break;
            case 37: // arrow left key
            case 65: // A key
                newX = currRectX - 6;
                newY = currRectY;
                break;
            case 40: // arrow down key
            case 83: // S key
                newX = currRectX;
                newY = currRectY + 6;
                break;
            case 39: // arrow right key
            case 68: // D key
                newX = currRectX + 6;
                newY = currRectY;
                break;
            default: return;
        }
        movingAllowed = canMoveTo(newX, newY);
        if (movingAllowed === 1) {      // 1 means 'the rectangle can move'
            drawRectangle(newX, newY, "#0000FF");
            currRectX = newX;
            currRectY = newY;
        }
        else if (movingAllowed === 2) { // 2 means 'the rectangle reached the end point'
            if (maxRound == 1) {
                clearInterval(intervalVar);
                makeWhite(0, 0, canvas.width, canvas.height);
                context.font = "40px Arial";
                context.fillStyle = "blue";
                context.textAlign = "center";
                context.textBaseline = "middle";
                context.fillText("Congratulations!", canvas.width / 2, canvas.height / 2);
                context.fillText("Time left: " + minutes.toString() + ":" + secondsToShow, canvas.width / 2, canvas.height / 2 + 100);
                var time = parseInt(minutes * 60) + parseInt(secondsToShow);
                var points = 20 * time / 90;
                context.fillText("Points: " + points, canvas.width / 2, canvas.height / 2 + 200);
                window.removeEventListener("keydown", moveRect, true);

                postGameStats(2, 2, 0, 0, points, 1, (90000 - time*1000) / 2, (90000 - time*1000), starttimestamp, Math.round(+new Date() / 1000));
            }
            else {
                drawMazeAndRectangle(mazeWidth - 180, mazeHeight - 50, 2);
                window.addEventListener("keydown", moveRect, true);
                maxRound--;
            }

        }
    }
    function canMoveTo(destX, destY) {
        var imgData = context.getImageData(destX, destY, 15, 15);
        var data = imgData.data;
        var canMove = 1; // 1 means: the rectangle can move
        if (destX >= 0 && destX <= mazeWidth - 15 && destY >= 0 && destY <= mazeHeight - 15) {
            for (var i = 0; i < 4 * 15 * 15; i += 4) {
                if (data[i] === 0 && data[i + 1] === 0 && data[i + 2] === 0) { // black
                    canMove = 0; // 0 means: the rectangle can't move
                    break;
                }
                else if (data[i] === 0 && data[i + 1] === 255 && data[i + 2] === 0) { // #00FF00
                    canMove = 2; // 2 means: the end point is reached
                    break;
                }
            }
        }
        else {
            canMove = 0;
        }
        return canMove;
    }
    var minutes;
    var secondsToShow;
    function createTimer(seconds) {
        intervalVar = setInterval(function () {
            makeWhite(mazeWidth, 0, canvas.width - mazeWidth, canvas.height);
            if (seconds === 0) {
                clearInterval(intervalVar);
                window.removeEventListener("keydown", moveRect, true);
                makeWhite(0, 0, canvas.width, canvas.height);
                context.font = "40px Arial";
                context.fillStyle = "red";
                context.textAlign = "center";
                context.textBaseline = "middle";
                context.fillText("Time's up!", canvas.width / 2, canvas.height / 2);

                postGameStats(2, 1, 2 - round, 0, 0, (2 - round) / 2, 45000, 90000, starttimestamp, Math.round(+new Date() / 1000));

                return;
            }
            context.font = "20px Arial";
            if (seconds <= 10 && seconds > 5) {
                context.fillStyle = "orangered";
            }
            else if (seconds <= 5) {
                context.fillStyle = "red";
            }
            else {
                context.fillStyle = "green";
            }
            context.textAlign = "center";
            context.textBaseline = "middle";
            minutes = Math.floor(seconds / 60);
            secondsToShow = (seconds - minutes * 60).toString();
            if (secondsToShow.length === 1) {
                secondsToShow = "0" + secondsToShow; // if the number of seconds is '5' for example, make sure that it is shown as '05'
            }
            context.fillText(minutes.toString() + ":" + secondsToShow, mazeWidth + 30, canvas.height / 2);
            seconds--;
        }, 1000);
    }
    function makeWhite(x, y, w, h) {
        context.beginPath();
        context.rect(x, y, w, h);
        context.closePath();
        context.fillStyle = "white";
        context.fill();
    }

    drawMazeAndRectangle(mazeWidth / 2 - 60, mazeHeight - 50, 1);
    window.addEventListener("keydown", moveRect, true);
    createTimer(90); // 1.5 minutes
}

function map3() {
    // Maze game created by ProgramFOX; http://www.codeproject.com/Members/ProgramFOX
    // Licensed under CPOL: http://www.codeproject.com/info/cpol10.aspx

    // mazeWidth -70, mazeHeight -50 RECTANGLE
    // 542 (center X), 122 (center Y) CIRCLE
    var starttimestamp2 = Math.round(+new Date() / 1000);
    var canvas = document.getElementById("mazecanvas");
    var context = canvas.getContext("2d");
    var currRectX = mazeWidth - 70;
    var currRectY = mazeHeight - 50;
    var mazeWidth = 556;
    var mazeHeight = 556;
    var intervalVar;
    var maxRound = 2;
    var r;
    function drawMazeAndRectangle(rectX, rectY, r) {
        makeWhite(0, 0, canvas.width, canvas.height);
        var mazeImg = new Image();
        mazeImg.onload = function () {
            context.drawImage(mazeImg, 0, 0);
            drawRectangle(rectX, rectY, "#0000FF");
            context.beginPath();
            if (r == 1) {
                context.arc(mazeWidth / 2 - 100, 50, 7, 0, 2 * Math.PI, false);
            }
            else {
                context.arc(45, 70, 7, 0, 2 * Math.PI, false);
            }

            context.closePath();
            context.fillStyle = '#00FF00';
            context.fill();
        };
        mazeImg.src = "Games/Maze/maze2." + r + ".gif";
    }
    function drawRectangle(x, y, style) {
        makeWhite(currRectX, currRectY, 15, 15);
        currRectX = x;
        currRectY = y;
        context.beginPath();
        context.rect(x, y, 15, 15);
        context.closePath();
        context.fillStyle = style;
        context.fill();
    }
    function moveRect(e) {
        var newX;
        var newY;
        var movingAllowed;
        e = e || window.event;
        switch (e.keyCode) {
            case 38:   // arrow up key
            case 87: // W key
                newX = currRectX;
                newY = currRectY - 6;
                break;
            case 37: // arrow left key
            case 65: // A key
                newX = currRectX - 6;
                newY = currRectY;
                break;
            case 40: // arrow down key
            case 83: // S key
                newX = currRectX;
                newY = currRectY + 6;
                break;
            case 39: // arrow right key
            case 68: // D key
                newX = currRectX + 6;
                newY = currRectY;
                break;
            default: return;
        }
        movingAllowed = canMoveTo(newX, newY);
        if (movingAllowed === 1) {      // 1 means 'the rectangle can move'
            drawRectangle(newX, newY, "#0000FF");
            currRectX = newX;
            currRectY = newY;
        }
        else if (movingAllowed === 2) { // 2 means 'the rectangle reached the end point'
            if (maxRound == 1) {
                clearInterval(intervalVar);
                makeWhite(0, 0, canvas.width, canvas.height);
                context.font = "40px Arial";
                context.fillStyle = "blue";
                context.textAlign = "center";
                context.textBaseline = "middle";
                context.fillText("Congratulations!", canvas.width / 2, canvas.height / 2);
                context.fillText("Time left: " + minutes.toString() + ":" + secondsToShow, canvas.width / 2, canvas.height / 2 + 100);
                var time = parseInt(minutes * 60) + parseInt(secondsToShow);
                var points = 20 * time / 90;
                context.fillText("Points: " + points, canvas.width / 2, canvas.height / 2 + 200);
                window.removeEventListener("keydown", moveRect, true);

                postGameStats(2, 2, 0, 0, points, 1, (90000 - time*1000) / 2, (90000 - time*1000), starttimestamp, Math.round(+new Date() / 1000));
            }
            else {
                drawMazeAndRectangle(mazeWidth - 180, mazeHeight - 50, 2);
                window.addEventListener("keydown", moveRect, true);
                maxRound--;
            }

        }
    }
    function canMoveTo(destX, destY) {
        var imgData = context.getImageData(destX, destY, 15, 15);
        var data = imgData.data;
        var canMove = 1; // 1 means: the rectangle can move
        if (destX >= 0 && destX <= mazeWidth - 15 && destY >= 0 && destY <= mazeHeight - 15) {
            for (var i = 0; i < 4 * 15 * 15; i += 4) {
                if (data[i] === 0 && data[i + 1] === 0 && data[i + 2] === 0) { // black
                    canMove = 0; // 0 means: the rectangle can't move
                    break;
                }
                else if (data[i] === 0 && data[i + 1] === 255 && data[i + 2] === 0) { // #00FF00
                    canMove = 2; // 2 means: the end point is reached
                    break;
                }
            }
        }
        else {
            canMove = 0;
        }
        return canMove;
    }
    var minutes;
    var secondsToShow;
    function createTimer(seconds) {
        intervalVar = setInterval(function () {
            makeWhite(mazeWidth, 0, canvas.width - mazeWidth, canvas.height);
            if (seconds === 0) {
                clearInterval(intervalVar);
                window.removeEventListener("keydown", moveRect, true);
                makeWhite(0, 0, canvas.width, canvas.height);
                context.font = "40px Arial";
                context.fillStyle = "red";
                context.textAlign = "center";
                context.textBaseline = "middle";
                context.fillText("Time's up!", canvas.width / 2, canvas.height / 2);

                postGameStats(2, 1, 2 - round, 0, 0, (2 - round) / 2, 45000, 90000, starttimestamp, Math.round(+new Date() / 1000));

                return;
            }
            context.font = "20px Arial";
            if (seconds <= 10 && seconds > 5) {
                context.fillStyle = "orangered";
            }
            else if (seconds <= 5) {
                context.fillStyle = "red";
            }
            else {
                context.fillStyle = "green";
            }
            context.textAlign = "center";
            context.textBaseline = "middle";
            minutes = Math.floor(seconds / 60);
            secondsToShow = (seconds - minutes * 60).toString();
            if (secondsToShow.length === 1) {
                secondsToShow = "0" + secondsToShow; // if the number of seconds is '5' for example, make sure that it is shown as '05'
            }
            context.fillText(minutes.toString() + ":" + secondsToShow, mazeWidth + 30, canvas.height / 2);
            seconds--;
        }, 1000);
    }
    function makeWhite(x, y, w, h) {
        context.beginPath();
        context.rect(x, y, w, h);
        context.closePath();
        context.fillStyle = "white";
        context.fill();
    }

    drawMazeAndRectangle(mazeWidth / 2 - 60, mazeHeight - 50, 1);
    window.addEventListener("keydown", moveRect, true);
    createTimer(90); // 1.5 minutes

}

function map4() {

    // Maze game created by ProgramFOX; http://www.codeproject.com/Members/ProgramFOX
    // Licensed under CPOL: http://www.codeproject.com/info/cpol10.aspx

    // mazeWidth -70, mazeHeight -50 RECTANGLE
    // 542 (center X), 122 (center Y) CIRCLE
    var starttimestamp2 = Math.round(+new Date() / 1000);
    var canvas = document.getElementById("mazecanvas");
    var context = canvas.getContext("2d");
    var currRectX = mazeWidth - 70;
    var currRectY = mazeHeight - 50;
    var mazeWidth = 556;
    var mazeHeight = 556;
    var intervalVar;
    var maxRound = 2;
    var r;
    function drawMazeAndRectangle(rectX, rectY, r) {
        makeWhite(0, 0, canvas.width, canvas.height);
        var mazeImg = new Image();
        mazeImg.onload = function () {
            context.drawImage(mazeImg, 0, 0);
            drawRectangle(rectX, rectY, "#0000FF");
            context.beginPath();
            if (r == 1) {
                context.arc(45, mazeHeight - 60, 7, 0, 2 * Math.PI, false);
            }
            else {
                context.arc(45, 70, 7, 0, 2 * Math.PI, false);
            }

            context.closePath();
            context.fillStyle = '#00FF00';
            context.fill();
        };
        mazeImg.src = "Games/Maze/maze" + r + "." + r + ".gif";
    }
    function drawRectangle(x, y, style) {
        makeWhite(currRectX, currRectY, 15, 15);
        currRectX = x;
        currRectY = y;
        context.beginPath();
        context.rect(x, y, 15, 15);
        context.closePath();
        context.fillStyle = style;
        context.fill();
    }
    function moveRect(e) {
        var newX;
        var newY;
        var movingAllowed;
        e = e || window.event;
        switch (e.keyCode) {
            case 38:   // arrow up key
            case 87: // W key
                newX = currRectX;
                newY = currRectY - 6;
                break;
            case 37: // arrow left key
            case 65: // A key
                newX = currRectX - 6;
                newY = currRectY;
                break;
            case 40: // arrow down key
            case 83: // S key
                newX = currRectX;
                newY = currRectY + 6;
                break;
            case 39: // arrow right key
            case 68: // D key
                newX = currRectX + 6;
                newY = currRectY;
                break;
            default: return;
        }
        movingAllowed = canMoveTo(newX, newY);
        if (movingAllowed === 1) {      // 1 means 'the rectangle can move'
            drawRectangle(newX, newY, "#0000FF");
            currRectX = newX;
            currRectY = newY;
        }
        else if (movingAllowed === 2) { // 2 means 'the rectangle reached the end point'
            if (maxRound == 1) {
                clearInterval(intervalVar);
                makeWhite(0, 0, canvas.width, canvas.height);
                context.font = "40px Arial";
                context.fillStyle = "blue";
                context.textAlign = "center";
                context.textBaseline = "middle";
                context.fillText("Congratulations!", canvas.width / 2, canvas.height / 2);
                context.fillText("Time left: " + minutes.toString() + ":" + secondsToShow, canvas.width / 2, canvas.height / 2 + 100);
                var time = parseInt(minutes * 60) + parseInt(secondsToShow);
                var points = 30 * time / 90;
                context.fillText("Points: " + points, canvas.width / 2, canvas.height / 2 + 200);
                window.removeEventListener("keydown", moveRect, true);

                postGameStats(2, 2, 0, 0, points, 1, (90000 - time*1000) / 2, (90000 - time*1000), starttimestamp, Math.round(+new Date() / 1000));
            }
            else {
                drawMazeAndRectangle(mazeWidth - 180, mazeHeight - 50, 2);
                window.addEventListener("keydown", moveRect, true);
                maxRound--;
            }

        }
    }
    function canMoveTo(destX, destY) {
        var imgData = context.getImageData(destX, destY, 15, 15);
        var data = imgData.data;
        var canMove = 1; // 1 means: the rectangle can move
        if (destX >= 0 && destX <= mazeWidth - 15 && destY >= 0 && destY <= mazeHeight - 15) {
            for (var i = 0; i < 4 * 15 * 15; i += 4) {
                if (data[i] === 0 && data[i + 1] === 0 && data[i + 2] === 0) { // black
                    canMove = 0; // 0 means: the rectangle can't move
                    break;
                }
                else if (data[i] === 0 && data[i + 1] === 255 && data[i + 2] === 0) { // #00FF00
                    canMove = 2; // 2 means: the end point is reached
                    break;
                }
            }
        }
        else {
            canMove = 0;
        }
        return canMove;
    }
    var minutes;
    var secondsToShow;
    function createTimer(seconds) {
        intervalVar = setInterval(function () {
            makeWhite(mazeWidth, 0, canvas.width - mazeWidth, canvas.height);
            if (seconds === 0) {
                clearInterval(intervalVar);
                window.removeEventListener("keydown", moveRect, true);
                makeWhite(0, 0, canvas.width, canvas.height);
                context.font = "40px Arial";
                context.fillStyle = "red";
                context.textAlign = "center";
                context.textBaseline = "middle";
                context.fillText("Time's up!", canvas.width / 2, canvas.height / 2);

                postGameStats(2, 1, 2 - round, 0, 0, (2 - round) / 2, 45000, 90000, starttimestamp, Math.round(+new Date() / 1000));

                return;
            }
            context.font = "20px Arial";
            if (seconds <= 10 && seconds > 5) {
                context.fillStyle = "orangered";
            }
            else if (seconds <= 5) {
                context.fillStyle = "red";
            }
            else {
                context.fillStyle = "green";
            }
            context.textAlign = "center";
            context.textBaseline = "middle";
            minutes = Math.floor(seconds / 60);
            secondsToShow = (seconds - minutes * 60).toString();
            if (secondsToShow.length === 1) {
                secondsToShow = "0" + secondsToShow; // if the number of seconds is '5' for example, make sure that it is shown as '05'
            }
            context.fillText(minutes.toString() + ":" + secondsToShow, mazeWidth + 30, canvas.height / 2);
            seconds--;
        }, 1000);
    }
    function makeWhite(x, y, w, h) {
        context.beginPath();
        context.rect(x, y, w, h);
        context.closePath();
        context.fillStyle = "white";
        context.fill();
    }
    drawMazeAndRectangle(mazeWidth - 70, mazeHeight - 50, 1);
    window.addEventListener("keydown", moveRect, true);
    createTimer(90); // 1.5 minutes

}

function map5() {

    // Maze game created by ProgramFOX; http://www.codeproject.com/Members/ProgramFOX
    // Licensed under CPOL: http://www.codeproject.com/info/cpol10.aspx

    // mazeWidth -70, mazeHeight -50 RECTANGLE
    // 542 (center X), 122 (center Y) CIRCLE
    var starttimestamp2 = Math.round(+new Date() / 1000);
    var canvas = document.getElementById("mazecanvas");
    var context = canvas.getContext("2d");
    var currRectX = mazeWidth - 70;
    var currRectY = mazeHeight - 50;
    var mazeWidth = 556;
    var mazeHeight = 556;
    var intervalVar;
    var maxRound = 2;
    var r;
    function drawMazeAndRectangle(rectX, rectY, r) {
        makeWhite(0, 0, canvas.width, canvas.height);
        var mazeImg = new Image();
        mazeImg.onload = function () {
            context.drawImage(mazeImg, 0, 0);
            drawRectangle(rectX, rectY, "#0000FF");
            context.beginPath();
            if (r == 1) {
                context.arc(45, mazeHeight - 60, 7, 0, 2 * Math.PI, false);
            }
            else if (r == 2) {
                context.arc(45, 70, 7, 0, 2 * Math.PI, false);
            }
            else {
                context.arc(mazeWidth - 120, 55, 7, 0, 2 * Math.PI, false);
            }

            context.closePath();
            context.fillStyle = '#00FF00';
            context.fill();
        };
        mazeImg.src = "Games/Maze/maze" + r + "." + r + ".gif";
    }
    function drawRectangle(x, y, style) {
        makeWhite(currRectX, currRectY, 15, 15);
        currRectX = x;
        currRectY = y;
        context.beginPath();
        context.rect(x, y, 15, 15);
        context.closePath();
        context.fillStyle = style;
        context.fill();
    }
    function moveRect(e) {
        var newX;
        var newY;
        var movingAllowed;
        e = e || window.event;
        switch (e.keyCode) {
            case 38:   // arrow up key
            case 87: // W key
                newX = currRectX;
                newY = currRectY - 6;
                break;
            case 37: // arrow left key
            case 65: // A key
                newX = currRectX - 6;
                newY = currRectY;
                break;
            case 40: // arrow down key
            case 83: // S key
                newX = currRectX;
                newY = currRectY + 6;
                break;
            case 39: // arrow right key
            case 68: // D key
                newX = currRectX + 6;
                newY = currRectY;
                break;
            default: return;
        }
        movingAllowed = canMoveTo(newX, newY);
        if (movingAllowed === 1) {      // 1 means 'the rectangle can move'
            drawRectangle(newX, newY, "#0000FF");
            currRectX = newX;
            currRectY = newY;
        }
        else if (movingAllowed === 2) { // 2 means 'the rectangle reached the end point'
            if (maxRound == 0) {
                clearInterval(intervalVar);
                makeWhite(0, 0, canvas.width, canvas.height);
                context.font = "40px Arial";
                context.fillStyle = "blue";
                context.textAlign = "center";
                context.textBaseline = "middle";
                context.fillText("Congratulations!", canvas.width / 2, canvas.height / 2);
                context.fillText("Time left: " + minutes.toString() + ":" + secondsToShow, canvas.width / 2, canvas.height / 2 + 100);
                var time = parseInt(minutes * 60) + parseInt(secondsToShow);
                var points = 70 * time / 90;
                context.fillText("Points: " + points, canvas.width / 2, canvas.height / 2 + 200);
                window.removeEventListener("keydown", moveRect, true);

                postGameStats(2, 3, 0, 0, points, 1, (90000 - time*1000) / 3, (90000 - time*1000), starttimestamp, Math.round(+new Date()/1000) );
            }
            else if (maxRound == 1) {
                drawMazeAndRectangle(mazeWidth - 45, mazeHeight - 170, 3);
                window.addEventListener("keydown", moveRect, true);
                maxRound--;
            }
            else {
                drawMazeAndRectangle(mazeWidth - 180, mazeHeight - 50, 2);
                window.addEventListener("keydown", moveRect, true);
                maxRound--;
            }

        }
    }
    function canMoveTo(destX, destY) {
        var imgData = context.getImageData(destX, destY, 15, 15);
        var data = imgData.data;
        var canMove = 1; // 1 means: the rectangle can move
        if (destX >= 0 && destX <= mazeWidth - 15 && destY >= 0 && destY <= mazeHeight - 15) {
            for (var i = 0; i < 4 * 15 * 15; i += 4) {
                if (data[i] === 0 && data[i + 1] === 0 && data[i + 2] === 0) { // black
                    canMove = 0; // 0 means: the rectangle can't move
                    break;
                }
                else if (data[i] === 0 && data[i + 1] === 255 && data[i + 2] === 0) { // #00FF00
                    canMove = 2; // 2 means: the end point is reached
                    break;
                }
            }
        }
        else {
            canMove = 0;
        }
        return canMove;
    }
    var minutes;
    var secondsToShow;
    function createTimer(seconds) {
        intervalVar = setInterval(function () {
            makeWhite(mazeWidth, 0, canvas.width - mazeWidth, canvas.height);
            if (seconds === 0) {
                clearInterval(intervalVar);
                window.removeEventListener("keydown", moveRect, true);
                makeWhite(0, 0, canvas.width, canvas.height);
                context.font = "40px Arial";
                context.fillStyle = "red";
                context.textAlign = "center";
                context.textBaseline = "middle";
                context.fillText("Time's up!", canvas.width / 2, canvas.height / 2);

                postGameStats(2, 1, 3 - round, 0, 0, (3 - round) / 3, 30000, 90000, starttimestamp, Math.round(+new Date() / 1000));

                return;
            }
            context.font = "20px Arial";
            if (seconds <= 10 && seconds > 5) {
                context.fillStyle = "orangered";
            }
            else if (seconds <= 5) {
                context.fillStyle = "red";
            }
            else {
                context.fillStyle = "green";
            }
            context.textAlign = "center";
            context.textBaseline = "middle";
            minutes = Math.floor(seconds / 60);
            secondsToShow = (seconds - minutes * 60).toString();
            if (secondsToShow.length === 1) {
                secondsToShow = "0" + secondsToShow; // if the number of seconds is '5' for example, make sure that it is shown as '05'
            }
            context.fillText(minutes.toString() + ":" + secondsToShow, mazeWidth + 30, canvas.height / 2);
            seconds--;
        }, 1000);
    }
    function makeWhite(x, y, w, h) {
        context.beginPath();
        context.rect(x, y, w, h);
        context.closePath();
        context.fillStyle = "white";
        context.fill();
    }
    drawMazeAndRectangle(mazeWidth - 70, mazeHeight - 50, 1);
    window.addEventListener("keydown", moveRect, true);
    createTimer(90); // 1.5 minutes
}

