<?php

class Membres extends DB\SQL\Mapper{

	public function __construct(DB\SQL $db) {
		parent::__construct($db,'membres');
	}

	public function all() {
		$this->load();
		return $this->query;
	}

	public function getById($id) {
		$this->load(array('id=?',$id));
		return $this->query;
	}

	public function getByName($name) {
		$this->load(array('username=?',$name));
		return $this->query;
	}

	public function add() {
		$this->copyFrom('POST');
		$this->save();
	}

	public function edit($id) {
		$this->load(array('id=?',$id));
		$this->copyFrom('POST');
		$this->update();
	}

	public function edit_one() {
		$this->copyFrom('POST');
		$this->update();
	}

	public function delete($name) {
    $this->load(array('username=?',$name));
    $this->erase();
  }

	public function returnLastID()
  {
    $this->load();
    $this->last();
    return $this->query;
  }
 
}