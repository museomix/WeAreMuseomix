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


echo '<h2>'._('Votre compte').'</h2>' ;

if ( $user->getRight(1) ) {
	if ( isset($_POST['send']) && !empty($_POST['user_pass']) ) {
		$password = dataClean($_REQUEST['user_pass'],'alnum') ;
		$user->setData( array('user_pass' => $password) ) ;
		if ( $user->save() ) {
			echo '<p class="success">'._('Votre nouveau mot de passe est bien enregistré.').'</p>' ;
		}
		else {
			echo '<p class="error">'._('Erreur lors de l\'enregistrement de votre mot de passe.').'</p>' ;
		}
	}
	else {
		?>
		
		<script src="includes/js/library.php" type="text/javascript"></script>
		<script src="includes/js/sha1.js" type="text/javascript"></script>
		
		<form name="signIn" id="signIn" method="post" action="" onSubmit="with(document.signIn){sha1hash(pass,user_pass)}">
			<fieldset>
			<legend><?php echo _('Définition de votre nouveau mot de passe') ?></legend>

			<label for="pass"><?php echo _('Mot de passe') ; ?></label>
			<br />
			<input type="password" name="pass" value="" size="15" />
			<br />
			<input type="hidden" name="user_pass" />

			<input type="submit" name="send" value="<?php echo _('Valider')?>" />
			</fieldset>
		</form>
		<?php
	}
	echo "<p><a href='page-myaccount'>"._('Retour à ma page')."</a></p>" ;
}
else {
	echo '<p>'._('Vous n\'avez pas les droits suffisants pour cette action.').'</p>' ;
}
?>