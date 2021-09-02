<?php

	$homePath='./';
	require_once($homePath.'include/defines.php');
	require_once($homePath.'include/functions.php');
	require_once($homePath.'include/htmlFunctions.php');
	require_once($homePath.'include/connection.php');
	
	
?>
<?php
	$htmlCode=''; $tempcode='';
	$htmlCode=$htmlCode.beginHtml('Find Me!',$homePath);
	$htmlCode=$htmlCode.extraDesign('contact',$homePath);
	$htmlCode=$htmlCode.placeHead($homePath);
	$htmlCode=$htmlCode.placeMainContent($homePath);
	
	
	$conn=createConnection($dsn,$dbUser,$dbPass);
	$myquery="SELECT *FROM `article` WHERE `article`.`aoContact`=1 AND `article`.`authorSignature`='".$adminSignature."' LIMIT 10";
	
	try{
		$allRows=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error fetching main contents!'.$e->getMessage());
	}	
	
	foreach($allRows as $row){
		$tempcode=createContentBatta($row,1000);
		$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeMidCol%#',$tempcode);
	}
	
	
		
	/* The following block of code is for creating the list of elements in the left batta */
	
	$myquery="SELECT * FROM `article` WHERE `article`.`aoContact`=1 AND `article`.`remarks`='social' ORDER BY(dateTime) DESC LIMIT 10";
	try{
		$topRows=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error in fetching Hobbies!'.$e->getMessage());
	}	
	
	$tempcode=createLeftBatta("My Accounts",$topRows);
	$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeLeftCol%#',$tempcode);
	
	
	$myquery="SELECT * FROM `article` WHERE `article`.`aoContact`=1 AND `article`.`remarks`='friend' ORDER BY RAND() LIMIT 10";
	try{
		$topRows=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error in fetching recent posts on hobbies!'.$e->getMessage());
	}
	$tempcode=createRightBatta("My Circle",$topRows);
	$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeRightCol%#',$tempcode);



	
	$htmlCode=$htmlCode.placeFoot($homePath);
	$htmlCode=$htmlCode.endHtml($homePath);

	
	htmlShow($htmlCode);
?>
