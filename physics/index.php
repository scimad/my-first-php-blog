<?php
	$homePath='../';
	require_once($homePath.'include/defines.php');
	require_once($homePath.'include/functions.php');
	require_once($homePath.'include/htmlFunctions.php');
	require_once($homePath.'include/connection.php');
?>
<?php
	
	$htmlCode='';
	$htmlCode=$htmlCode.beginHtml('Physics',$homePath);
	$htmlCode=$htmlCode.extraDesign('study',$homePath);
	$htmlCode=$htmlCode.placeHead($homePath);
	$htmlCode=$htmlCode.placeMainContent($homePath);
	
	
	$conn=createConnection($dsn,$dbUser,$dbPass);
		
	/* The following block of code is for creating the list of elements in the batta */
	
	$myquery="SELECT * FROM `article` ORDER BY(dateTime) DESC LIMIT 10";
	
	try{
		$topRows=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error in fetching recent posts!'.$e->getMessage());
	}	
	
	$tempcode=createLeftBatta("Recent Posts",$topRows);
	$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeLeftCol%#',$tempcode);
		
	
	$tempcode=createRightBatta("Recent Public Posts",$topRows);
	$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeRightCol%#',$tempcode);
	
	
	$htmlCode=$htmlCode.placeFoot($homePath);
	$htmlCode=$htmlCode.endHtml($homePath);

	htmlShow($htmlCode);
?>
