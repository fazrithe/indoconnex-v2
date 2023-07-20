<?php

/*
  Copyright (c) <2016> <http://www.sanwebe.com>
  License : http://opensource.org/licenses/MIT
 */

set_time_limit(0);
ini_set('memory_limit', '-1');

class Image_upload_resize
{

	private $generate_image_file;
	private $generate_thumbnails;
	private $image_max_size;
	private $thumbnail_size;
	private $thumbnail_prefix;
	private $destination_dir;
	private $thumbnail_destination_dir;
	private $save_dir;
	private $quality;
	private $random_file_name;
	private $config;
	private $file_count;
	private $image_width;
	private $image_height;
	private $image_type;
	private $image_size_info;
	private $image_res;
	private $image_scale;
	private $new_width;
	private $new_height;
	private $new_canvas;
	private $new_canvas_thumbnail;
	private $new_file_name;
	private $curr_tmp_name;
	private $x_offset;
	private $y_offset;
	private $resized_response;
	private $thumb_response;
	private $unique_rnd_name;
	public  $response;

	function _set_config($config)
	{
		$this->file_data = null;

		//set local vars
		$this->generate_image_file       = $config["generate_image_file"];
		$this->generate_thumbnails       = $config["generate_thumbnails"];
		$this->image_max_size            = $config["image_max_size"];
		$this->thumbnail_size            = $config["thumbnail_size"];
		$this->thumbnail_prefix          = $config["thumbnail_prefix"];
		$this->destination_dir           = $config["destination_folder"];
		$this->thumbnail_destination_dir = $config["thumbnail_destination_folder"];
		$this->random_file_name          = $config["random_file_name"];
		$this->quality                   = $config["quality"];
		$this->file_data                 = $config["file_data"];
		$this->file_count                = (!empty($this->file_data['name'])) ? count($this->file_data['name']) : 0;
	}

	//resize function
	public function resize($config)
	{
		$this->_set_config($config);

		$this->response           = null;
		$this->response['images'] = null;

		if ($this->generate_image_file) {
			$this->response["images"] = $this->resize_it();
		}
		if ($this->generate_thumbnails) {
			$this->response["thumbs"] = $this->thumbnail_it();
		}

		return $this->response;
	}

	//proportionally resize image
	private function resize_it()
	{

		if ($this->file_count > 0) {
			if (!is_array($this->file_data['name'])) {
				throw new Exception('HTML file input field must be in array format!');
			}

//            for ($x = 0; $x < $this->file_count; $x++) {
			$this->resized_response = null;
			foreach ($this->file_data['name'] as $x => $row) {
				if ($this->file_data['name'][$x] != '') {
					if ($this->file_data['error'][$x] > 0) {
						$this->upload_error_no = $this->file_data['error'][$x];
						throw new Exception($this->get_upload_error());
					}

					if (is_uploaded_file($this->file_data['tmp_name'][$x])) {

						$this->curr_tmp_name = $this->file_data['tmp_name'][$x];
						$this->get_image_info();

						//create unique file name
						if ($this->random_file_name) {
							$this->new_file_name       = uniqid() . $this->get_extension();
							$this->unique_rnd_name[$x] = $this->new_file_name;
						} else {
							$this->new_file_name = $this->file_data['name'][$x];
						}

						$this->curr_tmp_name = $this->file_data['tmp_name'][$x];
						$this->image_res     = $this->get_image_resource();
						$this->save_dir      = $this->destination_dir;
						//do not resize if image is smaller than max size
						if ($this->image_width <= $this->image_max_size || $this->image_height <= $this->image_max_size) {
							$this->new_width  = $this->image_width;
							$this->new_height = $this->image_height;
							if ($this->image_resampling($this->file_data['type'][$x])) {
								$this->resized_response[] = $this->save_image();
							}
						} else {
							$this->image_scale = min($this->image_max_size / $this->image_width, $this->image_max_size / $this->image_height);
							$this->new_width   = ceil($this->image_scale * $this->image_width);
							$this->new_height  = ceil($this->image_scale * $this->image_height);

							if ($this->image_resampling($this->file_data['type'][$x])) {
								$this->resized_response[] = $this->save_image();
							}
						}
						imagedestroy($this->image_res);
					}
				} else {
					$this->resized_response[] = '';
				}
			}

		}

		return $this->resized_response;
	}

