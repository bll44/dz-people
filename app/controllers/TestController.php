<?php


class TestController extends \BaseController {

	public function index()
	{

		$image_file = base_path().'/public/images/testpic.jpeg';
		$image = @imagecreatefromjpeg($image_file);

		$image_data = getimagesize($image_file);
		$orig_width = $image_data[0];

		$scale = 900 / $orig_width;

		ob_start();
		imagejpeg($image);
		$image_data = ob_get_contents();
		ob_end_clean();

		$img64 = base64_encode($image_data);

		return View::make('test_views/index', ['image' => $img64, 'scale' => $scale]);
	}

}