let text = document.getElementById("search");
text.addEventListener("keydown", inputChanged);

// Handler for change event on text input
function inputChanged(event) {

    if (event.keyCode != 13)
        return;

    let input = text.value;
    let list = document.getElementById("matches");
    list.innerHTML = "";

    let searchChannels = document.getElementById("searchChannels").checked;
    let searchStories = document.getElementById("searchStories").checked;
    let searchComments = document.getElementById("searchComments").checked;


    if (searchChannels) {
        let request1 = new XMLHttpRequest();
        request1.addEventListener("load", channelsReceived);
        request1.open("get", "../database/db_getmatches_channels.php?value=" + input, true);
        request1.send();
    }

    if (searchStories) {
        let request2 = new XMLHttpRequest();
        request2.addEventListener("load", storiesReceived);
        request2.open("get", "../database/db_getmatches_stories.php?value=" + input, true);
        request2.send();
    }

    if (searchComments) {
        let request3 = new XMLHttpRequest();
        request3.addEventListener("load", commentsReceived);
        request3.open("get", "../database/db_getmatches_comments.php?value=" + input, true);
        request3.send();
    }

}

// Handler for stories received
function storiesReceived() {
    let matches = JSON.parse(this.responseText);
    let list = document.getElementById("matches");
    for (key in matches) {
        let match = matches[key];
        let button = document.createElement("button");
        button.setAttribute('class', 'story');
        button.setAttribute('onclick', "window.location.href='../pages/story.php?id=" + match.id + "'");
        button.innerHTML = '<p> Story </p><h1>' + match.title + '</h1>';

        list.appendChild(button);
    }
}

// Handler for channels received
function channelsReceived() {
    let matches = JSON.parse(this.responseText);
    let list = document.getElementById("matches");
    for (key in matches) {
        let match = matches[key];
        let button = document.createElement("button");
        button.setAttribute('class', 'channel');
        button.setAttribute('onclick', "window.location.href='../pages/channel.php?name=" + match.name + "'");
        button.innerHTML = '<p> Channel </p><h1>' + match.name + '</h1>';

        list.appendChild(button);
    }
}

// Handler for comments received
function commentsReceived() {
    let matches = JSON.parse(this.responseText);
    let list = document.getElementById("matches");
    for (key in matches) {
        let match = matches[key];
        let button = document.createElement("button");
        button.setAttribute('class', 'comment');
        button.setAttribute('onclick', "window.location.href='../pages/story.php?id=" + match.story_id + "'");
        if (match.text.length > 50)
            match.text = match.text.substring(0, 50) + " ...";
        button.innerHTML = '<p> Comment </p><h1>' + match.text + '</h1><h4>From: ' + match.username + '</h4>';

        list.appendChild(button);
    }
}