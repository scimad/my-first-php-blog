<?php
class article{
	public $articleID, $articleTitle, $articleText, $authorSignature, $dateTime, $permaLink, $related, $remarks, $meta, $appearsOn;

	function __construct($garticleTitle, $garticleText, $gappearsOn, $gauthorSignature,$gpermaLink, $grelated, $gremarks, $gmeta){
	//g appearing attached to every variable name means 'got' which means got as a parameter to the function
	
		//$this->articleId=$garticleID;
		$this->articleTitle=$garticleTitle;
		$this->articleText=$garticleText;
		$this->appearsOn=$gappearsOn;
		$this->authorSignature=$gauthorSignature;
		$this->permaLink=$gpermaLink;
		$this->remarks=$gremarks;
		$this->meta=$gmeta;
		$this->related=$grelated;
		
	}
	
	function writeArticleToDatabase($connection){
		
	}
		
};

?>