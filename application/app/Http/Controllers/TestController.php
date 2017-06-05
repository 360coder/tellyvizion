<?php 
set_error_handler(null);
set_exception_handler(null);
use Storage;
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
include app_path().'/Libraries/S3.php';

class TestController extends Controller {

	public function __construct()
	{
		//$this->middleware('secure');
	}

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	*/

	public function index()
	{
		if (!defined('AKIAIEMFDP5ZOLXTFESA')) define('AKIAIEMFDP5ZOLXTFESA', 'CHANGE THIS');
if (!defined('+RsFdC6yIPdpxbNrhF/+AQkEjMNrIdoTGjGmw9m0')) define('+RsFdC6yIPdpxbNrhF/+AQkEjMNrIdoTGjGmw9m0', 'CHANGE THIS TOO');
		$s3 = new S3('AKIAIEMFDP5ZOLXTFESA', '+RsFdC6yIPdpxbNrhF/+AQkEjMNrIdoTGjGmw9m0');

		if(Input::file('image')):
			$image = Input::file('image');

	    	$imageFileName = time() . '.' . $image->getClientOriginalName();
	    			echo "<pre>";
			print_r($imageFileName);
	    	$tempname = $image->getPathName();
	    	//$filePath = '/support-tickets/' . $imageFileName;
/*	    	$s3 = \Storage::disk('s3');
			
			$s3->put($filePath, file_get_contents($image), 'public');*/
	       	//die('aaaaa');

				//create a new bucket
				$s3->putBucket("tellyvizion", S3::ACL_PUBLIC_READ);
				
				//move the file
				if ($s3->putObjectFile($tempname, "tellyvizion",'videos/'.$imageFileName, S3::ACL_PUBLIC_READ)) {
					echo "<strong>We successfully uploaded your file.</strong>";
				}else{
					echo "<strong>Something went wrong while uploading your file... sorry.</strong>";
				}

       	endif;
         return View::make('Theme::test', $data);
	}

}