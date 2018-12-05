'use strict';

// Id of last message received
let last_id = -1;
let story_id = document.querySelector('input[name=story]').value;

let chat = document.querySelector('#chat');
let form = document.querySelector('form');

form.addEventListener('submit', addComment);

// Run refresh when starting
refresh();

// Ask for new messages
function refresh() {
  let request = new XMLHttpRequest();
  request.open('get', '../actions/action_addComment.php?' + encodeForAjax({'last_id': last_id, 'story_id' : story_id}), true);
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
  request.open('get', '../actions/action_addComment.php?' + encodeForAjax({'last_id': last_id, 'username': username, 'text': comment, 'story_id' : story_id}), true);
  request.addEventListener('load', newComment);
  request.send();

  event.preventDefault();
}

// Called when messages are received
function newComment() {
  let comments = JSON.parse(this.responseText);

  comments.forEach(function(data){
    let comment = document.createElement('div');

    last_id = data.id;
		

    comment.classList.add('comment');
    comment.innerHTML =
      '<span class="time">' + data.time + '</span>' +
      '<span class="username">' + data.username + ':</span>' +
      '<span class="message">' + data.text + '</span>';

    chat.append(comment);
    chat.scrollTop = chat.scrollTopMax;
  });
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}
