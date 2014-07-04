<?php

class Map extends Eloquent {

	protected $table = 'maps';
	protected $img64 = 'data:image/png;base64,';
	protected $file;

	public static $map_width = 1170;

	public $isProfile = false;
	public $isMaintenance = false;

	public $timestamps = false;


	public function seats()
	{
		return $this->hasMany('Seat');
	}

	public function draw()
	{
		$this->file = base_path().'/public/'.$this->image;
		$img = @imagecreatefromjpeg($this->file);

		$red = imagecolorallocate($img, 210, 57, 57);

		if( ! $this->isProfile)
		{

			foreach($this->seats as $seat)
			{
				if($this->isMaintenance)
				{
					imagefilledrectangle($img, $seat->x1, $seat->y1, $seat->x2, $seat->y2, $red);
					$textcolor = imagecolorallocate($img, 0, 0, 0);
					imagestring($img, 3, $seat->x1, $seat->y1, $seat->id, $textcolor);
				}
				else
				{
					if( ! is_null($seat->user_id))
						imagefilledrectangle($img, $seat->x1, $seat->y1, $seat->x2, $seat->y2, $red);
				}
			}

		}
		else
		{

			if( ! is_null($this->profileSeat->user_id))
				imagefilledrectangle($img, $this->profileSeat->x1, $this->profileSeat->y1, $this->profileSeat->x2, $this->profileSeat->y2, $red);

		}

		ob_start();

		imagejpeg($img);

		$img_data = ob_get_contents();

		ob_end_clean();

		$this->img64 .= base64_encode($img_data);

		return $this;
	}

	public function output()
	{
		return $this->img64;
	}

	public function getScale()
	{
		$orig_width = getimagesize($this->file)[0];
		$scale = static::$map_width / $orig_width;
		return $scale;
	}

}