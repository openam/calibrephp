<?php
/**
 * Resize Class
 *
 * mainly from http://net.tutsplus.com/tutorials/php/image-resizing-made-easy-with-php/
 */
Class resize {

/**
 * class variables
 */
	private $image;
    private $width;
    private $height;
	private $imageResized;

/**
 * __construct method
 *
 * @param string $fileName
 */
	function __construct($fileName) {
		$this->image = $this->openImage($fileName);

	    $this->width        = imagesx($this->image);
	    $this->height       = imagesy($this->image);
	    $this->originalPath = $fileName;
	    $this->baseOutName  = md5_file($fileName);
	}

/**
 * openImage
 *
 * @param string $file path to the file
 * @return image object
 */
	private function openImage($file) {
		// *** Get extension
		$extension = strtolower(strrchr($file, '.'));

		switch($extension)
		{
			case '.jpg':
			case '.jpeg':
				$img = @imagecreatefromjpeg($file);
				break;
			case '.gif':
				$img = @imagecreatefromgif($file);
				break;
			case '.png':
				$img = @imagecreatefrompng($file);
				break;
			default:
				$img = false;
				break;
		}
		return $img;
	}

/**
 * resizeImage
 *
 * @param array $options
 * @return string new path
 */
	public function resizeImage($options = array()) {

		$defaults = array(
			'h'       => '',
			'w'       => '',
			'quality' => 80,
			'type'    => 'auto'
		);

		$options = array_merge($defaults, $options);

		// *** Get optimal width and height - based on $option
		$this->getDimensions($options['w'], $options['h'], $options['type']);

		$this->newWebPath  = 'cache' . DS . $this->baseOutName . "_w{$options['w']}_h{$options['h']}_sc.jpg";
		$this->newFullPath = WWW_ROOT . $this->newWebPath;

		$create = true;
		if (file_exists($this->newFullPath)) {
			$create       = false;
			$origFileTime = date("YmdHis",filemtime($this->originalPath));
			$newFileTime  = date("YmdHis",filemtime($this->newFullPath));

			if ($newFileTime < $origFileTime) {
				$create = true;
			}
		}

		if ($create) {
			// create image of size x, y
			$this->imageResized = imagecreatetruecolor($this->optimalWidth, $this->optimalHeight);
			imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $this->optimalWidth, $this->optimalHeight, $this->width, $this->height);

			$this->saveImage($this->newFullPath, 100);
		}

		return $this->newWebPath;
	}

/**
 * getDimensions
 *
 * @param integer $newWidth
 * @param integer $newHeight
 * @param string $option resize type, e.g. exact, portrait, landscape, auto, crop
 * @return void
 */
	private function getDimensions($newWidth, $newHeight, $option) {

	   switch ($option) {
			case 'exact':
				$optimalWidth  = $newWidth;
				$optimalHeight = $newHeight;
				break;
			case 'portrait':
				$optimalWidth  = $this->getSizeByFixedHeight($newHeight);
				$optimalHeight = $newHeight;
				break;
			case 'landscape':
				$optimalWidth  = $newWidth;
				$optimalHeight = $this->getSizeByFixedWidth($newWidth);
				break;
			case 'auto':
				$optionArray   = $this->getSizeByAuto($newWidth, $newHeight);
				$optimalWidth  = $optionArray['optimalWidth'];
				$optimalHeight = $optionArray['optimalHeight'];
				break;
			case 'crop':
				$optionArray   = $this->getOptimalCrop($newWidth, $newHeight);
				$optimalWidth  = $optionArray['optimalWidth'];
				$optimalHeight = $optionArray['optimalHeight'];
				break;
		}

		$this->optimalWidth  = round($optimalWidth);
		$this->optimalHeight = round($optimalHeight);
	}


