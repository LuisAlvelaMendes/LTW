<?php // Draws search page ?>
<?php function draw_searchbar() { ?>
    <script src="../scripts/search.js" defer></script>
    
    <link rel="stylesheet" href="../css/search.css">
    
    <label>Search:</label>
    <input id="search" name="pattern" type="text" placeholder="Press Enter to search" size="70">
  
    <div id="CBs">
        <input type="checkbox" id="searchChannels" checked><label>Channels</label>
        <input type="checkbox" id="searchStories" checked><label>Stories</label>
        <input type="checkbox" id="searchComments" checked><label>Comments</label>
    </div>

    <section id="matches"></section>
<?php } ?>