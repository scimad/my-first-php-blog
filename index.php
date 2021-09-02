<?php

	/*This is the homepage of the main website*/
	$homePath='./';
	require_once($homePath.'include/defines.php');
	require_once($homePath.'include/functions.php');
	require_once($homePath.'include/htmlFunctions.php');
	require_once($homePath.'include/connection.php');
	
?>
<?php
	$htmlCode=''; $tempcode='';
	$htmlCode=$htmlCode.beginHtml('Home',$homePath);
	$htmlCode=$htmlCode.extraDesign('home',$homePath);
	$htmlCode=$htmlCode.placeHead($homePath);
	$htmlCode=$htmlCode.placeMainContent($homePath);
	
	$conn=createConnection($dsn,$dbUser,$dbPass);
	
	
	//For Main ContentBatta
	$myquery="SELECT *FROM `article` WHERE `article`.`permalink`='SciMad' LIMIT 10";
	
	try{
		$allRows=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error fetching main contents!'.$e->getMessage());
	}	
	
	foreach($allRows as $row){
		$tempcode=createContentBatta($row,300);
		$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeMidCol%#',$tempcode);
	}
	
	$myquery="SELECT *FROM `article` WHERE `article`.`aoHome`=1 AND `article`.`verified`=1 LIMIT 5";
	
	try{
		$allRows=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error fetching main contents!'.$e->getMessage());
	}	
	
	foreach($allRows as $row){
		$tempcode=createContentBatta($row,200);
		$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeMidCol%#',$tempcode);
	}
	
	
	/* The following paragraph of code is for creating the list of elements in the left batta */
	
	$myquery="SELECT * FROM `article` WHERE `article`.`authorSignature`='".$adminSignature."' ORDER BY(dateTime) DESC LIMIT 10";	
	try{
		$topRows=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error in fetching recent posts!'.$e->getMessage());
	}
	$tempcode=createLeftBatta("Recent Posts",$topRows);
	$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeLeftCol%#',$tempcode);
		
		
	$myquery="SELECT * FROM `article` WHERE (NOT `article`.`authorSignature`='".$adminSignature."') AND (`article`.`verified`=1) ORDER BY(dateTime) DESC LIMIT 10";	
	try{
		$topRows=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error in fetching recent posts!'.$e->getMessage());
	}
	$tempcode=createRightBatta("Posts By Others",$topRows);
	$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeRightCol%#',$tempcode);

	$htmlCode=$htmlCode.placeFoot($homePath);
	$htmlCode=$htmlCode.endHtml($homePath);

	
	htmlShow($htmlCode);
?>