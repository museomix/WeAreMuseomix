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

<h2><?php echo _('Connexion') ?></h2>

<p>
<?php
$user = new user() ;
$user->setData($_POST) ;
if ( $user->check() === true ) {
	echo '<p>'._('Bienvenue vous êtes connecté(e)').'</p>' ;
	echo '<p>'._('Vous pouvez').' : </p>' ;
	echo '<ul>' ;
	echo '<li><a href="page-myaccount">'._('Voir et modifier les informations de votre compte').'</a></li>' ;
	echo '</ul>' ;
}
else
	echo _('Mauvais mot de passe ou nom d\'utilisateur') ;

if ( DEBUG ) debug($user) ;

?>
</p>