<?php

class Tag extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

            public function documents()
            {
                return $this->belongsToMany('Document','document_tag','tag_id','document_id');
            }
}
