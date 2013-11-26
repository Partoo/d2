<?php

class Comment extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

            public function documents()
            {
                return $this->belongsTo('Document');
            }

            public function author()
            {
                return $this->belongsTo('User', 'user_id');
            }




}
