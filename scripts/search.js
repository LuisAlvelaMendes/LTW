let text = document.getElementById("search");
text.addEventListener("keyup", inputChanged);

// Handler for change event on text input
function inputChanged(event) {

    let input = text.value;

    if(input.length >= 3)
    {
        let request = new XMLHttpRequest();
        request.addEventListener("load", matchesReceived);
        request.open("get", "../database/db_getmatches.php?value=" + input, true);
        request.send();
    }
}

// Handler for ajax response received
function matchesReceived()
{
    let matches = JSON.parse(this.responseText);
    let list = document.getElementById("matches");
    list.innerHTML=""; 
    for(key in matches)
    {
        let match = matches[key];
        let button = document.createElement("button");
        console.log(match);
        button.setAttribute('onclick', "window.location.href='../pages/story.php?id=" + match.id + "'");
        button.innerHTML = '<h1>' + match.title + '</h1><p> Story </p>';

        list.appendChild(button);

    }
}


