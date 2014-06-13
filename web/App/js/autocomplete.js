

$(function() {

$( "#form_recherche" ).autocomplete({
	minLength: 5,
	open: function(event, ui) {
            $(this).autocomplete("widget").css({
                "width": "250px",
                "left": "94px",
                "top": "35px"
            });
        },
	source: function( request, response ) {
			$.ajax({
				url: link_autocomplete + "?search=" + request.term,

				success: function( data ) {
					response( $.parseJSON( data ) );
				}
			});
		}
	})
	.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li>" )
	.append( '<a class="a_autocomplete" href="' + link_user_profil + "/" + item.id + '"><img src="' + item.path + '" alt="profil" /><p>' + item.nom + ' ' + item.prenom + '</p></a>')
	.appendTo( ul );
	};

});







