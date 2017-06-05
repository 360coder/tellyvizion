<?php

class Video extends Eloquent {
	protected $guarded = array();


	public static $rules = array();

	protected $fillable = array('user_id', 'video_category_id', 'title', 'type', 'access', 'details', 'description', 'active', 'featured', 'duration', 'image', 'video', 'embed_code', 'mp4_url', 'webm_url', 'ogg_url', 'created_at','sliders');

	public function tags(){
		return $this->belongsToMany('Tag');
	}
}