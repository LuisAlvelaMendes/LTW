<?php function draw_searchbar() { ?>
    <script src="../scripts/search.js" defer></script>
    <label>Search:
        <input id="search" name="pattern" type="text" size="70">
    </label>
    <section id="matches">
    </section>
<?php } ?>