'use strict';

let story_id = document.querySelector('input[name=story]').value;
let form = document.querySelector('form');

form.addEventListener('submit', addComment);

// Run refresh when starting
refreshComments();

// Ask for new comments
function refreshComments() {
	let request = new XMLHttpRequest();
	request.open('get', '../api/api_addComment.php?' + encodeForAjax({'story_id' : story_id}), true);
	request.addEventListener('load', newComment);
	request.send();
}

// Adds comment to db
function addComment(event) {
	let text_comment = document.querySelector('textarea[name=comment]').value;
	let username = document.querySelector('input[name=username]').value;

	// Delete comment textarea
	document.querySelector('textarea[name=comment]').value='';

	let request = new XMLHttpRequest();
	request.open('get', '../api/api_addComment.php?' + encodeForAjax({'username': username, 'text': text_comment, 'story_id' : story_id}), true);
	request.addEventListener('load', newComment);
	request.send();

	event.preventDefault();
}

// New comment & Update comments on screen
function newComment() {
	commentSection.innerHTML = "";

	let comments = JSON.parse(this.responseText);

	for(var comment in comments) {
		let commentComplete = document.createElement('div');
		var usrComment = draw_comment(comments[comment]);

		commentComplete.innerHTML += usrComment;

		commentSection.append(commentComplete);
		commentSection.scrollTop = commentSection.scrollTopMax;
	}
	comment_refreshVotes();
}

function draw_comment(comment){
	var template = document.getElementById('tpl_comment').innerHTML;
	console.log(typeof comment['date']);
	return Mustache.render(template, {text : comment['text'], storyId : comment['storyId'], 
									commentId : comment['id'], author : comment['author'],
									date : comment['date'], points : comment['points'], 
									username : username});
}

function encodeForAjax(data) {
	return Object.keys(data).map(function(k){
		return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
	}).join('&');
}
