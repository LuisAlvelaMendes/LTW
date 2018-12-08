<?php function draw_searchbar() { ?>
    <script src="../scripts/search.js" defer></script>
    <link rel="stylesheet" href="../css/search.css">
    <label>Search:
        <input id="search" name="pattern" type="text" size="70">
    </label>
    <label>
    <input type="checkbox" id="searchChannels" checked> Channels
    <input type="checkbox" id="searchStories" checked> Stories
    <input type="checkbox" id="searchComments" checked> Comments

    <section id="matches">
    </section>
<?php } ?>