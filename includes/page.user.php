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
<h2><?php //echo ('Utilisateur')?></h2>

<?php

if ( DEBUG ) debug($user) ;

if ( !empty($_GET['ID']) ) {
	$ID = $_GET['ID'] ;
	$new_user = new user($ID) ;
	$new_user->loadDataFromID() ;

	//echo "<h3>".$new_user->getName()."</h3>" ;
	$new_user->printData(4) ;
	
	// afiche anciennes particpations à MM
	$buffer = $new_user->getMyParticipations() ;
	if ( !empty($buffer) ) {
		foreach ( $buffer as $jyete ) {
			$jyete->printData() ;		
			}
	}
	//$new_user->printData(2,'<hr style="clear:both"/><p>','</p>') ;	
	
}
else {
	// print error
	echo "Error" ;		
}


?>