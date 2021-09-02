<?php
	$homePath='./';
	require_once($homePath.'include/defines.php');
	require_once($homePath.'include/functions.php');
	require_once($homePath.'include/htmlFunctions.php');
	require_once($homePath.'include/connection.php');
	
	
?>
<?php
	$htmlCode=''; $tempcode='';	
	$htmlCode=$htmlCode.beginHtml('Article',$homePath);
	$htmlCode=$htmlCode.extraDesign('article',$homePath);
	$htmlCode=$htmlCode.placeHead($homePath);
	$htmlCode=$htmlCode.placeMainContent($homePath);
	
	$articleId=0;
	if (isset($_GET['articleId']))
		$articleId=$_GET['articleId'];
	
	
	
	$conn=createConnection($dsn,$dbUser,$dbPass);
	
	/* echo $conn->getAttribute(PDO::ATTR_DRIVER_NAME); //This returns mysql because it'd my current db driver */
	
	
	if ($articleId==0){
		
		/*This is executed when any specific article is not specified at the end of the link by 'get' method */
		$myquery='SELECT * FROM `article` ORDER BY RAND()';
		try{
			$allRows=$conn->query($myquery);
		}catch(PDOException $e){
			die('Dying because of error!');
		}	
		
		foreach($allRows as $row){
			$tempcode=createContentBatta($row,100);
			$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeMidCol%#',$tempcode);
		}
	}else{
		/*When an article is specified in the link of the article page, this block of code is executed */
		$myquery='SELECT * FROM `article` where articleId='.$articleId;
	
	try{
		$requiredRow=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error!');
	}
		foreach($requiredRow as $row){
			$tempcode=createContentBatta($row,0);
			$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeMidCol%#',$tempcode);
		}
	
	}
	
	
	/* The following paragraph of code is for creating the list of elements in the batta */
	
	$myquery="SELECT * FROM `article` ORDER BY(views) DESC LIMIT 10";
	
	try{
		$topRows=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error in fetching recent posts!'.$e->getMessage());
	}	
	
	$tempcode=createLeftBatta("Most Viewed",$topRows);
	$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeLeftCol%#',$tempcode);
	
	
	$myquery="SELECT * FROM `article` ORDER BY(recommended) DESC LIMIT 10";
	
	try{
		$topRows=$conn->query($myquery);
	}catch(PDOException $e){
		die('Dying because of error in fetching recent posts!'.$e->getMessage());
	}	
	
	$tempcode=createRightBatta("Recommended",$topRows);
	$htmlCode=insertCode($htmlCode,'#%1YearGuaranteeRightCol%#',$tempcode);


	$htmlCode=$htmlCode.placeFoot($homePath);
	$htmlCode=$htmlCode.endHtml($homePath);

	htmlShow($htmlCode);
?>