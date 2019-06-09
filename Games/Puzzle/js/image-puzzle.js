var timerFunction;
var p1;
var images = [
                { src: 'Games/MatchingCards/images/london-bridge.jpg', title: 'London Bridge' },
                { src: 'Games/MatchingCards/images/lotus-temple.jpg', title: 'Lotus Temple' },
                { src: 'Games/MatchingCards/images/qutub-minar.jpg', title: 'Qutub Minar' },
                { src: 'Games/MatchingCards/images/statue-of-liberty.jpg', title: 'Statue Of Liberty' },
                { src: 'Games/MatchingCards/images/taj-mahal.jpg', title: 'Taj Mahal' }
            ];
var imagePuzzle = {
    stepCount: 0,
    startTime: new Date().getTime(),
    startGame: function (difficulty, round) {
				
		if (difficulty == 1) {
			gridSize = 2;
			p1=10;
		} else if (difficulty == 2) {
			gridSize = 3;
			p1=20;
		} else if (difficulty == 3) {
			gridSize = 4;
			p1=40;
		} else if (difficulty == 4) {
			gridSize = 2+(2-round);
			p1=30;
		} else if (difficulty == 5) {
			gridSize = 2+(3-round);
			p1=70;
		}
		
        this.setImage(difficulty, gridSize, round, p1);
        helper.doc('playPanel').style.display = 'block';
        helper.shuffle('sortable');
        this.stepCount = 0;
        this.startTime = new Date().getTime();
        this.tick();
    },
    tick: function () {
        var now = new Date().getTime();
        var elapsedTime = parseInt((151-(now - imagePuzzle.startTime + 1) / 1000), 10);
		if(elapsedTime<=0){
			helper.doc('actualImageBox').innerHTML = helper.doc('gameOver2').innerHTML;
		}
		var duration = moment.duration(elapsedTime, 'seconds');
		var formatted = duration.format("hh:mm:ss");
        helper.doc('timerPanel').textContent = formatted;
        timerFunction = setTimeout(imagePuzzle.tick, 1000);
    },
    setImage: function (difficulty, gridSize = 4, round, p1) {
        var percentage = 100 / (gridSize - 1);
        var image = images[Math.floor(Math.random() * images.length)];
        helper.doc('imgTitle').innerHTML = image.title;
        helper.doc('actualImage').setAttribute('src', image.src);
        helper.doc('sortable').innerHTML = '';
        for (var i = 0; i < gridSize * gridSize; i++) {
            var xpos = (percentage * (i % gridSize)) + '%';
            var ypos = (percentage * Math.floor(i / gridSize)) + '%';

            let li = document.createElement('li');
            li.id = i;
            li.setAttribute('data-value', i);
            li.style.backgroundImage = 'url(' + image.src + ')';
            li.style.backgroundSize = (gridSize * 100) + '%';
            li.style.backgroundPosition = xpos + ' ' + ypos;
            li.style.width = 400 / gridSize + 'px';
            li.style.height = 400 / gridSize + 'px';

            li.setAttribute('draggable', 'true');
            li.ondragstart = (event) => event.dataTransfer.setData('data', event.target.id);
            li.ondragover = (event) => event.preventDefault();
            li.ondrop = (event) => {
                let origin = helper.doc(event.dataTransfer.getData('data'));
                let dest = helper.doc(event.target.id);
                let p = dest.parentNode;

                if (origin && dest && p) {
                    let temp = dest.nextSibling;
                    p.insertBefore(dest, origin);
                    p.insertBefore(origin, temp);

                    let vals = Array.from(helper.doc('sortable').children).map(x => x.id);
                    var now = new Date().getTime();
					
					var elapsedTime = parseInt((151-(now - imagePuzzle.startTime + 1) / 1000), 10);
					var duration = moment.duration(elapsedTime, 'seconds');
					var formatted = duration.format("hh:mm:ss");
                    document.querySelector('.timeCount').textContent = formatted;
					document.querySelector('.points').textContent = p1*elapsedTime/150;
					
                    if (isSorted(vals)) {
						console.log(round);
                        if(round <= 1){
							helper.doc('actualImageBox').style.display = 'none';
							helper.doc('gameOver').style.display = 'block';
							helper.doc('actualImageBox').innerHTML = helper.doc('gameOver').innerHTML;
						}
						else{
							round--;
							restart(difficulty, round);
						}
						
                    }
                }
            };
            li.setAttribute('dragstart', 'true');
            helper.doc('sortable').appendChild(li);
        }
        helper.shuffle('sortable');
    }
};

isSorted = (arr) => arr.every((elem, index) => { return elem == index; });

var helper = {
    doc: (id) => document.getElementById(id) || document.createElement("div"),

    shuffle: (id) => {
        var ul = document.getElementById(id);
        for (var i = ul.children.length; i >= 0; i--) {
            ul.appendChild(ul.children[Math.random() * i | 0]);
        }
    }
}

function restart(difficulty, round) {
    imagePuzzle.startGame(difficulty, round);
}

function start(difficulty) {
	document.getElementById('play').innerHTML = '';
	var round;
	if (difficulty == 5) round = 3;
	else round = 2;
	imagePuzzle.startGame(difficulty, round);
}

