



var communities_updating = true; // pour empecher double clic abusif

function edit_community(THIS,ID){
	if (communities_updating) {
		var community_edit = "'#community_edit_" + ID + "'";

		var community_name_id = "#community_name_" + ID;
		var community_name = $( community_name_id ).html();
		$( community_name_id ).html('<input class="input_name" maxlength="200" type="texte" id="name_' + ID + '" value="' + community_name + '" onkeypress="if (event.keyCode == 13) update_community(' + community_edit + ',' + ID + ')" >');

		var community_alias_id = "#community_alias_" + ID;
		var community_alias = $( community_alias_id ).html();
		$( community_alias_id ).html('<input class="input_alias" maxlength="4" type="texte" id="alias_' + ID + '" value="' + community_alias + '" onkeypress="if (event.keyCode == 13) update_community(' + community_edit + ',' + ID + ')" >');

		var community_image_id = "#community_image_" + ID;
		var community_image = $( community_image_id ).html();
		var community_image_id_img = community_image_id + " img";
		var community_image_src = $(community_image_id_img).attr("src");
		var src_1 = "'/Admin/img/upload_image_grey.png'";
		var src_2 = "'/Admin/img/upload_image.png'";
		$( community_image_id ).html('<div class="div_image_upload"><input type="file" name="image_file" id="image_file_' + ID + '" onchange="check_image(this,' + ID + ')" data-last_src="' + community_image_src + '" ><img src="/Admin/img/upload_image.png" onMouseOver="src=' + src_1 + '" onMouseOut="src=' + src_2 + '" alt="upload_image" onclick="choose_image(' + ID + ')" /><p>Choisir une image</p></div>');

		var onclick = "update_community(this," + ID + ")";
		$( THIS ).attr( "onclick" , onclick );
		$( THIS ).attr("src","/Admin/img/validate.png");
	};
};


function choose_image(ID){
	var input_id = "#image_file_" + ID;
	$(input_id).click();
};


function check_image(THIS,ID){
	var image_info = $( THIS )[0].files[0];

	var p_id = "#community_image_" + ID + " .div_image_upload p";
	var img_id = "#community_image_" + ID + " .div_image_upload img";

	if ( image_info == undefined ){
		$( p_id ).html("Choisir une image");
		$( img_id ).attr("onmouseout", "src='/Admin/img/upload_image.png'").attr("src", "/Admin/img/upload_image.png");

	}else if ( image_info.type != "image/gif" && image_info.type != "image/jpeg"  && image_info.type != "image/jpg" && image_info.type != "image/pjpeg" && image_info.type != "image/x-png" && image_info.type != "image/png" ){
		$( p_id ).html("Image non valide");
		$( img_id ).attr("onmouseout", "src='/Admin/img/upload_image_red.png'").attr("src", "/Admin/img/upload_image_red.png");

	}else if (image_info.size > 1000000){
		$( p_id ).html("L'image dépasse 1 Mo");
		$( img_id ).attr("onmouseout", "src='/Admin/img/upload_image_red.png'").attr("src", "/Admin/img/upload_image_red.png");

	}else{
		var image_name = image_info.name;

		if( image_name.length > 19 ){
			image_name = image_name.substr(0, 9) + "..." + image_name.substr( image_name.length - 7, 7);
		};

		$( p_id ).html(image_name);
		$( img_id ).attr("onmouseout", "src='/Admin/img/upload_image_green.png'").attr("src", "/Admin/img/upload_image_green.png");
	};
};


function update_community(THIS,ID){
	if (communities_updating) {
		communities_updating = false;
		$( THIS ).attr("src","/Admin/img/validate_grey.png");


		var community_name = $.trim( $( "#name_" + ID ).val() ).replace( /"/g, "''"); // trim suprime les espace avant le premier charactère ainsi que seux après
		var community_alias = $.trim( $( "#alias_" + ID ).val() ).replace( /"/g, "''");
		var community_image = $( "#image_file_" + ID )[0].files[0]; // envoit undefined si il n'y a pas d'image à envoyer

		var formData = new FormData();
		formData.append('post_community_id', ID);
		formData.append('post_community_name', community_name);
		formData.append('post_community_alias', community_alias);
		formData.append('post_community_image', community_image);

		$.ajax({
		  	type: "POST",
		  	url: link_update_community,
		  	data:  formData,
		  	processData: false, // Don't process the files
        	contentType: false, // Set content type to false as jQuery will tell the server its a query string request 

		}).done(function( reponse_json ) {

			var reponse = $.parseJSON( reponse_json );
			var image_error = false;

			if( reponse.name_and_alias_insert == 1 ){
				if ( reponse.image_insert == 1 || ( reponse.image_insert == 0 && community_image == undefined ) ) { // insertion bdd ok
						
						$( "#community_name_" + ID ).html( community_name );
						$( "#community_alias_" + ID ).html( community_alias );
						$( "#community_updated_" + ID ).html( date_time() );

						$( THIS ).attr("src","/Admin/img/validate_green.png");
						setTimeout( function(){ $( THIS ).attr("src","/Admin/img/edit.png"); }, 1200);

						$( THIS ).attr( "onclick" , "edit_community(this," + ID + ")" );

					if ( reponse.image_insert == 1 ) { // insert new image
						$( "#community_image_" + ID ).html( '<img class="community_img" src="' + reponse.new_image_link + '" alt="image_de_couverture" />' );

					}else{ // insert old image
						$( "#community_image_" + ID ).html( '<img class="community_img" src="' + $( "#image_file_" + ID ).attr("data-last_src") + '" alt="image_de_couverture" />' );
					};

				}else{ // error upload image
					$( "#community_image_" + ID + " .div_image_upload p" ).html("Erreur upload image");
					$( "#community_image_" + ID + " .div_image_upload img" ).attr("onmouseout", "src='/Admin/img/upload_image_red.png'").attr("src", "/Admin/img/upload_image_red.png");
					
					image_error = true; //metre var
				};
			};

			if( reponse.name_and_alias_insert == 0 || image_error == true ){ // insertion bdd error
				if ( reponse.name_and_alias_insert == 0 ) { // insertion text error
					$( "#community_name_" + ID + " input" ).addClass("red_outline");
					$( "#community_alias_" + ID + " input" ).addClass("red_outline");
					setTimeout( function(){ $( "#community_name_" + ID + " input" ).removeClass("red_outline");
											$( "#community_alias_" + ID + " input" ).removeClass("red_outline"); }, 1200);
				};

				$( THIS ).attr("src","/Admin/img/validate_red.png");
				setTimeout( function(){ $( THIS ).attr("src","/Admin/img/validate.png"); }, 1200);
			};

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


/*

function print_r(printthis, returnoutput) { // fonction de debug
    var output = '';

    if($.isArray(printthis) || typeof(printthis) == 'object') {
        for(var i in printthis) {
            output += i + ' : ' + print_r(printthis[i], true) + '\n';
        }
    }else {
        output += printthis;
    }
    if(returnoutput && returnoutput == true) {
        return output;
    }else {
        return output;
    }
}

*/
