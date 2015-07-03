<?php

	$homePath='./';
	require_once($homePath.'include/defines.php');
	require_once($homePath.'include/functions.php');
	require_once($homePath.'include/htmlFunctions.php');
	require_once($homePath.'include/connection.php');
	
	
?>
<?php
	$htmlCode='';
	$htmlCode=$htmlCode.beginHtml('Find Me!',$homePath);
	$htmlCode=$htmlCode.extraDesign('contact',$homePath);
	$htmlCode=$htmlCode.placeHead($homePath);
	$htmlCode=$htmlCode.placeMainContent($homePath);
	
	
	$conn=createConnection($dsn,$dbUser,$dbPass);
	$myquery='SELECT * FROM `article`';
	
	try{
		$allRows=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error!');
	}	
	
	foreach($allRows as $row){
		$tempcode=createContentBatta($row,200);
		$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeMidCol%#',$tempcode);
	}
	
	
	$myquery="SELECT * FROM `article` ORDER BY(dateTime) DESC LIMIT 20";
	
	try{
		$topRows=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error in fetching recent posts!'.$e->getMessage());
	}	
	
	$tempcode=createLeftBatta("Recent Posts",$topRows);
	$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeLeftCol%#',$tempcode);
	
	
	
	$tempcode=createRightBatta("Recommended",$topRows);
	$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeRightCol%#',$tempcode);

	
	$htmlCode=$htmlCode.placeFoot($homePath);
	$htmlCode=$htmlCode.endHtml($homePath);

	
	htmlShow($htmlCode);
?>
