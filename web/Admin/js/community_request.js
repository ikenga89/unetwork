


function add_community(THIS){
	alert( $( "#add_community_name" ).val() );
	var community_name = $( "#add_community_name" ).val();

/*
	$.ajax({
	  type: "POST",
	  url: link_add_community,
	  data: { post_community_name: community_name }
	})
	  .done(function( reponse ) {
	     alert( reponse );
	     $("#pomme").html(reponse);

	  //  $('#prenom_eleve').html(reponse);
	    
	  })
	  .fail(function() {
	    alert( "error" );
	  });
*/
};



var communities_updating = true; // pour empecher double clic abusif

function edit_community(THIS,ID){
	if (communities_updating) {
		var community_name_id = "#community_name_" + ID;
		var community_name = $( community_name_id ).html();
		$( community_name_id ).html('<input class="input_name" maxlength="200" type="texte" value="' + community_name + '">');

		var community_alias_id = "#community_alias_" + ID;
		var community_alias = $( community_alias_id ).html();
		$( community_alias_id ).html('<input class="input_alias" maxlength="4" type="texte" value="' + community_alias + '">');

		var onclick = "update_community(this," + ID + ")";
		$( THIS ).attr( "onclick" , onclick );
		$( THIS ).attr("src","/Admin/img/validate.png");
	};
};

function update_community(THIS,ID){
	if (communities_updating) {
		communities_updating = false;
		$( THIS ).attr("src","/Admin/img/validate_grey.png");

		var community_name_id = "#community_name_" + ID + " " + "input";
		var community_name = $.trim( $( community_name_id ).val() );

		var community_alias_id = "#community_alias_" + ID + " " + "input";
		var community_alias = $.trim( $( community_alias_id ).val() );

		$.ajax({
		  type: "POST",
		  url: link_update_community,
		  data: { post_community_id: ID, post_community_name: community_name, post_community_alias: community_alias,}

		}).done(function( reponse ) {
			if( reponse == 1 ) {
				community_name_id = "#community_name_" + ID;
				$( community_name_id ).html( community_name );

				community_alias_id = "#community_alias_" + ID;
				$( community_alias_id ).html( community_alias );

				$( THIS ).attr("src","/Admin/img/validate_green.png");
				setTimeout( function(){ $( THIS ).attr("src","/Admin/img/edit.png"); }, 1000);
				var onclick = "edit_community(this," + ID + ")";
				$( THIS ).attr( "onclick" , onclick );
									
			}else{
				$( THIS ).attr("src","/Admin/img/validate_red.png");
				setTimeout( function(){ $( THIS ).attr("src","/Admin/img/validate.png"); }, 2000);		
			}
		}).fail(function() {
		    $( THIS ).attr("src","/Admin/img/validate_red.png");
			setTimeout( function(){ $( THIS ).attr("src","/Admin/img/validate.png"); }, 2000);
		});
		setTimeout( function(){ communities_updating = true; }, 2050);
	};
};