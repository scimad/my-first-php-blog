<?php

function beginHtml($title,$homePath){
		$tempCode='<!DOCTYPE html>
<html>
<head>
	<title>madLife:: '.$title.'</title>
	<link rel="stylesheet" type="text/css" href="'.$homePath.'./styles/main.css">
</head>
<body>
';
return $tempCode;
}
function extraDesign($currentPage,$homePath){
		$tempCode='<style>
			#'.$currentPage.'{
			
			text-transform:uppercase;
			border-style: groove;
			text-decoration:none;
			}</style>';
		
		$tempCode=$tempCode.'<a style="position:fixed;" href="https://en.wikipedia.org/wiki/Gautam_Buddha"><img src="'.$homePath.'images/BuddhaEye.png" id="BuddhaEye"></a>
';
return $tempCode;
}
function placeHead($homePath){
	$tempCode='<div id="headerDiv">
  <header id="headerElement">
    <nav class="navigation" id="navigationBar">
    	<table id="navigationTable">
        	<tr>
            	<td class="navigationItem"><a class="navLink" id="home" href="'.$homePath.'"><img src="'.$homePath.'images/homeIcon.png"/><label>Home</label></a></td>
                <td class="navigationItem"><a class="navLink" id="study" href="'.$homePath.'study.php"><img src="'.$homePath.'images/book.png"/><label>Study</label></a></td>
                <td class="navigationItem"><a class="navLink" id="article" href="'.$homePath.'article.php"><img src="'.$homePath.'images/note.png"/><label>Article</label></a></td>
                <td class="navigationItem"><a class="navLink" id="trending" href="'.$homePath.'trending.php"><img src="'.$homePath.'images/mic.png"/><label>Trending</label></a></td>
                <td class="navigationItem"><a class="navLink" id="hobbies" href="'.$homePath.'hobbies.php"><img src="'.$homePath.'images/wlm.png"/><label>Hobbies</label></a></td>
                <td class="navigationItem"><a class="navLink" id="contact" href="'.$homePath.'contact.php"><img src="'.$homePath.'images/contact.png"/><label>Contact</label></a></td>
			</tr>
        </table>
    </nav>
  </header> 
</div>
';
return $tempCode;
}
	
function placeMainContent($homePath){
	$tempCode='<div id="mainContent">
    <div class="column" id="leftCol">
	#%1YearGuaranteeLeftCol%#
	</div>
    
	<div class="column" id="midCol">
	#%1YearGuaranteeMidCol%#
    </div>

    <div class="column" id="rightCol">
	#%1YearGuaranteeRightCol%#
	</div>          
    
</div>
';	
return $tempCode;
}

function placeFoot($homePath){
		$tempCode='<div class="myFoot">
Copyright (c) Mysterious Universe 2015, SciMad
</div>';
return $tempCode;
}

function endHtml($homePath){
		$tempCode='
</body>
</html>';
return $tempCode;
}



function createLeftBatta($battaTitle,$topRows){

	$tempCode='<table class="batta">
        	<tr class="battaTitle"><td>'.$battaTitle.'</td></tr>';
	foreach($topRows as $row){
		$linkText=$row['articleTitle'];
		if (strlen($linkText)>=17) $linkText=substr($linkText,0,15)."..";
		$tempCode=$tempCode.'
			<tr><td>&#9656<a class="navLink" href="article.php?articleID='.$row['articleID'].'">'.$linkText.'</a></td></tr>';
	}
	
	$tempCode=$tempCode.'
    	</table>';	
	return $tempCode;
}


function createRightBatta($battaTitle,$topRows){

	$tempCode='<table class="batta">
        	<tr class="battaTitle"><td>'.$battaTitle.'</td></tr>'.'
            <tr><td>&#9656<a class="navLink" href="index.php">Madhav</a></td></tr>
            <tr><td>&#9656<a class="navLink" href="index.php">Current Doc</a></td></tr>
            <tr><td>&#9656<a class="navLink" href="index.php">Madhav</a></td></tr>
            <tr><td>&#9656<a class="navLink" href="index.php">Current Doc</a></td></tr>
    	</table>';
	return $tempCode;
}


function createContentBatta($articleRow, $length){
	$articleTitle=$articleRow['articleTitle'];
	$articleText=$articleRow['articleText'];
	$linkToFullArticle='';
	if ($length!=0) {
		$articleText=substr($articleText,0,$length);
		$linkToFullArticle='..<a class="articleLink" href="article.php?articleID='.$articleRow['articleID'].'">(Read Whole Article)</a>';
	}
	
	$tempCode='<table class="contentBatta">
    <tr class="ContentBattaTitle"><td>'.$articleTitle.'</td></tr>
    <tr>
    <td><p>'.$articleText.$linkToFullArticle.'
    </p>
	</td>
    </tr>
    </table>';
	return $tempCode;
}

?>