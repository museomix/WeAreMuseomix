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

echo '<h2>'._('Mentions légales').'</h2>' ;

echo '<h3>'._('Responsable de publication').'</h3>' ;

echo '<h3>'._('Mentions de responsabilité').'</h3>' ;

echo '<h3>'._('Données personnnelles').'</h3>' ;
echo '<p>'._('Ce site collecte des données personnelles afin de fonctionner.') ;
echo '<br/>'._('Aucune utilisation commerciale n\'est faite de ces données.') ;
echo '<br/>'._('Les mots de passe que vous utilisez ne sont pas codés en clair dans la base de données et, à ce titre, aucun envoi de mot de passe ne peut être envoyé par les administrateurs du site.') ;
echo '<br/>'._('Ce site est déclaré à la CNIL sous le numéro').' '.CNIL_NUMBER ;
echo '<br/>'._('Vous pouvez accéder aux informations vous concernant et les rectifier si vous le souhaitez en contactant le webmaster de ce site.').'</p>' ;

echo '<h3>'._('Mentions techniques').'</h3>' ;
echo '<p>'._('Ce site est propulsé par Rar, Roule avec RaR.') ;
echo '<br/>'._('La mise en oeuvre technique est assuré par').' '.WEBMASTER.'</p>' ;

echo '<h3>'._('Droits d\'auteurs').'</h3>' ;

echo '<p>'._('Ce site utilise les éléments suivants et nous en remercions ici grandement leurs auteurs :').'</p><ul>' ;
echo '<li>'._('Le set d\'icônes FamFam http://www.famfamfam.com/lab/icons/silk').'</li>' ;
echo '<li>'._('La bibliothèque javascript JQuery et ses dérivés (Licence MIT)').'</li>' ;
echo '<li>'._('Les services géographiques (javascript et API) de CloudMade').'</li>' ;
echo '<li>'._('Les données cartogaphiques mises à disposition par OpenStreetMap').'</li>' ;
echo '<li>'._('La librairie javascript OpenLayers').'</li>' ;
echo '<li>'._('Le thème Twenty Ten de la WordPress Team').'</li>' ;
echo '<li>'._('Les services de Geocoding et de Reverse Geocoding de Nominatim').'</li>' ;
echo '<li>'._('Le tout bien codé en php/mysql et moins bien en javascript').'</li>' ;
echo '</ul>'
?>