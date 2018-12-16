'use strict';

let storyCards = document.querySelector('#storyCards');
storyCards.addEventListener('change', addVote);

// Refresh votes at start, changing checkbox which have been voted
refreshVotes();

function refreshVotes() {
	let allCBs = document.getElementsByClassName('up');
	let CBs=Array();
	let username = allCBs[0].getAttribute('data-username');

	for(let i = 0; i < allCBs.length; i++) {
		CBs[i] = allCBs[i].getAttribute('data-id');
	}
       
	let request = new XMLHttpRequest();
	request.open('post', '../actions/action_voteStory.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', updateCB);
	request.send(encodeForAjax({'CBs' : CBs, 'username' : username}));
}

function updateCB() {
    let votes = JSON.parse(this.responseText);
    let CB;

    for(let i = 0; i < votes.length; i++){
        let voteId = votes[i]['id'];
        CB = document.querySelector(`[data-id="${voteId}"]`);
        if(votes[i]['type'] == 1){
            CB.checked = true;
        } else {
            let aux = CB.nextElementSibling; // Next sibling is the points
            aux = aux.nextElementSibling;   // Next next sibling is the downvote
            aux.checked = true;
        }
    }
}

// Add vote to db
function addVote(event){
    let vote = event.target;
    
    let id = vote.getAttribute('data-id');
    let point = vote.getAttribute('data-point');
    let username = vote.getAttribute('data-username');

    let request = new XMLHttpRequest();
    request.open('post', '../actions/action_voteStory.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', newVote);
    request.send(encodeForAjax({'id' : id, 'point' : point, 'username' : username}));
}

function newVote() {
    let vote = JSON.parse(this.responseText);
    let voteId=vote['id'];
    let CB = document.querySelector(`[data-id="${voteId}"]`);
    let points = CB.nextElementSibling;
    
    if(vote['type'] == null) {
        console.log("---usr ainda nao tinha feito voto---");
        console.log(vote['points']);
        points.innerHTML = vote['points'][0].points;
    }else {
        switch (vote['type']) {
            case '1':
                console.log("---usr tinha feito um voto para cima---");
                console.log(vote['points']);
                points.innerHTML = vote['points'][0].points;
                CB.checked = false;
                break;
            case '0':
                console.log("---usr tinha feito um voto para baixo---");
                console.log(vote['points']);
                let aux = CB.nextElementSibling;
                aux = aux.nextElementSibling;
                points.innerHTML = vote['points'][0].points;
                aux.checked = false;
                break;
        }
    }
   
}

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}