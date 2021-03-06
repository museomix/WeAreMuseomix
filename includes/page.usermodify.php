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

// test accès droit utilisateur

?>

<h2><?php echo ('Modification de votre compte')?></h2>

<?php

// $user is already constructed and loaded
$user_temp = &$user ;

if ( $user_temp->getRight(1) ) {
	// tests values
	$valid = true ;
	if ( !empty($_POST['send']) ) {

		$user_temp->setData($_POST) ;
		if (!preg_match('/^[A-Z0-9._-]+@[A-Z0-9][A-Z0-9.-]{0,61}[A-Z0-9]\.[A-Z.]{2,6}$/i',$user_temp->getData('user_email') ) ) {
			$error[] = _('Adresse de courriel invalide') ;
			$valid = false ;
		}
		/*
		if ( empty($_POST['user_email']) ) {
			$error[] = _('') ;
			$valid = false ;
		}
		if ( preg_match('/^[0-9]{4}$/',$_POST['']) == 0 ) {
			$error[] = _('') ;
			$valid = false ;
		}*/
	}

	if ( !empty($_POST['send']) && $valid === true ) {
		// save the data form
		if ( $user_temp->save() ) {
			
			
			// traite participation à museomix tables events et participations
			$events = getAllEvents() ; // all events
			
			$userParticipations = $user->getMyParticipations() ; // array of objects
			if ( !empty($userParticipations) ) {
				foreach ( $userParticipations as $participation ) {
					$arrOfParticipations[$participation->getData("event_id")] = "event-".$participation->getData("event_id") ;
					$participations["event-".$participation->getData("event_id")] = $participation ; // array of objects part
				}
			}
			else {
				$arrOfParticipations = array() ;
			}
			//print_r($_POST) ;
			
			if ( !empty($events) ) {
				foreach ( $events as $event ) {
					$name = "event-".$event->getID() ;
/*
-          1 Si checké (POST[‘event-id’] == yes) et existe ( in_array(event-id,$eventsUser) !== false  ) : rien

-          2 Si check et existe pas : créé participation

-          3 Si pas check et existe : supprime participation

-          4 Si pas check et existe pas : rien*/

						// cas 2 si checké et si participation existe pas
						if ( isset($_POST[$name]) && in_array($name,$arrOfParticipations) === false ) {
							
							$part = new participation() ;
							$part->setData( array( 'user_id' => $user->getID() , 'event_id' => $event->getID() ) ) ;
							$part->save() ;
							$part = NULL ;
						}
						if ( !isset($_POST[$name]) && in_array($name,$arrOfParticipations) === true ) {
							
							if ( !empty($participations[$name]) ) $participations[$name]->delete() ;
						}
						
						
						/*$name = "event-".$event->getID() ;
						$checked = NULL ;
						if ( in_array($name,$arrOfParticipations) ) $checked = " checked " ;
						echo "<input $checked type=\"checkbox\" name=\"$name\" >" ;
						echo "<label style='display:inline' for=\"$name\">". $event->getData("event_name")."</label>&nbsp; &nbsp;" ;
						*/
				}				
			}			
			
			
			
			$user->imageCacheUnlink() ;
			echo '<p class="success">'._('Vos modifications ont bien été enregistrées.').'</p>' ;
			echo '<h3>'._('Vos informations telles qu\'elles apparaîtront aux autres usagers :').'</h3>' ;
			$user_temp->printData(0) ;
			echo "<p><a href='page-myaccount'>"._('Retour à mon compte')."</a></p>" ;
		}
		else {
			echo '<p class="error">'._('Echec.').'</p>' ;
		}
	}
	else {
		// error messages
		if ( $valid == false ) {
			echo '<p class="error">'.implode('<br/>',$error).'</p>' ;
		}
		// print the form
		?>
		<form name="userForm" method="POST" action="page-usermodify">
			<fieldset>
			<legend><?php echo _('Vos informations')." : ".$user_temp->getData('display_name');?></legend>

			<input name="ID" type="hidden" value="<?php echo $user_temp->getID() ?>" />
			
			<label for="user_startpart"><?php echo _('Constituez votre phrase / Make your own sentence')?></label>
			<select name="user_startpart">
				<?php
				foreach ($startSentence as $Imuseomix) {
					$selected = NULL ;
					if ( $Imuseomix == $user_temp->getData('user_startpart') ) $selected = "selected" ;
					echo "<option $selected value=\"$Imuseomix\">{$Imuseomix}...</option>\n" ;
					}
				?>
			</select>
			<br/>
			
			<label for="user_participation"><?php echo _('<em>suite libre...</em>')?></label>
			<textarea name="user_participation" ><?php 
			if ( $user_temp->getData('user_participation') ) 
				echo $user_temp->getData('user_participation') ;
			//else 
				//echo _('car/pour/parce que/because/to...') ;?></textarea>
			<br /><br />

			<label for="user_email"><?php echo _('Adresse de courriel')?></label>
			<input name="user_email" type="text" size="30" value="<?php echo $user_temp->getData('user_email') ?>"/>
			<br /><br />
			
			<!--
			<label for="user_lang"><?php echo _('Langue (en_US ou fr_FR en attendant le select :\)')?></label>
			<input name="user_lang" type="text" size="30" value="<?php echo $user_temp->getData('user_lang') ?>"/>
			<br /><br />
			-->			
			
			<label for="display_name"><?php echo _('Nom affiché')?></label>
			<input name="display_name" type="text" size="30" value="<?php echo $user_temp->getData('display_name') ?>"/>
			<br /><br />

			<label for="user_url"><?php echo _('URL de mon site')?></label>
			<input name="user_url" type="text" size="30" value="<?php echo $user_temp->getData('user_url') ?>"/>
			<br /><br />

			<label for="user_twitteraccount"><?php echo _('Compte twitter')?></label>
			<input name="user_twitteraccount" type="text" size="30" value="<?php echo $user_temp->getData('user_twitteraccount') ?>"/>
			<br /><br />
			
			<label for="user_presentation"><?php echo _('Présentation')?></label>
			<textarea name="user_presentation" ><?php echo $user_temp->getData('user_presentation') ?></textarea>
			<br /><br />
			
			<?
			echo "<p>"._("J'ai participé ou je participe à ces museomix - I took/take part at this museomix")."<p>" ;

			$events = getAllEvents() ; // all events
			
			$userParticipations = $user->getMyParticipations() ; // array of objects
			if ( !empty($userParticipations) ) {
				foreach ( $userParticipations as $participation ) {
					$arrOfParticipations[$participation->getData("event_id")] = "event-".$participation->getData("event_id") ;
				}
			}
			else {
				$arrOfParticipations = array() ;
			}
			
			if ( !empty($events) ) {
				foreach ( $events as $event ) {
						$name = "event-".$event->getID() ;
						$checked = NULL ;
						if ( in_array($name,$arrOfParticipations) ) $checked = " checked " ;
						echo "<input $checked type=\"checkbox\" name=\"$name\" >" ;
						echo "<label style='display:inline' for=\"$name\">". $event->getData("event_name")."</label>&nbsp; &nbsp;" ;
				}				
			}
			
			?>
			


			<input type="submit" name="send" value="<?php echo _('Enregistrer')?>" />
			</fieldset>
		</form>
		<?php
	}
}
else {
	echo _('Votre compte est désactivé.') ;
}


?>