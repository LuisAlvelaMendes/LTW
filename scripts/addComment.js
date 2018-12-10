'use strict';

// Id of last message received
let last_id = -1;
let story_id = document.querySelector('input[name=story]').value;

let comment_section = document.querySelector('#comment_section');
let form = document.querySelector('form');

form.addEventListener('submit', addComment);

// Run refresh when starting
refresh();

// Ask for new messages
function refresh() {
  let request = new XMLHttpRequest();
  request.open('get', '../actions/action_addComment.php?' + encodeForAjax({'story_id' : story_id}), true);
  request.addEventListener('load', newComment);
  request.send();
}

// Send message
function addComment(event) {
  let comment = document.querySelector('textarea[name=comment]').value;
  let username = document.querySelector('input[name=username]').value;

  // Delete sent message
  document.querySelector('textarea[name=comment]').value='';

  // Send message
  let request = new XMLHttpRequest();
  request.open('get', '../actions/action_addComment.php?' + encodeForAjax({'username': username, 'text': comment, 'story_id' : story_id}), true);
  request.addEventListener('load', newComment);
  request.send();

  event.preventDefault();
}

// Called when messages are received
function newComment() {
  comment_section.innerHTML = "";

  let comments = JSON.parse(this.responseText);

  comments.forEach(function(data){
    let comment = document.createElement('div');

    last_id = data.id;
		

    comment.classList.add('usrComment');
    comment.innerHTML = "<p id='comment'>" + data.text + '</p>';

    comment_section.append(comment);
    comment_section.scrollTop = comment_section.scrollTopMax;
  });
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}
