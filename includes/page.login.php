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

echo '<h2>'._('Connexion').'</h2>' ;

?>

<script src="includes/js/library.php" type="text/javascript"></script>
<script src="includes/js/sha1.js" type="text/javascript"></script>

<form id="formulaire" name="formulaire" method="post" action="page-login2" onSubmit="with(document.formulaire){sha1hash(pass,user_pass)}">
	<fieldset>
	<legend style="margin-bottom: 5px;"><?php echo _('Identification') ; ?></legend>

	<label for="user_login"><?php echo _('Courriel') ; ?></label>
	<input type="text" name="user_email" value="" />
	<br />
	<br />

	<label for="pass"><?php echo _('Mot de passe') ; ?></label>
	<input type="password" name="pass" value="" /> &nbsp; &nbsp;
	<?php
	echo '<a href="page-forgotpassword">'._('Mot de passe oublié').'</a>' ;
	?>
	<br />
	<br />
	<input type="hidden" name="user_pass" value="" />
	<input type="submit" name="send" value="<?php echo _('Valider') ; ?>" />
	</fieldset>
</form>