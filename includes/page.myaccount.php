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

<h2><?php echo ('Utilisateur')?></h2>

<?php

if ( DEBUG ) debug($user) ;

if ( $user->getRight(1) ) {

	// my account
	echo "<h3>"._('Mes informations personnelles')."</h3>" ;

	$user->printData(0) ;
	
	// afiche anciennes particpations à MM
	$buffer = $user->getMyParticipations() ;
	if ( !empty($buffer) ) {	
		foreach ( $buffer as $jyete ) {
			$jyete->printData() ;		
			}
	}
	// modify my account
	echo $user->getAdminBar('<hr />','') ;
	
	echo "<h3 style='clear:both'>"._('Mon affiche')."</h3>" ;
	
	echo $user->getImage(640,"bausson2", " style=\"border:1px solid black\" " ) ;

}
else {
	echo _('Vous devez être connecté ou vous n\'avez pas les droits nécessaires pour accéder à cette page.') ;
}

?>