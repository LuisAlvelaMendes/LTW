'use_strict'

let sort = document.getElementById("sort");
sort.addEventListener("change", valueChanged);

let usr = document.getElementById("username").value;

function valueChanged(event) {
    story_refreshVotes();

    let channel = document.getElementById("channel_name").value; //Gets channel 

    //Request to get stories by correct order
    let request = new XMLHttpRequest();
    request.addEventListener("load", addStories);
    request.open("get", "../api/api_sortStories.php?order=" + event.target.value + "&channel=" + channel,  true);
    request.send();
}

function addStories() {
    let stories = JSON.parse(this.responseText);
    let list = document.getElementById("storyCards");
    list.innerHTML=""; //Deletes stories
   
    for(story in stories) {
        let storyComplete = document.createElement('div');
        var storyCard = drawStory(stories[story]); 

        storyComplete.innerHTML += storyCard;

        list.append(storyComplete);
    }

    story_refreshVotes();
}  

function drawStory(story) {
    var template = document.getElementById('tpl_story_card').innerHTML;
    return Mustache.render(template, {storyId : story['storyId'], title : story['title'],
                                    text : story['fulltext'], author : story['author'], 
                                    published : story['published'], points : story['points'],
                                    username : usr});
}
