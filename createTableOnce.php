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
	$htmlCode=$htmlCode.beginHtml('Table',$homePath);
	$htmlCode=$htmlCode.extraDesign('table',$homePath);
	$htmlCode=$htmlCode.placeHead($homePath);
	$htmlCode=$htmlCode.placeMainContent($homePath);
	
	$conn=createConnection($dsn,$dbUser,$dbPass);
	
	if (isset($_POST['createTable'])){
		if ($_POST['password']==$adminPass){
			echo('Successfylly Authorised!<br>Creating Table:');
			
			
			$tableName='article';			
			$SqlQuery = "CREATE TABLE IF NOT EXISTS `$tableName` (
`articleId` int( 11 ) NOT NULL AUTO_INCREMENT ,
`articleTitle` varchar( 100 ) NOT NULL ,
`articleText` text( 21845 ) NOT NULL ,
`dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
`remarks` varchar( 500 )  ,
`views` mediumint( 9 )  ,
`recommended` mediumint( 9 )  ,
`meta` varchar( 500 )  ,
`permalink` varchar( 200 )  ,
`related` varchar( 1000 )  ,
`appearsOn` varchar( 100 )  ,
`aoHome` BOOLEAN  DEFAULT TRUE,
`aoHobbies` BOOLEAN  DEFAULT TRUE,
`aoStudy` BOOLEAN  DEFAULT TRUE,
`aoContact` BOOLEAN  DEFAULT TRUE,
`aoTrending` BOOLEAN  DEFAULT TRUE,
`aoArticle` BOOLEAN  DEFAULT TRUE,
`isProject` BOOLEAN  DEFAULT FALSE,
`verified` BOOLEAN  DEFAULT FALSE,
`authorSignature` varchar( 20 )  ,
PRIMARY KEY ( `articleId` ) ,
UNIQUE KEY `articleId` ( `articleId` )
) DEFAULT CHARSET = utf8;";		//ENGINE = InnoDB DEFAULT CHARSET = utf8;

	$stat=$conn->prepare($SqlQuery);
	try{
		$stat->execute();
		echo("tried to Create a table");
	}catch(PDOException $e){
		echo "PDO excetion caught while creating table Article".$e->getMessage();
		die();
	}
			
			
			
		$tableName="Comments";
		$SqlQuery = "CREATE TABLE IF NOT EXISTS `$tableName` (
`CommentId` int( 11 ) NOT NULL AUTO_INCREMENT ,
`articleId` int( 11 ) NOT NULL ,
`CommentText` text( 21845 ) NOT NULL ,
`dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
`authorSignature` varchar( 100 )  ,
PRIMARY KEY ( `CommentId` ) ,
UNIQUE KEY `CommentId` ( `CommentId` )
) DEFAULT CHARSET = utf8;";	
		
		$stat=$conn->prepare($SqlQuery);
	try{
		$stat->execute();
		echo("tried to Create a table");
	}catch(PDOException $e){
		echo "PDO excetion caught while creating table Comments.".$e->getMessage();
		die();
	}




			
		}else{
			/*------------------------- (: (: (: 	  When the Password Doesnot Match		:) :) :) ----------------------*/
			die ('Dont Try To Hack My Website Please');
		}
		
	}else{
		/*-------------------------------------When The Login Button is not pressed-----------------------------------*/
	$tempCode=$tempCode.'<form action="createTableOnce.php" method="post">
	<fieldset>
	<legend>Enter Authorization Key</legend>
		<table>
			<tr><td>Admin Login:</td><td><input type="password" name="password" placeholder="Type Password Here" required></td></tr>
			<tr><td><input type="submit" name="createTable" value="Create Table Once"/></td></tr>
		</table>
	</fieldset>
</form>';
	
	
	}


	$htmlCode=insertCode($htmlCode,"#%1YearGuaranteeMidCol%#",$tempCode);

	$htmlCode=$htmlCode.placeFoot($homePath);
	$htmlCode=$htmlCode.endHtml($homePath);

	htmlShow($htmlCode);
?>