	//generate cropped and resized thumbnails
	private function thumbnail_it()
	{
		if ($this->file_count > 0) {
			if (!is_array($this->file_data['name'])) {
				throw new Exception('HTML file input field must be in array format!');
			}
//            for ($x = 0; $x < $this->file_count; $x++) {
			foreach ($this->file_data['name'] as $x => $row) {
				if ($this->file_data['name'][$x] != '') {

					if ($this->file_data['error'][$x] > 0) {
						$this->upload_error_no = $this->file_data['error'][$x];
						throw new Exception($this->get_upload_error());
					}

					if (is_uploaded_file($this->file_data['tmp_name'][$x])) {
						$this->curr_tmp_name = $this->file_data['tmp_name'][$x];
						$this->get_image_info();

						if ($this->random_file_name && !empty($this->unique_rnd_name)) {
							$this->new_file_name = $this->thumbnail_prefix . $this->unique_rnd_name[$x];
						} else if ($this->random_file_name) {
							$this->new_file_name = $this->thumbnail_prefix . uniqid() . $this->get_extension();
						} else {
							$this->new_file_name = $this->thumbnail_prefix . $this->file_data['name'][$x];
						}

						$this->image_res = $this->get_image_resource();

						$this->new_width  = $this->thumbnail_size;
						$this->new_height = $this->thumbnail_size;
						$this->save_dir   = $this->thumbnail_destination_dir;

						$this->y_offset = 0;
						$this->x_offset = 0;
						if ($this->image_width > $this->image_height) {
							$this->x_offset    = ($this->image_width - $this->image_height) / 2;
							$this->image_width = $this->image_height = $this->image_width - ($this->x_offset * 2);
						} else {
							$this->y_offset    = ($this->image_height - $this->image_width) / 2;
							$this->image_width = $this->image_height = $this->image_height - ($this->y_offset * 2);
						}

						if ($this->image_resampling_thumbnail($this->file_data['type'][$x])) {
							$this->thumb_response[] = $this->save_image_thumbnail();
						}

						/*
						if ($this->image_width <= $this->thumbnail_size || $this->image_height <= $this->thumbnail_size) {
							$this->new_width  = $this->image_width;
							$this->new_height = $this->image_height;
							if ($this->image_resampling($this->file_data['type'][$x])) {
								$this->thumb_response[] = $this->save_image();
							}
						} else {
							$this->image_scale = min($this->thumbnail_size / $this->image_width, $this->thumbnail_size / $this->image_height);
							$this->new_width   = ceil($this->image_scale * $this->image_width);
							$this->new_height  = ceil($this->image_scale * $this->image_height);

							if ($this->image_resampling($this->file_data['type'][$x])) {
								$this->thumb_response[] = $this->save_image();
							}
						}
						*/

						imagedestroy($this->image_res);
					}
				} else {
					$this->thumb_response[] = '';
				}
			}
		}
		return $this->thumb_response;
	}

	//save image to destination
	private function save_image()
	{
		if (!file_exists($this->save_dir)) { //try and create folder if none exist
			if (!mkdir($this->save_dir, 0755, true)) {
				throw new Exception($this->save_dir . ' - directory doesn\'t exist!');
			}
		}

		switch ($this->image_type) {//determine mime type
			case 'image/png':
				imagepng($this->new_canvas, $this->save_dir . $this->new_file_name);
				imagedestroy($this->new_canvas);
				return $this->new_file_name;
				break;
			case 'image/gif':
				imagegif($this->new_canvas, $this->save_dir . $this->new_file_name);
				imagedestroy($this->new_canvas);
				return $this->new_file_name;
				break;
			case 'image/jpeg':
			case 'image/pjpeg':
				imagejpeg($this->new_canvas, $this->save_dir . $this->new_file_name, $this->quality);
				imagedestroy($this->new_canvas);
				return $this->new_file_name;
				break;
			default:
				imagedestroy($this->new_canvas);
				return false;
				break;
		}
	}

