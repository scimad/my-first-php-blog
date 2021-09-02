<?php

function insertCode($hayStack,$needle,$tempcode){
	$p=strpos($hayStack,$needle);
	$hayStack=substr($hayStack,0,$p).$tempcode.substr($hayStack,$p);
	return $hayStack;
}
function replaceCode($hayStack,$needle,$tempcode){
	$p=strpos($hayStack,$needle);
	$hayStack=substr($hayStack,0,$p).$tempcode.substr($hayStack,$p+strlen($needle));
	return $hayStack;
}


function htmlShow($htmlCode){
	$htmlCode=replaceCode($htmlCode,'#%1YearGuaranteeLeftCol%#','');
	$htmlCode=replaceCode($htmlCode,'#%1YearGuaranteeMidCol%#','');
	$htmlCode=replaceCode($htmlCode,'#%1YearGuaranteeRightCol%#','');
	echo $htmlCode;	
}


?>