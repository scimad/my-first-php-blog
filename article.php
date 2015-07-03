<?php
	$homePath='./';
	require_once($homePath.'include/defines.php');
	require_once($homePath.'include/functions.php');
	require_once($homePath.'include/htmlFunctions.php');
	require_once($homePath.'include/connection.php');
	
	
?>
<?php
	$htmlCode='';
	
	$htmlCode=$htmlCode.beginHtml('Article',$homePath);
	$htmlCode=$htmlCode.extraDesign('article',$homePath);
	$htmlCode=$htmlCode.placeHead($homePath);
	$htmlCode=$htmlCode.placeMainContent($homePath);
	
	$articleID=0;
	if (isset($_GET['articleID']))
		$articleID=$_GET['articleID'];
	
	
	
	$conn=createConnection($dsn,$dbUser,$dbPass);
	
	if ($articleID==0){
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
	}else{
		$myquery='SELECT * FROM `article` where articleID='.$articleID;
	
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