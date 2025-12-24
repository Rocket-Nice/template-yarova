<?php

namespace YAR_Profile\Services;

/**
 * Class YAR_Image_Resize_Service
 * Resize big image files and rotate to normal position
 */
class YAR_Image_Resize_Service {
	public function resize( $file ){
		if ( strpos( $file['type'], 'image/' ) !== 0 ) {
			return $file;
		}

		$info = getimagesize( $file['tmp_name'] );
		if ( ! $info ) {
			return $file;
		}

		$maxWidth  = 1000;
		$maxHeight = 1000;
		$image     = imagecreatefromstring( file_get_contents( $file['tmp_name'] ) );

		$width  = imagesx( $image );
		$height = imagesy( $image );

		if ( $width <= $maxWidth && $height <= $maxHeight ) {
			return $file;
		}

		$scale = min( $maxWidth / $width, $maxHeight / $height, 1 );

		$newWidth  = floor( $width * $scale );
		$newHeight = floor( $height * $scale );

		$resized = imagecreatetruecolor( $newWidth, $newHeight );

		imagecopyresampled( $resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height );

		imagejpeg( $resized, $file['tmp_name'], 80 );

		imagedestroy( $image );
		imagedestroy( $resized );

		return $file;
	}
}