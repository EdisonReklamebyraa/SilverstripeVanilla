<?php
  class ResourceImage extends DataObject
  {
	static $db = array (
		'Name' => 'Text',
		'Description' => 'Text'
	);

	static $has_one = array (
		'Img' => 'Images',
		'ResourcePage' => 'Page'
	);



	public function getCMSFields_forPopup()
	{
		   return new FieldSet(
			new TextField('Name'),
			new TextareaField('Description'),
			new FileIFrameField('Img'));
	}
  }

?>