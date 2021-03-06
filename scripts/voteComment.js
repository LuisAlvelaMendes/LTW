'use strict';

// EventListener working on the section instead of on every single checkbox
let commentSection = document.querySelector('#comment_section');
commentSection.addEventListener('change', comment_addVote);

let username = document.getElementById('username').value;

// Refreshes votes on comments when page loads and when theres a new comment
function comment_refreshVotes() {
	let allCBs = commentSection.getElementsByClassName('up'); // Only need the up arrow since only the voteType changes
    let CBs=Array(); 
	
    // User is not logged in disables CBs
    if(username == -1) {
        comment_disableCB();
        return;
    }

    for(let i = 0; i < allCBs.length; i++) {
        CBs[i] = allCBs[i].getAttribute('data-id');
	}
   
	let request = new XMLHttpRequest();
	request.open('post', '../api/api_voteComment.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', comment_updateCB);
	request.send(encodeForAjax({'CBs' : CBs, 'username' : username}));
}

// Disables comment CB when user is not logged in
function comment_disableCB(){
    let allUp = commentSection.getElementsByClassName('up');
    let allDown = commentSection.getElementsByClassName('down');

    for(let i = 0; i < allUp.length; i++) {
        allUp[i].disabled = true;
        allDown[i].disabled = true;
    }
}

// Updates checkboxes with usr votes 
function comment_updateCB() {
    let votes = JSON.parse(this.responseText);
    let CB;
    
    for(let i = 0; i < votes.length; i++){
        let voteId = votes[i]['id'];
        CB = commentSection.querySelector(`[data-id="${voteId}"]`);
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
function comment_addVote(event){
    let vote = event.target;
    
    let id = vote.getAttribute('data-id');
    let point = vote.getAttribute('data-point');
    
    // User is not logged in does matter if he votes
    if(username == -1) return;

    let request = new XMLHttpRequest();
    request.open('post', '../api/api_voteComment.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', comment_newVote);
    request.send(encodeForAjax({'id' : id, 'point' : point, 'username' : username}));
}

// Manages how the checkboxes work when there is a new vote
// They behavve like a radio button but you can cancel your input once there is one
function comment_newVote() {
    let vote = JSON.parse(this.responseText);
    let voteId=vote['id'];
    let CB = commentSection.querySelector(`[data-id="${voteId}"]`);
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
                let aux = CB.nextElementSibling;
                aux = aux.nextElementSibling;
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