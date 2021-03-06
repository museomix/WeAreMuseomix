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

if ( $user->getRight(1) ) {

	// my account
	// print_r($user) ;

}
else {
	echo _('Vous devez être connecté ou vous n\'avez pas les droits nécessaires pour accéder à cette page.') ;
}


// tests values
$valid = true ;
if ( !empty($_POST['send']) ) {
	if ( !isset($_FILES["file"]) ) {
		$error[] = _('Fichier non défini') ;
		$valid = false ;
	}
	if ( !isset($_FILES["file"]) ) {
		$error[] = _('Fichier non défini') ;
		$valid = false ;
	}
	if ( $_FILES["file"]["size"] >= 2000000  ) { // 2 Mo
		$error[] = _('Fichier trop lourd') ;
		$valid = false ;
	}
	$extensions = array('.jpg', '.jpeg','.JPG','.JPEG');
	$extension = strrchr($_FILES['file']['name'], '.');
	if(!in_array($extension, $extensions)) { //Si l'extension n'est pas dans le tableau 
		$error[] = _('Seuls les fichiers jpg sont acceptés') ;
		$valid = false ;
	}
	$img_size = getimagesize($_FILES["file"]['tmp_name']) ;
	// $img_size[0] <= width
	// $img_size[1] <= height
	if ( $img_size[0] < 640 && $img_size[1] < 480) {
		$error[] = _("Taille minimale de l'image 640x480px") ;
		$valid = false ;
	}
	
}

// if everything is ok, we do
if ( !empty($_POST['send']) && $valid === true ) {
	
	if ( $user->getData('user_image') != "" )
		$image_dest = $user->getData('user_image') ;
	else {
		$image_dest = time()."-".rand(1,99).".jpg" ;
		$user->setdata( array('user_image' => $image_dest) ) ;
		$user->save() ;
	}
	
	if ( move_uploaded_file( $_FILES['file']['tmp_name'] , ABSPATH."/content/uploads/".$image_dest) ) {
		
		$user->imageCacheUnlink() ;
		echo '<p>'._('Votre image est enregistrée.').'</p>' ;
		echo '<p><a href="page-myaccount">'._('Retour sur ma page').'</a></p>' ;
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
	<form id="signIn" method="post" action="" enctype="multipart/form-data">
		<fieldset>
		<legend><?php echo _('Formulaire Upload') ?></legend>

		<label for="file"><?php echo _('Image à charger')?></label>
		<input type="file" name="file">
		<br /><br />

		<input type="submit" name="send" value="<?php echo _('Valider')?>" />

		</fieldset>
	</form>
	<?php
	}
	?>