/**
 * getSizeByFixedHeight
 *
 * @param integer $newHeight
 * @return integer
 */
	private function getSizeByFixedHeight($newHeight) {
		$ratio    = $this->width / $this->height;
		$newWidth = $newHeight * $ratio;
		return $newWidth;
	}

/**
 * getSizeByFixedWidth
 *
 * @param integer $newWidth
 * @return integer
 */
	private function getSizeByFixedWidth($newWidth) {
		$ratio     = $this->height / $this->width;
		$newHeight = $newWidth * $ratio;
		return $newHeight;
	}

/**
 * getSizeByAuto
 *
 * @param integer $newWidth
 * @param integer $newHeight
 * @return array with 'optimalWidth' and 'optimalHeight'
 */
	private function getSizeByAuto($newWidth, $newHeight) {
		if ($this->height < $this->width) {
		// *** Image to be resized is wider (landscape)
			$optimalWidth  = $newWidth;
			$optimalHeight = $this->getSizeByFixedWidth($newWidth);
		} elseif ($this->height > $this->width) {
		// *** Image to be resized is taller (portrait)
			$optimalWidth = $this->getSizeByFixedHeight($newHeight);
			$optimalHeight= $newHeight;
		} else {
		// *** Image to be resizerd is a square
			if ($newHeight < $newWidth) {
				$optimalWidth  = $newWidth;
				$optimalHeight = $this->getSizeByFixedWidth($newWidth);
			} else if ($newHeight > $newWidth) {
				$optimalWidth  = $this->getSizeByFixedHeight($newHeight);
				$optimalHeight = $newHeight;
			} else {
				// *** Sqaure being resized to a square
				$optimalWidth  = $newWidth;
				$optimalHeight = $newHeight;
			}
		}

		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

/**
 * getOptimalCrop
 *
 * @param integer $newWidth
 * @param integer $newHeight
 * @return array with 'optimalWidth' and 'optimalHeigh'
 */
	private function getOptimalCrop($newWidth, $newHeight) {

		$heightRatio = $this->height / $newHeight;
		$widthRatio  = $this->width /  $newWidth;

		if ($heightRatio < $widthRatio) {
			$optimalRatio = $heightRatio;
		} else {
			$optimalRatio = $widthRatio;
		}

		$optimalHeight = $this->height / $optimalRatio;
		$optimalWidth  = $this->width  / $optimalRatio;

		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

/**
 * crop
 *
 * @param integer $optimalWidth
 * @param integer $optimalHeight
 * @param integer $newWidth
 * @param integer $newHeight
 * @return void
 */
	private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight) {
		// *** Find center - this will be used for the crop
		$cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
		$cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );

		$crop = $this->imageResized;
		//imagedestroy($this->imageResized);

		// *** Now crop from center to exact requested size
		$this->imageResized = imagecreatetruecolor($newWidth , $newHeight);
		imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
	}

/**
 * saveImage
 *
 * @param string $savePath
 * @param string $imageQuality
 * @return void
 */
	public function saveImage($savePath, $imageQuality="100") {
		// *** Get extension
		$extension = strrchr($savePath, '.');
			$extension = strtolower($extension);

		switch($extension) {
			case '.jpg':
			case '.jpeg':
				if (imagetypes() & IMG_JPG) {
					imagejpeg($this->imageResized, $savePath, $imageQuality);
				}
				break;

			case '.gif':
				if (imagetypes() & IMG_GIF) {
					imagegif($this->imageResized, $savePath);
				}
				break;

			case '.png':
				// *** Scale quality from 0-100 to 0-9
				$scaleQuality = round(($imageQuality/100) * 9);

				// *** Invert quality setting as 0 is best, not 9
				$invertScaleQuality = 9 - $scaleQuality;

				if (imagetypes() & IMG_PNG) {
					 imagepng($this->imageResized, $savePath, $invertScaleQuality);
				}
				break;

			default:
				// *** No extension - No save.
				break;
		}

		imagedestroy($this->imageResized);
	}

}
