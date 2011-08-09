<?php
class Page extends SiteTree {


	public static $db = array(
		"Introduction" => "Text"
		);

	static $many_many = array (
		'Resources' => 'Resource'

		);
	static $has_many = array (
		'ResourceImages' => 'ResourceImage'
		);

	public static $has_one = array(
		'PageImage' => 'Images'
		);





}

class Page_Controller extends ContentController {

	public function init() {
		parent::init();
	}

	/**
	 * Site search form
	 */
	public function SearchForm() {
		$searchText = isset($_REQUEST['Search']) ? $_REQUEST['Search'] : 'Search';
		$fields = new FieldSet(
			new TextField("Search", "", $searchText)
			);
		$actions = new FieldSet(
			new FormAction('results', 'Search')
			);

		return new SearchForm($this, "SearchForm", $fields, $actions);
	}


	/**
	 * Process and render search results
	 * http://localhost/pu/container/SearchForm?Search=lorem&action_ajaxResults=Search
	 */
	function ajaxResults($data, $form){

		$results = $form->getResults(50);
		$searchData = new DataObjectSet;
		foreach ($results as $result) {
			if($result->ClassName ==  "Page")
			{
				$node = DataObject::get_by_id($result->ClassName, (int)$result->ID);
				$searchData->push($node);
			}
		}

		$searchData->sort('ParentID')  ;
		$data['Results'] = $searchData;
		$data = array(
			'Results' => $searchData,
			'Query' => $form->getSearchQuery(),
			'Title' => 'Search Results'
			);

		return $this->customise($data)->renderWith(array('Page_ajax_results'));
	}



	/**
	 * Process and render search results
	 */
	function results($data, $form){
		$data = array(
			'Results' => $form->getResults(),
			'Query' => $form->getSearchQuery(),
			'Title' => 'Search Results'
			);

		return $this->customise($data)->renderWith(array('Page_results', 'Page'));
	}

}

?>
