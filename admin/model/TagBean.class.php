<?php

class TagBean extends GenericBean{

  private $tagID;
  private $tag;

  function __construct($tagID = null, $tag = "") {
      $this->tagID = $tagID;
      $this->tag = $tag;
  }

	public function getTagID(){
		return $this->tagID;
	}

	public function setTagID($tagID){
		$this->tagID = $tagID;
	}

	public function getTag(){
		return $this->tag;
	}

	public function setTag($tag){
		$this->tag = $tag;
	}
  
  public function toArray() {
      $tag = array();

      $tag['tagID'] = $this->tagID;
      $tag['tag'] = $this->tag;

      return $tag;
  }

  public function toJson() {
      return json_encode($this->toArray());
  }

  public function toBD() {
      return $this->toArray();
  }

}
