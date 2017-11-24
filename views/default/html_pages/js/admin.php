<?php
?>
//<script>

elgg.provide("elgg.html_pages");

elgg.html_pages.init = function(){
    $(".html_pages-add").click(function() { elgg.html_pages.add(); });

    $(".html_pages-table").ready(function() {
        elgg.html_pages.count = $(".html_pages-table .html_pages-row").length - 1 // do not save header;
    });
}

elgg.html_pages.remove = function(self) {
    $(self).closest(".html_pages-row").remove();
}

elgg.html_pages.add = function() {
    elgg.html_pages.count += 1;
    $(".html_pages-table .html_pages-row:last").after('<div class="html_pages-row">' +
        '<div class="html_pages-cell"><input type="text" value="" name="pages[' + elgg.html_pages.count + '][url]" class="elgg-input-text"></div>' +
        '<div class="html_pages-cell"><textarea name="pages[' + elgg.html_pages.count + '][content]" class="elgg-input-plaintext"></textarea></div>' +
        '<div class="html_pages-cell"><a class="html_pages-remove" onClick="elgg.html_pages.remove(this);"><span class="elgg-icon-delete elgg-icon"></span></a></div></div>'
    );
}


elgg.register_hook_handler("init", "system", elgg.html_pages.init);