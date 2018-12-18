'use strict';

// EventListener working on the section instead of on every single checkbox
let storyCards = document.querySelector('#storyCards');
storyCards.addEventListener('change', story_addVote);

// Refresh votes at start, changing checkbox which have been voted
story_refreshVotes();

// Refreshes story votes when page load and after channel stories being sorted
function story_refreshVotes() {
	let allCBs = storyCards.getElementsByClassName('up'); // Only need the up arrow since only the voteType changes
    let CBs=Array();
	let username = allCBs[0].getAttribute('data-username');
    
    // User is not logged in disables CBs
    if(username == -1) {
        story_disableCB();
        return; 
    }

    for(let i = 0; i < allCBs.length; i++) {
        CBs[i] = allCBs[i].getAttribute('data-id');
	}
    
	let request = new XMLHttpRequest();
	request.open('post', '../api/api_voteStory.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', story_updateCB);
	request.send(encodeForAjax({'CBs' : CBs, 'username' : username}));
}

// Disables CB when user is not logged in
function story_disableCB(){
    let allUp = storyCards.getElementsByClassName('up');
    let allDown = storyCards.getElementsByClassName('down');
    
    for(let i = 0; i < allUp.length; i++) {
        if(!allUp[i].disabled) allUp[i].disabled = true;
        if(!allDown[i].disabled) allDown[i].disabled = true;
    }
}

// Updates checkboxes with usr votes 
function story_updateCB() {
    let votes = JSON.parse(this.responseText);
    let CB;
    
    for(let i = 0; i < votes.length; i++){
        let voteId = votes[i]['id'];
        CB = storyCards.querySelector(`[data-id="${voteId}"]`);
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
function story_addVote(event){
    let vote = event.target;
    
    let id = vote.getAttribute('data-id');
    let point = vote.getAttribute('data-point');
    let username = vote.getAttribute('data-username');
    
    // User is not logged in does matter if he votes
    if(username == -1) return;

    let request = new XMLHttpRequest();
    request.open('post', '../api/api_voteStory.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', story_newVote);
    request.send(encodeForAjax({'id' : id, 'point' : point, 'username' : username}));
}

// Manages how the checkboxes work when there is a new vote
// They behavve like a radio button but you can cancel your input once there is one
function story_newVote() {
    let vote = JSON.parse(this.responseText);
    let voteId=vote['id'];
    let CB = storyCards.querySelector(`[data-id="${voteId}"]`);
    let points = CB.nextElementSibling;

    if(vote['type'] == null) {
        points.innerHTML = vote['points'].points;
    }else {
        switch (vote['type']) {
            case '1':
                points.innerHTML = vote['points'].points;
                CB.checked = false;

                break;
            case '0':
                let aux = CB.nextElementSibling;    // Next sibling is the points
                aux = aux.nextElementSibling;       // Next next sibling is the downvote
                points.innerHTML = vote['points'].points;
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