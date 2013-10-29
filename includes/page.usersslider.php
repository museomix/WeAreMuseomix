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
<h2><?php echo ('Some of us...')?></h2>

<!-- Anything Slider optional plugins -->
<script src="./includes/js/AnythingSlider-master/js/jquery.easing.1.2.js"></script>

<!-- Anything Slider -->
<link href="./includes/js/AnythingSlider-master/css/anythingslider.css" rel="stylesheet">
<script src="./includes/js/AnythingSlider-master/js/jquery.anythingslider.min.js"></script>

<!-- Anything Slider optional FX extension -->
<script src="./includes/js/AnythingSlider-master/js/jquery.anythingslider.fx.min.js"></script>

<?php

if ( DEBUG ) debug($user) ;

$users = getAllUsersWithMedia() ;
shuffle($users) ;

$min = min( array( count($users), 12 ) ) ;

echo "<ul id=\"slider2\">" ;

for ( $i=0 ; $i < $min ; $i++ ) {
//foreach( $users as $newUser ) {
	
	$users[$i]->printData(3) ;
	echo "\n" ;
}
echo "</ul>" ;
?>

<script>
jQuery(function(){
 jQuery('#slider2') // Demo 2 code, using FX base effects
  .anythingSlider({
   resizeContents      : false,
   //navigationFormatter : function(i, panel){
   // return ['Recipe', 'Quote', 'Image', 'Quote #2', 'Image #2', 'Test'][i - 1];
   //}
  })
  .anythingSliderFx({
    // base FX definitions
    // '.selector' : [ 'effect(s)', 'size', 'time', 'easing' ]
    // 'size', 'time' and 'easing' are optional parameters, but must be kept in order if added
    '.quoteSlide:first > *' : [ 'grow', '24px', '400', 'easeInOutCirc' ],
    '.quoteSlide:last'      : [ 'top', '500px', '400', 'easeOutElastic' ],
    '.expand'               : [ 'expand', '10%', '400', 'easeOutBounce' ],
    '.textSlide h3'         : [ 'top fade', '200px', '500', 'easeOutBounce' ],
    '.textSlide img,.fade'  : [ 'fade' ],
    '.textSlide li'         : [ 'listLR' ]
  });
});
</script>