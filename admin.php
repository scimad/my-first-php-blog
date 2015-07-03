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
	$myquery='SELECT * FROM `article`';
	/*
	
	$tempCode='<form>
<fieldset>
<legend>Enter Admin Credentials</legend>
    <table>
    <tr><td><label>UserName:</label></td><td><input type="text"></td></tr>
    <tr><td><label>Password:</label></td><td><input type="password"></td></tr>
    <tr><td><input type="submit" value="login"></td></tr>
	</table>
</fieldset>
</form>
';

	*/

	if (isset($_POST['submitButton'])){
		$receivedArtilce=new article($_POST['articleTitle'], $_POST['articleText'], $_POST['appearsOn'],$_POST['authorSignature'],$_POST['permalink'],$_POST['related'],$_POST['remarks'],$_POST['meta']);
		
		$tempCode='Your article with article title "'.$receivedArtilce->articleTitle.'" has been sent to server successfully';
	
			
	}
	

	
	$tempCode=$tempCode.'<form action="admin.php" method="post">
	<fieldset>
	<legend>Write Your Article</legend>
		<table>
			<tr><td>Article Title:</td><td><textarea name="articleTitle"></textarea></td></tr>
			<tr><td>Related:</td><td><textarea name="related"></textarea></td></tr>
			<tr><td>Remarks:</td><td><textarea name="remarks"></textarea></td></tr>
			<tr><td>Appears On:</td><td><textarea name="appearsOn"></textarea></td></tr>
			<tr><td>Meta:</td><td><textarea name="meta"></textarea></td></tr>
			<tr><td>PermaLink:</td><td><textarea name="permalink"></textarea></td></tr>
			<tr><td>Author Signature:</td><td><textarea name="authorSignature"></textarea></td></tr>
			<tr><td>Article Text:</td><td><textarea name="articleText" style="height:400px; width:500px;" placeholder="Enter Your Article"></textarea></td></tr>
			<tr><td><input type="submit" name="submitButton" value="Post Article"/></td></tr>
		</table>
	</fieldset>
</form>';


	$htmlCode=insertCode($htmlCode,"#%1YearGuaranteeMidCol%#",$tempCode);
	
	
	
	
	$htmlCode=$htmlCode.placeFoot($homePath);
	$htmlCode=$htmlCode.endHtml($homePath);

	
	htmlShow($htmlCode);
?>