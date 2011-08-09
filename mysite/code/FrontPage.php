<?php

class FrontPage extends Page
{
	static $icon = 'mysite/code/home';

	public static $db = array(

		);

	public static $has_one = array(
		'theNews' => 'Container',
		);


	function LatestNews($num=3) {
		$news = $this->theNews();
		return	($news) ? DataObject::get("Page", "ParentID = $news->ID", "Created DESC", "", $num) : false;

	}

}
class FrontPage_Controller extends Page_Controller {
	function rss() {

		$rss = new RSSFeed($this->LatestNews(),	 "STX Grenland Industri RSS" , $this->MetaTitle);
		$rss->outputToBrowser();
	}

	function init() {

		RSSFeed::linkToFeed($this->Link() . "rss");
		parent::init();
	}

}



?>