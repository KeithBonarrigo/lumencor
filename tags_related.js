jQuery( ".tags-topics-tile" ).mouseover(function() {
    jQuery(this).children().css("color","#FFF");
});

jQuery( ".tags-topics-tile" ).mouseout(function() {
    jQuery(this).children().css("color","#000");
});

jQuery( ".tags-topics-tile" ).click(function() {
    var link = jQuery(this).find( "a" ).attr("href");
    window.location = link;
});

jQuery( ".tag-lower-bar" ).click(function() {
    var link = jQuery(this).find( "a" ).attr("href");
    window.location = link;
});

jQuery( ".tag-container" ).mouseover(function() {
    jQuery(this).find( ".tag-lower-bar" ).css("background-color", "#13b139");
    jQuery(this).find( "a" ).css("color","#FFF");
});

jQuery( ".tag-container" ).mouseout(function() {
    jQuery(this).find( ".tag-lower-bar" ).css("background-color", "#eeeeee");
    jQuery(this).find( "a" ).css("color","#000");
});

jQuery( ".crp-list-item" ).mouseover(function() {
    jQuery(this).find( "a" ).css( "color", "#FFF" );
});

jQuery( ".crp-list-item" ).mouseout(function() {
    jQuery(this).find( "a" ).css( "color", "#000" );
});

jQuery( ".crp-list-item" ).click(function() {
    var link = jQuery(this).find( "a" ).attr("href");
    window.location = link;
});