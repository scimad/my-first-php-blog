<?php
	require_once('include/defines.php');
	require_once('include/functions.php');
	require_once('include/htmlFunctions.php');
	require_once('include/connection.php');
	
	$homePath='./';
?>
<?php
$htmlCode='';
	$htmlCode=$htmlCode.beginHtml('Trending',$homePath);
	$htmlCode=$htmlCode.extraDesign('trending',$homePath);
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
		$tempcode=createContentBatta($row,100);
		$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeMidCol%#',$tempcode);
	}
	
	
	try{
		$topRows=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error in fetching recent posts!'.$e->getMessage());
	}
	
	$tempcode=createLeftBatta('Current Projects',$topRows);
	$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeLeftCol%#',$tempcode);
	
	$tempcode=createRightBatta('Other XYZ',$row);
	$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeRightCol%#',$tempcode);

	$htmlCode=$htmlCode.placeFoot($homePath);
	$htmlCode=$htmlCode.endHtml($homePath);
	
	htmlShow($htmlCode);
?>
