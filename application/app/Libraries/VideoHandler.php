<?php
set_error_handler(null);
set_exception_handler(null);
class VideoHandler {

	public static function uploadVideo($video, $folder, $filename = '', $type = 'upload'){
		return call_user_func ( Config::get('site.media_upload_function_video'), array('video' => $video, 'folder' => $folder, 'filename' => $filename, 'type' => $type) );
	}

	public static function getVideo($video, $size = ''){
		$video = ''; // placeholder video
	
		$video_url = Config::get('site.uploads_dir') . 'videos/';
		return $video_url . $video;

	}

	public static function uploadVid($video, $filename){
		// Lets get all these Arguments and assign them!
		$video = $video;
		$filename = $filename; 
		$month_year = date('FY').'/';

		// Check it out! This is the upload folder
		$upload_folder = 'content/uploads/videos/'.$month_year;

		if ( @getvideosize($video) ){

			// if the folder doesn't exist then create it.
			if (!file_exists($upload_folder)) {
				mkdir($upload_folder, 0777, true);
			}

			$filename =  $video->getClientOriginalName();

			// if the file exists give it a unique name
			while (file_exists($upload_folder.$filename)) {
				$filename =  uniqid() . '-' . $filename;
			}

			$uploadSuccess = $video->move($upload_folder, $filename);
		
			$settings = Setting::first();

			$video = Video::make($upload_folder . $filename);

			$video->save($upload_folder . $filename);
			
			return $month_year . $filename;

		} else {
			return false;
		}
	}

	public static function upload($args){
				if (!defined('AKIAIEMFDP5ZOLXTFESA')) define('AKIAIEMFDP5ZOLXTFESA', 'CHANGE THIS');
if (!defined('+RsFdC6yIPdpxbNrhF/+AQkEjMNrIdoTGjGmw9m0')) define('+RsFdC6yIPdpxbNrhF/+AQkEjMNrIdoTGjGmw9m0', 'CHANGE THIS TOO');
		$s3 = new S3('AKIAIEMFDP5ZOLXTFESA', '+RsFdC6yIPdpxbNrhF/+AQkEjMNrIdoTGjGmw9m0');
		// Lets get all these Arguments and assign them!
		$video = $args['video'];
		$folder = $args['folder'];
		$filename = $args['filename']; 
		$type = $args['type'];

		// Hey if the folder we want to put them in is videos. Let's give them a month and year folder
		if($folder == 'videos'){
			$month_year = date('FY').'/';
		} else {
			$month_year = '';
		}

		// Check it out! This is the upload folder
		$upload_folder = 'uploads/' . $folder . '/'.$month_year;
		if (!file_exists($upload_folder)) {
				mkdir($upload_folder, 0777, true);
			}
			if($type =='upload'){

				$filename =  $video->getClientOriginalName();
				$tempname = $video->getPathName();
				// if the file exists give it a unique name
				while (file_exists($upload_folder.$filename)) {
					$filename =  uniqid() . '-' . $filename;
				}
				$s3->putBucket("tellyvizion", S3::ACL_PUBLIC_READ);
				$uploadSuccess = $s3->putObjectFile($tempname, "tellyvizion",$upload_folder.$filename, S3::ACL_PUBLIC_READ);
			}
			$settings = Setting::first();

			//$vid = Video::make($upload_folder . $filename);
			//$vid->save($upload_folder . $filename);
			return $month_year . $filename;
			
	}

}