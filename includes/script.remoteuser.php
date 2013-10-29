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

<style type="text/css">
.remoteuserbox {
	display: none ;
	border: 1px solid #808080 ;
	width: 240px ;
	padding: 5px ;
	margin: 5px ;
	background-color: #FFF ;
	border-radius: 5px 5px 0 5px ;
	}
</style>


<?php

if ( DEBUG ) debug($user) ;

$users = getAllUsers() ;
shuffle($users) ;


if ( count($users) >= 4 ) {
	for ( $i = 0 ; $i < 5 ; $i++ ) {
		$users[$i]->printData(6) ;
	}
}
else {
	// print error
	echo _("Pas assez d'utilisateurs") ;	
}
?>