	private function save_image_thumbnail()
	{
		if (!file_exists($this->save_dir)) { //try and create folder if none exist
			if (!mkdir($this->save_dir, 0755, true)) {
				throw new Exception($this->save_dir . ' - directory doesn\'t exist!');
			}
		}

		switch ($this->image_type) {//determine mime type
			case 'image/png':
				imagepng($this->new_canvas_thumbnail, $this->save_dir . $this->new_file_name);
				imagedestroy($this->new_canvas_thumbnail);
				return $this->new_file_name;
				break;
			case 'image/gif':
				imagegif($this->new_canvas_thumbnail, $this->save_dir . $this->new_file_name);
				imagedestroy($this->new_canvas_thumbnail);
				return $this->new_file_name;
				break;
			case 'image/jpeg':
			case 'image/pjpeg':
				imagejpeg($this->new_canvas_thumbnail, $this->save_dir . $this->new_file_name, $this->quality);
				imagedestroy($this->new_canvas_thumbnail);
				return $this->new_file_name;
				break;
			default:
				imagedestroy($this->new_canvas_thumbnail);
				return false;
				break;
		}
	}

	//get image info
	private function get_image_info()
	{
		$this->image_size_info = getimagesize($this->curr_tmp_name);
		if ($this->image_size_info) {
			$this->image_width  = $this->image_size_info[0];      //image width
			$this->image_height = $this->image_size_info[1];      //image height
			$this->image_type   = $this->image_size_info['mime']; //image type
		} else {
			throw new Exception("Make sure Image file is valid image!");
		}
	}

	//image resample
	private function image_resampling($type = null)
	{
		$this->new_canvas = imagecreatetruecolor($this->new_width, $this->new_height);
		if ($type == 'image/png') {
			imagecolortransparent($this->new_canvas, imagecolorallocatealpha($this->new_canvas, 0, 0, 0, 127));
			imagealphablending($this->new_canvas, false);
			imagesavealpha($this->new_canvas, true);
		}

		if (imagecopyresampled($this->new_canvas, $this->image_res, 0, 0, 0, 0, $this->new_width, $this->new_height, $this->image_width, $this->image_height)) {
			return true;
		}
	}

	private function image_resampling_thumbnail($type = null)
	{
		$this->new_canvas_thumbnail = imagecreatetruecolor($this->new_width, $this->new_height);
		if ($type == 'image/png') {
			imagecolortransparent($this->new_canvas_thumbnail, imagecolorallocatealpha($this->new_canvas_thumbnail, 0, 0, 0, 127));
			imagealphablending($this->new_canvas_thumbnail, false);
			imagesavealpha($this->new_canvas_thumbnail, true);
		}

		if (imagecopyresampled($this->new_canvas_thumbnail, $this->image_res, 0, 0, $this->x_offset, $this->y_offset, $this->new_width, $this->new_height, $this->image_width, $this->image_height)) {
			return true;
		}
	}

	//create image resource
	private function get_image_resource()
	{
		switch ($this->image_type) {
			case 'image/png':
				return imagecreatefrompng($this->curr_tmp_name);
				break;
			case 'image/gif':
				return imagecreatefromgif($this->curr_tmp_name);
				break;
			case 'image/jpeg':
			case 'image/pjpeg':
				return imagecreatefromjpeg($this->curr_tmp_name);
				break;
			default:
				return false;
		}
	}

	private function get_extension()
	{
		if (empty($this->image_type))
			return false;
		switch ($this->image_type) {
			case 'image/gif':
				return '.gif';
			case 'image/jpeg':
				return '.jpg';
			case 'image/png':
				return '.png';
			default:
				return false;
		}
	}

	private function get_upload_error()
	{
		switch ($this->upload_error_no) {
			case 1 :
				return 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
			case 2 :
				return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
			case 3 :
				return 'The uploaded file was only partially uploaded.';
			case 4 :
				return 'No file was uploaded.';
			case 5 :
				return 'Missing a temporary folder. Introduced in PHP 5.0.3';
			case 6 :
				return 'Failed to write file to disk. Introduced in PHP 5.1.0';
		}
	}

}
