$(function() {
var projects = [
{
value: "jquery",
label: "jQuery",
desc: "the write less, do more, JavaScript library",
icon: "http://unetwork.local/img/default_user.png"
},
{
value: "jquery-ui",
label: "jQuery UI",
desc: "the official user interface library for jQuery",
icon: "jqueryui_32x32.png"
},
{
nom: "sizzlejs",
prenom: "Sizzle JS",
id: "a pure-JavaScript CSS selector engine",
image: "sizzlejs_32x32.png"
}
];
});



 $(function() {
function log( message ) {
$( "<div>" ).text( message ).prependTo( "#log" );
$( "#log" ).scrollTop( 0 );
} 
$( "#form_recherche" ).autocomplete({
minLength: 0,
// source: projects,
source: function( request, response ) {
		$.ajax({
			url: "http://ws.geonames.org/searchJSON",
			dataType: "jsonp",
			data: {
				search: request.term
			},
			success: function( data ) {
				response( $.map( data.geonames, function( item ) {
					return {
						label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
						value: item.name
					}
				}));
			}
		});
	},
focus: function( event, ui ) {
	$( "#form_recherche" ).val( ui.item.label );
	return false;
},
select: function( event, ui ) {
	$( "#form_recherche" ).val( ui.item.label );
	return false;
}
})
.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
	return $( "<li>" )
.append( '<a href="pouette">' + 'blabla' + '<img style="width:40px; height:40px" src="' + item.icon + '">' + item.label + '</a>' )
.appendTo( ul );
};

});
