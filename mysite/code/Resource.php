<?php
  class Resource extends DataObject
  {
	static $db = array (
		'Name' => 'Text',
		'Description' => 'Text',
	);

	static $has_one = array (
		'Attachment' => 'File'
	);

    static $belongs_many_many = array (
	'ResourcePage' => 'Page'
    );
	public function getCMSFields_forPopup()
	{
		return new FieldSet(
			new TextField('Name'),
			new TextareaField('Description'),
			new FileIFrameField('Attachment')
		);
	}
  }

?>