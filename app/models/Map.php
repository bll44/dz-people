<?php

class Map extends Eloquent {

	protected $table = 'maps';
	protected $img64 = 'data:image/png;base64,';
	protected $file;
	protected $areaTemplate = "<area shape='rect' coords='[x1],[y1],[x2],[y2]' [HREF] [TITLE]>";

	public static $map_width = 1170;

	public $isProfile = false;
	public $isMaintenance = false;
	public $isPrinter = false;

	public $timestamps = false;

	public $areas = array();


	public function seats()
	{
		return $this->hasMany('Seat');
	}

	protected function init_base()
	{
		$this->file = base_path().'/public/'.$this->image;
		$this->jpeg_img = @imagecreatefromjpeg($this->file);
	}

	public function drawOverview()
	{
		$this->init_base();

		$user_color = imagecolorallocate($this->jpeg_img, 210, 57, 57);
		$printer_color = imagecolorallocate($this->jpeg_img, 100, 149, 237);
		$conferenceRoom_color = imagecolorallocate($this->jpeg_img, 86, 175, 98);

		foreach($this->seats as $s)
		{
			if(null !== $s->user)
				imagefilledrectangle($this->jpeg_img, $s->x1, $s->y1, $s->x2, $s->y2, $user_color);
			elseif(null !== $s->printer)
				imagefilledrectangle($this->jpeg_img, $s->x1, $s->y1, $s->x2, $s->y2, $printer_color);
			elseif(null !== $s->conferenceRoom)
				imagefilledrectangle($this->jpeg_img, $s->x1, $s->y1, $s->x2, $s->y2, $conferenceRoom_color);
		}

		ob_start();
		imagejpeg($this->jpeg_img);
		$img_data = ob_get_contents();
		ob_end_clean();
		$this->img64 .= base64_encode($img_data);

		return $this;
	}

	public function drawProfileView($user)
	{
		$this->init_base();

		$user_color = imagecolorallocate($this->jpeg_img, 210, 57, 57);
		$printer_color = imagecolorallocate($this->jpeg_img, 100, 149, 237);
		$conferenceRoom_color = imagecolorallocate($this->jpeg_img, 86, 175, 98);

		foreach($this->seats as $s)
		{
			if($s->user_id === $user->objectguid)
				imagefilledrectangle($this->jpeg_img, $s->x1, $s->y1, $s->x2, $s->y2, $user_color);
			elseif(null !== $s->printer_id)
				imagefilledrectangle($this->jpeg_img, $s->x1, $s->y1, $s->x2, $s->y2, $printer_color);
			elseif(null !== $s->conferenceRoom_id)
				imagefilledrectangle($this->jpeg_img, $s->x1, $s->y1, $s->x2, $s->y2, $conferenceRoom_color);
		}


		ob_start();
		imagejpeg($this->jpeg_img);
		$img_data = ob_get_contents();
		ob_end_clean();
		$this->img64 .= base64_encode($img_data);

		return $this;
	}

	public function setAreas($viewMode, $user = null)
	{
		foreach($this->seats as $s)
		{
			$x1 = round($s->x1 * $this->getScale());
			$y1 = round($s->y1 * $this->getScale());
			$x2 = round($s->x2 * $this->getScale());
			$y2 = round($s->y2 * $this->getScale());

			switch ($viewMode) :

			case 'overview' :

			if(null !== $s->user)
			{
				$area = "<area shape='rect' coords='{$x1},{$y1},{$x2},{$y2}'";
				$area .= " href='";
				$area .= URL::to("profile/{$s->user_id}");
				$area .= "' title='{$s->user->displayname}'>";
			}
			else
			{
				$area = "<area shape='rect' coords='{$x1}, {$y1}, {$x2}, {$y2}'>";
			}

			break;

			case 'seatChange' :

			if(null !== $s->user)
			{
				$href = '';
				$title = 'title="' . $s->user->displayname . '"';
			}
			elseif(null !== $s->printer)
			{
				$href = '';
				$title = 'title="Printer: ' . $s->printer->name . '"';
			}
			elseif(null !== $s->conferenceRoom)
			{
				$href = '';
				$title = 'Conference Room: ' . $s->conferenceRoom->name;
			}
			else
			{
				$href = "href='" . URL::to("seat/{$s->id}/{$user->objectguid}") . "'";
				$title = 'title="Empty"';
			}

			$area = str_replace(['[x1]', '[y1]', '[x2]', '[y2]', '[HREF]', '[TITLE]'],
									[$x1, $y1, $x2, $y2, $href, $title], $this->areaTemplate);

			break;

			case 'userProfile' :



			break;

			case 'printmgmt' :

			if(null !== $s->user)
			{
				$href = '';
				$title = 'title="' . $s->user->displayname . '"';
			}
			elseif(null !== $s->printer)
			{
				$href = '';
				$title = 'title="Printer: ' . $s->printer->name . '"';
			}
			elseif(null !== $s->conferenceRoom)
			{
				$href = '';
				$title = 'title="Conference Room: ' . $s->conferenceRoom->name . '"';
			}
			else
			{
				$href = 'href="' . URL::to()
			}

			break;

			endswitch;

			$this->areas[] = $area;
		}
	}

	public function draw()
	{
		$this->file = base_path().'/public/'.$this->image;
		$img = @imagecreatefromjpeg($this->file);

		$red = imagecolorallocate($img, 210, 57, 57);
		$blue = imagecolorallocate($img, 100, 149, 237);

		if($this->isPrinter)
		{
			foreach($this->seats as $seat)
			{
				if( ! is_null($seat->printer_id))
					imagefilledrectangle($img, $seat->x1, $seat->y1, $seat->x2, $seat->y2, $red);
			}
		}
		elseif( ! $this->isProfile)
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
					if( ! is_null($seat->user_id) || ! is_null($seat->printer_id))
					{
						if( ! is_null($seat->user_id))
							imagefilledrectangle($img, $seat->x1, $seat->y1, $seat->x2, $seat->y2, $red);
						else
							imagefilledrectangle($img, $seat->x1, $seat->y1, $seat->x2, $seat->y2, $blue);
					}
				}
			}

		}
		else
		{

			if( ! is_null($this->profileSeat->user_id))
				imagefilledrectangle($img, $this->profileSeat->x1, $this->profileSeat->y1, $this->profileSeat->x2, $this->profileSeat->y2, $red);
			foreach($this->seats as $seat)
			{
				if( ! is_null($seat->printer_id))
					imagefilledrectangle($img, $seat->x1, $seat->y1, $seat->x2, $seat->y2, $blue);
			}

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