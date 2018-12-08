let text = document.getElementById("search");
text.addEventListener("keyup", inputChanged);

// Handler for change event on text input
function inputChanged(event) {

    let input = text.value;
    let list = document.getElementById("matches");

    if(input.length >= 3)
    {
        let request1 = new XMLHttpRequest();
        request1.addEventListener("load",storiesReceived);
        request1.open("get", "../database/db_getmatches_stories.php?value=" + input, false);
        request1.send();

        let request2 = new XMLHttpRequest();
        request2.addEventListener("load", channelsReceived);
        request2.open("get", "../database/db_getmatches_channels.php?value=" + input, false);
        request2.send();  
        
        let request3 = new XMLHttpRequest();
        request3.addEventListener("load", commentsReceived);
        request3.open("get", "../database/db_getmatches_comments.php?value=" + input, false);
        request3.send();    
    }
    else
        list.innerHTML = "";
    
}

// Handler for stories received
function storiesReceived()
{
    let matches = JSON.parse(this.responseText);
    let list = document.getElementById("matches");
    list.innerHTML = "";
    for(key in matches)
    {
        let match = matches[key];
        let button = document.createElement("button");
        button.setAttribute('onclick', "window.location.href='../pages/story.php?id=" + match.id + "'");
        button.innerHTML = '<h1>' + match.title + '</h1><p> Story </p>';

        list.appendChild(button);
    }
}

// Handler for channels received
function channelsReceived()
{
    let matches = JSON.parse(this.responseText);
    let list = document.getElementById("matches");
    for(key in matches)
    {
        let match = matches[key];
        let button = document.createElement("button");
        button.setAttribute('onclick', "window.location.href='../pages/channel.php?name=" + match.name + "'");
        button.innerHTML = '<h1>' + match.name + '</h1><p> Channel </p>';

        list.appendChild(button);
    }
}

// Handler for comments received
function commentsReceived()
{
    let matches = JSON.parse(this.responseText);
    let list = document.getElementById("matches");
    for(key in matches)
    {
        let match = matches[key];
        let button = document.createElement("button");
        button.setAttribute('onclick', "window.location.href='../pages/story.php?id=" + match.story_id + "'");
        button.innerHTML = '<h1>' + match.text + '</h1><h2>' + match.username + '</h2><p> Comment </p>';

        list.appendChild(button);
    }
}

