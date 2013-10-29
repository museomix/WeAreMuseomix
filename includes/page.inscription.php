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
<h2><?php echo _('Inscription') ?></h2>
<?php
$new_user = new user() ;

// tests values
$valid = true ;
if ( !empty($_POST['send']) ) {

	$_POST['user_email'] = dataClean($_POST['user_email'],"mail") ;
	$new_user->setData($_POST) ;
	// tests
	// valid email
	if (!preg_match('/^[A-Z0-9._-]+@[A-Z0-9][A-Z0-9.-]{0,61}[A-Z0-9]\.[A-Z.]{2,6}$/i',$new_user->getData('user_email') ) ) {
		$error[] = _('Adresse de courriel Invalide') ;
		$valid = false ;
	}
	// email must be unique
	$sql = "SELECT COUNT(*) AS nb FROM ".TABLE_USERS." WHERE user_email LIKE '{$new_user->getData('user_email')}'" ;
	$results = UPDO::getInstance()->query( $sql ) ;
	foreach ( $results as $result ) {
		$count = $result['nb'] ;
	}
	if ( $count > 0 ) {
		$error[] = _('Cette adresse mail est déjà utilisée, veuillez en choisir une autre.') ;
		$valid = false ;
	}
}

// if everything is ok, we send mail with activation key
if ( !empty($_POST['send']) && $valid === true ) {
	$key = sha1( SITE_NAME.time().rand(1,99) ) ;
	if (DEBUG) echo "The activation key is : $key<br/>" ;
	$pass = sha1( time().SITE_NAME.rand(1,99) ) ; // random pass, because can not be null
	$new_user->setData(
		array('user_activation_key'=>$key,
		'user_pass'=>$pass,
		'user_status'=>'00000',
		'user_registered'=>1)
		) ;

	if ( $new_user->save() ) {
		echo '<p class="success">'._('Vous allez recevoir un message pour terminer votre inscription.').'</p>' ;

		// send email with activation link
		$message = _("Bonjour\nVous venez de vous inscrire sur le site") ;
		$message .= " : ".SITE_NAME."\n" ;
		$message .= _("Votre login sera") ;
		$message .= " : ".$new_user->getData('user_email')."\n" ;
		$message .= _('Afin de poursuivre votre inscription, merci de vous rendre à l\'adresse suivante') ;
		$message .= "\n".HTTP_BASE."/page-inscription2?user_email=".$new_user->getData('user_email')."&key=$key\n" ;
		$message .= _('Cordialement, l\'équipe du site') ;

		// création du header du message
		$headers = "From: ".MAIL_ADMIN."\n" ;
		$headers.= "Reply-To: ".MAIL_ADMIN."\n" ;
		$headers.= "X-Mailer: PHP/".phpversion()."\n" ;
		$to = $new_user->getData('user_email') ;
		$subject = _('Votre inscription sur')." ".SITE_NAME ;
			//$headers.= "Cc: $mail_webmaster\n" ;
		if (DEBUG) echo "<textarea style='width:80%'>$headers\n$subject\n$message</textarea>" ;

		// send the mail
		$message = utf8_decode($message) ;
		if ( mail($to,$subject,stripslashes($message),$headers) ){
			// Si le mail a bien été envoyé, message de confirmation
			
			// inscription without checking mail				
				$link = HTTP_BASE."/page-inscription2?user_email=".$new_user->getData('user_email')."&key=$key" ;
				echo "<p><a href=\"$link\">"._('Ajouter tout de suite sa fiche...')."</a></p>";
			
			echo '<p class="success">'._('Vous allez recevoir ce lien par courriel si vous souhaitez complétez votre fiche plsu tard...')."</p>";
			
		}
		else {
			// sinon, message d'erreur.
			echo '<p class="error">'._('Votre mail n\'a pas pu être envoyé')."</p>";
			// temp for work on static station
			echo "<script>alert(\"Votre lien : ".HTTP_BASE."/page-inscription2?user_email=".$new_user->getData('user_email')."&key=$key\");</script>" ;
		}
	}
	else {
		echo '<p class="error">'._('Echec lors de votre inscription.').'</p>' ;
	}
}

else {
	// error messages
	if ( $valid == false ) {
		echo '<p class="error">'.implode('<br/>',$error).'</p>' ;
	}
	// print the form
	?>
	<form id="signIn" method="post" action="">
		<fieldset>
		<legend><?php echo _('Formulaire d\'inscription') ?></legend>

		<label for="user_email"><?php echo _('Courriel')?></label>
		<input type="text" size="20" name="user_email" value="<?php echo $new_user->getData('user_email') ?>" />

		<br /><br />

		<input type="submit" name="send" value="<?php echo _('Valider')?>" />

		</fieldset>
	</form>
<?php
}
?>