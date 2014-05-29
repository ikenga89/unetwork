



var communities_updating = true; // pour empecher double clic abusif

function edit_community(THIS,ID){
	if (communities_updating) {
		var community_edit = "'#community_edit_" + ID + "'";

		var community_name_id = "#community_name_" + ID;
		var community_name = $( community_name_id ).html();
		$( community_name_id ).html('<input class="input_name" maxlength="200" type="texte" value="' + community_name + '" onkeypress="if (event.keyCode == 13) update_community(' + community_edit + ',' + ID + ')" >');

		var community_alias_id = "#community_alias_" + ID;
		var community_alias = $( community_alias_id ).html();
		$( community_alias_id ).html('<input class="input_alias" maxlength="4" type="texte" value="' + community_alias + '" onkeypress="if (event.keyCode == 13) update_community(' + community_edit + ',' + ID + ')" >');

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
		community_name = community_name.replace( /"/g, "''");

		var community_alias_id = "#community_alias_" + ID + " " + "input";
		var community_alias = $.trim( $( community_alias_id ).val() );
		community_alias = community_alias.replace( /"/g, "''");

		$.ajax({
		  type: "POST",
		  url: link_update_community,
		  data: { post_community_id: ID, post_community_name: community_name, post_community_alias: community_alias,}

		}).done(function( reponse ) {
			if( reponse == "1" ) {
				community_name_id = "#community_name_" + ID;
				$( community_name_id ).html( community_name );

				community_alias_id = "#community_alias_" + ID;
				$( community_alias_id ).html( community_alias );

				community_updated_id = "#community_updated_" + ID;
				$( community_updated_id ).html( date_time() );

				$( THIS ).attr("src","/Admin/img/validate_green.png");
				setTimeout( function(){ $( THIS ).attr("src","/Admin/img/edit.png"); }, 1200);
				var onclick = "edit_community(this," + ID + ")";
				$( THIS ).attr( "onclick" , onclick );
									
			}else{
				$( THIS ).attr("src","/Admin/img/validate_red.png");
				setTimeout( function(){ $( THIS ).attr("src","/Admin/img/validate.png"); }, 1200);		
			}
		}).fail(function() {
		    $( THIS ).attr("src","/Admin/img/validate_red.png");
			setTimeout( function(){ $( THIS ).attr("src","/Admin/img/validate.png"); }, 1200);
		});
		setTimeout( function(){ communities_updating = true; }, 1250);
	};
};



function date_time(){
	var time_now = new Date();
	var minute = time_now.getMinutes();
	var hour = time_now.getHours();
	var day = time_now.getDate();
	var month = time_now.getMonth() + 1;
	var year = time_now.getFullYear();

	if (minute < 10) { minute = "0" + minute };
	if (hour < 10) { hour = "0" + hour };		
	if (month < 10) { month = "0" + month };
	if (day < 10) { day = "0" + day };	

	return day + "/" +  month + "/" +  year + " " + hour + ":" + minute;
}