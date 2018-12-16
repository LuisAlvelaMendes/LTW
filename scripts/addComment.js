'use strict';

let story_id = document.querySelector('input[name=story]').value;

let comment_section = document.querySelector('#comment_section');
let form = document.querySelector('form');

form.addEventListener('submit', addComment);

window.setInterval(refreshComments, 10000);

// Run refresh when starting
refreshComments();

// Ask for new comments
function refreshComments() {
  let request = new XMLHttpRequest();
  request.open('get', '../actions/action_addComment.php?' + encodeForAjax({'story_id' : story_id}), true);
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
  request.open('get', '../actions/action_addComment.php?' + encodeForAjax({'username': username, 'text': text_comment, 'story_id' : story_id}), true);
  request.addEventListener('load', newComment);
  request.send();

  event.preventDefault();
}

// New comment & Update comments on screen
function newComment() {
  comment_section.innerHTML = "";

  let comments = JSON.parse(this.responseText);

  for(var comment in comments) {
    let commentComplete = document.createElement('div');
    var usrComment = draw_comment(comments[comment]);
    var infoBar = draw_infobar(comments[comment]);

    commentComplete.innerHTML += usrComment;
    commentComplete.innerHTML += infoBar;

    comment_section.append(commentComplete);
    comment_section.scrollTop = comment_section.scrollTopMax;
  }
}

function draw_comment(comment){
  var template = document.getElementById('tpl_comment').innerHTML;
  return Mustache.render(template, {text : comment.text});
}

function draw_infobar(comment) {
  var template = document.getElementById('tpl_info_bar_comment').innerHTML;
  return Mustache.render(template, {storyId : comment.story_id, commentId : comment.id, username : comment.username,  published : comment.date, points : comment.points});
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}
