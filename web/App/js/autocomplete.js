
var projects = [
{
nom: "jquery",
prenom: "jQuery",
id: "the write less, do more, JavaScript library",
image: "http://unetwork.local/img/default_user.png"
},
{
nom: "jquery-ui",
prenom: "jQuery UI",
id: "the official user interface library for jQuery",
image: "jqueryui_32x32.png"
},
{
nom: "sizzlejs",
prenom: "Sizzle JS",
id: "a pure-JavaScript CSS selector engine",
image: "sizzlejs_32x32.png"
}
];




 $(function() {

$( "#form_recherche" ).autocomplete({
//minLength: 0,
// source: projects,
source: function( request, response ) {
		$.ajax({
			url: link_autocomplete + "?search=" + request.term,

			success: function( data ) {
				//alert(data);
				response( $.parseJSON( data ) );


			}
		});
	},
	select: function( event, ui ) {
        $( "#form_recherche" ).val( ui.item.label );
        return false;
      }
})/*
.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
	return $( "<li>" )
//.append( '<a href="pouette">' + 'blabla' + '<img style="width:40px; height:40px" src="' + item.icon + '">' + item.label + '</a>' )
.append( item.nom )
.appendTo( "#autocomplete_reponse" );
};*/

});







