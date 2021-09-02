<?php
class article{
	public $articleID, $articleTitle, $articleText, $authorSignature, $dateTime, $permaLink, $related, $remarks, $meta, $appearsOn;

	function __construct($garticleTitle, $garticleText, $gappearsOn, $gauthorSignature,$gpermalink, $grelated, $gremarks, $gmeta){
	//g appearing attached to every variable name means 'got' which means got as a parameter to the function
	
		//$this->articleId=$garticleID;
		$this->articleTitle=$garticleTitle;
		$this->articleText=$garticleText;
		$this->appearsOn=$gappearsOn;
		$this->authorSignature=$gauthorSignature;
		$this->permalink=$gpermalink;
		$this->remarks=$gremarks;
		$this->meta=$gmeta;
		$this->related=$grelated;
		
	}
	
	function writeToDatabase($connection){
		$conn=createConnection($dsn,$dbUser,$dbPass);
		$myquery="SELECT *FROM `article` ORDER BY(dateTime) DESC LIMIT 10";
	
		try{
			$allRows=$conn->query($myquery);
		}catch(PDOException $e){
			die('Dying because of error fetching main main contents!'.$e->getMessage());
		}		
	}
		
};

?>