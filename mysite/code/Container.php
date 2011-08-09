<?php
         
class Container extends Page 
{
	 static $icon = 'cms/images/treeicons/folder';
	 static $allowed_children = array(
  		'Page'
  	);  

	
}

class Container_Controller extends Page_Controller {
	function rss() {
		
	  $rss = new RSSFeed($this->Children(), $this->Link(), $this->MetaTitle );
	  $rss->outputToBrowser();
	}

	function init() {
		
	   RSSFeed::linkToFeed($this->Link() . "rss");	
	   parent::init();
	}

}



?>