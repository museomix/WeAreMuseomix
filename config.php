<?php
/*****************************************************************************************
** © 2011 POULAIN Nicolas – nicolas.poulain@ouvaton.org **
** **
** Ce fichier est une partie du logiciel libre We Are Museomix, licencié **
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
/**
 * Base configuration of your app
 *
 * @package We Are Museomix
 */

define ('HTTP_BASE','http://mywebsite/myDir') ; // without end /

define('SITE_NAME','WeAreMuseomix') ;
define('MAIL_ADMIN','adress@domain.com') ;
define('WEBMASTER','Me') ;

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Le nom de la base de données */
define('DB_NAME', 'museomix');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'dbuser');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '######');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', '127.0.0.1');

// méthode hussarde - à mettre en base après
$startSentence = array(
	"I museomix because",
	"Je museomixe parce que",
	"Je museomixe car",
	"I museomix because I dream of a museum",
	"Je museomixe parce que je rêve d'un musée",
	"I museomix to",
	"Je museomixe pour",
	"For me, Museomix is",
	"Pour moi, Museomix c'est") ;

define('VERSION', '0.1-RC2');


/**************************************************************************************************/

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Le type de collabtion de la base de données.
  * N'y touchez qui si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/ Le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'put your unique phrase here');
define('SECURE_AUTH_KEY', 'put your unique phrase here');
define('LOGGED_IN_KEY', 'put your unique phrase here');
define('NONCE_KEY', 'put your unique phrase here');
/**#@-*/

/**
 * Préfixe de base de données pour les tables.
 *
 * Il faut changer le script d'installation si vous changez ces valeurs
 */
$table_prefix  = 'mm_'; // not used
define ('TABLE_PREFIX', 'mm_') ; // not used

define ('TABLE_USERS','mm_users') ;
define ('TABLE_EVENTS','mm_events') ;
define ('TABLE_PARTICIPATIONS','mm_participations') ;


/**
 * Langue de localisation, par défaut en Français.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier /locale.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans /locale, et réglez l'option ci-dessous à "fr_FR".
 */
define ('LANG', 'fr_FR') ;
define ('EXPLICIT_LANG', 'french') ;
define ('SHORTLANG', 'fr') ;
define ('COUNTRY', 'France') ;
define ('TIMEZONE','Europe/Paris') ;

/** Chemin absolu de WordPress vers le dossier WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');


/** Suite de la config, propre à RaR */

define ('DEBUG',false) ;

define ('FORMAT_DATE','%A %e %B %Y') ;
define ('FORMAT_TIME','%H:%M') ;

// theme
define ('THEME','default') ; // adress of images : HTTP_BASE."/content/themes/".THEME."/images"

//define('CNIL_NUMBER','123456') ;

