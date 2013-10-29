<?php
/*****************************************************************************************
** © 2013 POULAIN Nicolas – nico.public@ouvaton.org - http://tounoki.org **
** **
** Ce fichier est une partie du logiciel libre WeAreMuseomix, licencié **
** sous licence "CeCILL version 2". **
** La licence est décrite plus précisément dans le fichier : LICENSE.txt **
** **
** ATTENTION, CETTE LICENCE EST GRATUITE ET LE LOGICIEL EST **
** DISTRIBUÉ SANS GARANTIE D'AUCUNE SORTE **
** ** ** ** **
** This file is a part of the free software project We Are Museomix,
** licensed under the "CeCILL version 2". **
**The license is discribed more precisely in LICENSES.txt **
** **
**NOTICE : THIS LICENSE IS FREE OF CHARGE AND THE SOFTWARE IS DISTRIBUTED WITHOUT ANY **
** WARRANTIES OF ANY KIND **
*****************************************************************************************/
if (stristr($_SERVER['REQUEST_URI'], "page."))
	die(_('Vous vous engagez sur une voie risquée et votre IP est enregistrée :(')) ;
?>
<h2>Test insertion distante</h2>

<?
die('Comment for test') ;
?>

<div style="height:400px;background-color:#A0A0A0;width:260px;float:left">
	<div id="oneMuseomixer">
		<a href="http://museomix.tounoki.org">We are museomix...</a>
	</div>
	<small>
	<a href="#" onclick="clearInterval(timer);loadMuseomixers();return false;">5 other museomixers ?</a></small>
</div>
<script type="text/javascript" >
function nextMuseomixer() {
		var k = 0 ;
		for ( var i = 0 ; jQuery('#'+museomixers[i]).css('display') == "none" ; i++ ) {k = i+1 ;}
		jQuery( "#"+museomixers[k] ).hide() ;
		if ( k < museomixers.length-1 ) jQuery( "#"+museomixers[k+1] ).fadeIn() ;
		else jQuery("#"+museomixers[0]).fadeIn() ; } // end nextMuseomixer
function loadMuseomixers() {
	jQuery.ajax({ // récupère les données distantes
		url: 'http://127.0.0.1/html/museomix2/script-remoteuser',
		crossDomain: true,
		success: function(data) {
			jQuery( "#oneMuseomixer" ).html(data);
			jQuery( ".remoteuserbox" ).hide() ;
			museomixers = new Array() ;
			jQuery( ".remoteuserbox" ).each(function( index ) { // crée le tableau
				//alert( jQuery( this ).attr("id") ) ;
				museomixers[museomixers.length]= jQuery( this ).attr("id") ;
			});
			jQuery( "#"+museomixers[0] ).fadeIn() ;
			timer = setInterval( "nextMuseomixer()",13000) ;
		},
		error:function (xhr, status, error){
			jQuery( "#oneMuseomixer" ).html("Error on remote server :(");
		},
		dataType: 'html'}); } // end loadMuseomixers
jQuery(document).ready(function($){
	loadMuseomixers() ;
	}) ;
</script>
