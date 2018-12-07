'use_strict'

let sort = document.getElementById("sort");
sort.addEventListener("change", valueChanged);

function valueChanged(event) {

    let channel = document.getElementById("channel_name").value; //Gets channel 

    //Request to get stories by correct order
    let request = new XMLHttpRequest();
    request.addEventListener("load", addStories);
    request.open("get", "../database/db_storiesBy" + event.target.value + ".php?channel=" + channel, true);
    request.send();
}

function addStories() 
{
    let stories = JSON.parse(this.responseText);
    let list = document.getElementById("story_cards");
    list.innerHTML=""; //Deletes stories

    for(story in stories) {
        let button = document.createElement("button");
        button.setAttribute('id', 'storyCard');
        button.setAttribute('class', 'storyCards');
        button.setAttribute('onclick', "window.location.href='../pages/story.php?id=" + stories[story].id + "'");
        button.innerHTML = '<h1>' + stories[story].title + '</h1><p>' + stories[story].fulltext + '   </p>' 
        
        var infoBar = drawInfo(stories[story]);
        button.innerHTML += infoBar;
        button.innerHTML += '<p>&bull; &bull; &bull;</p>';

        list.appendChild(button);

    }

    function drawInfo(story)
    {
        var template = document.getElementById('template').innerHTML;
        return Mustache.render(template,{storyId : story.id, username: story.author, channel: story.channel, published: story.published, points: story.points});
    }
}  
