<h2><?php echo _('Inscription') ?></h2>
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

if ( empty($_REQUEST['key']) ) die(_('Vous devez avoir une clé pour activer cette page') ) ;
if ( empty($_REQUEST['user_email']) ) die(_('Vous devez avoir un nom d\'utilisateur pour activer cette page') ) ;

$key = dataClean($_REQUEST['key'],'alnum') ;
$login = dataClean($_REQUEST['user_email'],'mail') ;

$sql = "SELECT COUNT(*) AS nb FROM ".TABLE_USERS." WHERE user_activation_key LIKE '$key' AND user_email LIKE '$login'" ;
$results = UPDO::getInstance()->query( $sql ) ;
foreach ( $results as $result ) {
	$count = $result['nb'] ;
}

if ( isset($_POST['send']) && !empty($_POST['user_pass']) ) {
	$pass = dataClean($_POST['user_pass'],'alnum') ;
	$sql = "SELECT ID FROM ".TABLE_USERS." WHERE user_activation_key LIKE '$key' AND user_email LIKE '$login'" ;
	$results = UPDO::getInstance()->query( $sql ) ;
	foreach ( $results as $result ) {
		$id = $result['ID'] ;
	}
	$new_user = new user($id) ;
	$new_user->loadDataFromID() ;
	$new_user->setData( array('user_activation_key'=>'','user_pass'=>$pass,'user_status'=>'00011') ) ;
	if ( DEBUG ) print_r($new_user) ;
	if ( $new_user->save() ) {
		// success
		echo '<p class="success">'._('Votre compte est validé.').'</p>' ;
		if ( $new_user->check() ) {
			echo '<p class="success">'._('Vous êtes connecté(e).').'</p>' ;
			echo '<p>'._('Nous vous invitons dans un premier temps à mettre à jour les informations concernant votre compte')." : ".'<a href="page-myaccount">'._('Mon compte').'</a></p>' ;
			echo '<p>'._('Bienvenue sur le mur des museomixers ;o)').'</p>' ;
		}
		else
			echo '<p class="error">'._('Vous n\'êtes pas connecté(e).').'</p>' ;
		// merci de complété votre compte + lien vers modification des infos persos
		// + blablab saisie voiture et trajets
	}
	else {
		// error
		echo '<p class="error">'._('Erreur lors de la validation de votre compte.').'</p>' ;
	}
}
else {
	if ( $count == 1 ) {
		?>
		<script src="includes/js/library.php" type="text/javascript"></script>
		<script src="includes/js/sha1.js" type="text/javascript"></script>
		<form name="signIn" id="signIn" method="post" action="" onSubmit="with(document.signIn){sha1hash(pass,user_pass)}">
			<fieldset>
			<legend><?php echo _('Définition de votre mot de passe') ?></legend>

			<label for="pass"><?php echo _('Mot de passe') ; ?></label>
			<br />
			<input type="password" name="pass" value="" size="15" />
			<br />

			<input type="hidden" name="user_email" value="<?php echo $login ?>" />
			<input type="hidden" name="user_activation_key" value="<?php echo $key ?>" />
			<input type="hidden" name="user_pass" />

			<input type="submit" name="send" value="<?php echo _('Valider')?>" />

			</fieldset>
		</form>
		<?php
	}
	else {
		echo '<p class="error">'._('Il y a un problème avec votre clé d\'activation.').'</p>' ;
	}
}


?>