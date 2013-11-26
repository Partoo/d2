<?php

class Document extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

    public function users()
    {
        return $this->belongsToMany('User','document_user','document_id','user_id')->withPivot('state','type');
    }
    public function tags()
    {
        return $this->belongsToMany('Tag', 'document_tag', 'document_id', 'tag_id');
    }
    public function docflows()
    {
        return $this->hasMany('Docflow','document_id');
    }
    public function comments()
    {
        return $this->hasMany('Comment');
    }
}