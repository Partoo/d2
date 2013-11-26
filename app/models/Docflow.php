<?php

class Docflow extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

            public function documents()
            {
                return $this->belongsTo('Document','event_id');
            }
}
