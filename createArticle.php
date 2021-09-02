<?php
	$homePath='./';
	require_once($homePath.'include/defines.php');
	require_once($homePath.'include/functions.php');
	require_once($homePath.'include/htmlFunctions.php');
	require_once($homePath.'include/connection.php');
	
	require_once($homePath.'include/classes.php');

?>
<?php
	$htmlCode=''; $tempCode='';
	$htmlCode=$htmlCode.beginHtml('Article',$homePath);
	$htmlCode=$htmlCode.extraDesign('article',$homePath);
	$htmlCode=$htmlCode.placeHead($homePath);
	$htmlCode=$htmlCode.placeMainContent($homePath);
	
	
	$conn=createConnection($dsn,$dbUser,$dbPass);
	/*Put a form for admin validation before actually asking for articles.!	*/
	
	if (isset($_POST['submitButton'])){

	
	$aoHome= $aoStudy= $aoArticle= $aoHobbies= $aoTrending= $aoContact= $isProject= false;
	if (isset($_POST['aoHome'])) $aoHome= true;
	if (isset($_POST['aoStudy'])) $aoStudy= true;
	if (isset($_POST['aoArticle'])) $aoArticle= true;
	if (isset($_POST['aoHobbies'])) $aoHobbies= true;
	if (isset($_POST['aoTrending'])) $aoTrending= true;
	if (isset($_POST['aoContact'])) $aoContact= true;
	if (isset($_POST['isProject'])) $isProject= true;

	
		
		
		
		

		$recArticle=new article($_POST['articleTitle'], $_POST['articleText'], $_POST['appearsOn'],$_POST['authorSignature'],$_POST['permalink'],$_POST['related'],$_POST['remarks'],$_POST['meta']);
		
	$tableName='article';	
	
		$SqlQuery = "INSERT INTO ".$tableName." (
			`articleTitle`,
			`articleText`, 
			`remarks`, 
			`meta`, 
			`permalink`, 
			`related`, 
			`appearsOn`, 
			`authorSignature`, 
			`aoHome`, 
			`aoStudy`, 
			`aoArticle`, 
			`aoHobbies`, 
			`aoTrending`, 
			`aoContact`, 
			`isProject`
		) VALUES (
			:articleTitle, 
			:articleText, 
			:remarks, 
			:meta, 
			:permalink, 
			:related, 
			:appearsOn, 
			:authorSignature,
			:aoHome,
			:aoStudy,
			:aoArticle,
			:aoHobbies,
			:aoTrending,
			:aoContact,
			:isProject
		)";
		$stat=$conn->prepare($SqlQuery);
	
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		try{
			$stat->execute(array(":articleTitle"=>$recArticle->articleTitle, ":articleText"=>$recArticle->articleText, ":remarks"=>$recArticle->remarks, ":meta"=>$recArticle->meta, ":permalink"=>$recArticle->permalink, ":related"=>$recArticle->related, ":appearsOn"=>$recArticle->appearsOn, ":authorSignature"=>$recArticle->authorSignature, ":aoHome"=>$aoHome, ":aoStudy"=>$aoStudy, ":aoArticle"=>$aoArticle, ":aoHobbies"=>$aoHobbies, ":aoTrending"=>$aoTrending, ":aoContact"=>$aoContact, ":isProject"=>$isProject));
			// echo "try block executed";
		}catch(PDOException $e){
			die('<br>Exception Caught By SciMad<br> Cannot insert in there'.$e->getMessage());
		}

	$tempCode='Your article with article title "'.$recArticle->articleTitle.'" has been sent to server successfully';
		
			
	}
	
	$tempCode=$tempCode.'<form action="createArticle.php" method="post">
	<fieldset>
	<legend>Write Your Article</legend>
		<table>
			<tr><td>Article Title:</td><td><textarea name="articleTitle"></textarea></td></tr>
			<tr><td>Appears On:</td><td><textarea name="appearsOn"></textarea></td></tr>
			<tr><td>Author Signature:</td><td><textarea name="authorSignature"></textarea></td></tr>
			<tr><td>Article Text:</td><td><textarea name="articleText" style="height:400px; width:500px;" placeholder="Enter Your Article"></textarea></td></tr>
			<tr><td><input type="submit" name="submitButton" value="Post Article"/></td></tr>
			<tr><td>Related:</td><td><textarea name="related"></textarea></td></tr>
			<tr><td>Remarks:</td><td><textarea name="remarks"></textarea></td></tr>
			<tr><td>Meta:</td><td><textarea name="meta"></textarea></td></tr>
			<tr><td>PermaLink:</td><td><textarea name="permalink"></textarea></td></tr>
			
			<tr><td><input type="checkbox" name="aoHome" value=1 checked/></td><td>Home</td></tr>
			<tr><td><input type="checkbox" name="aoStudy" value=1 checked/></td><td>Study</td></tr>
			<tr><td><input type="checkbox" name="aoArticle" value=1 checked/></td><td>Article</td></tr>
			<tr><td><input type="checkbox" name="aoHobbies" value=1 checked/></td><td>Hobbies</td></tr>
			<tr><td><input type="checkbox" name="aoTrending" value=1 checked/></td><td>Trending</td></tr>
			<tr><td><input type="checkbox" name="aoContact" value=1 checked/></td><td>Contact</td></tr>
			<tr><td><input type="checkbox" name="isProject" value=1 checked/></td><td>Project</td></tr>
			
			
			
		</table>
	</fieldset>
</form>';


	$htmlCode=insertCode($htmlCode,"#%1YearGuaranteeMidCol%#",$tempCode);
	
	
	
	
	$htmlCode=$htmlCode.placeFoot($homePath);
	$htmlCode=$htmlCode.endHtml($homePath);

	
	htmlShow($htmlCode);
?>