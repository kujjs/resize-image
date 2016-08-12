<?php 

namespace kujjs\imageManager;
use Illuminate\Config\Repository as Config;
use Anakadote\ImageManager\ImageManager AS AnakadoteImageManager;
/**
* 
*/
class imageManager
{
	protected $file;
    protected $file_path;
    protected $url_path;
    protected $filename;
	protected $config;
	protected $ImageManager;
	function __construct()
	{
		$this->config = Config('imageManager');
		$this->ImageManager = new AnakadoteImageManager();
	}
	/**
	 * Resize images with predefined size in configurations
	 * @param  string  $file Fully qualified name of image file
	 * @param  string  $size 
	 * @param  boolean|array $html return or not <img> tag and attributes
	 * @return string 
	 */
	public function resize($file,$size='small',$html=false)
	{
		$option = $this->config['sizes'][$size];

		$url = url($this->ImageManager->getImagePath($file, $option['width'], 
											 $option['height'],
											 $option['mode'], 
											 $option['quality'])
					);
		if ($html) {
			$alt 	= ( isset($html['alt'])	  )? 'alt="'.  $html['alt']  .'"' : '';
			$title 	= ( isset($html['title']) )? 'title="'.$html['title'].'"' : '';
			$class 	= ( isset($html['class']) )? 'class="'.$html['class'].'"' : '';
			return '<img src="'.$url.'" '. $alt . $title . $class .' />';
		}
         return $url;
	}

    /**
     * Separate file name into name and paths    
     *
     * @param  string  $file
     */
	private function parseFileName($file)
    {
        $this->file      = $file;
        $this->file_path = dirname($this->file);
        $this->url_path  = str_replace(public_path(), "", $this->file_path);
        $this->filename  = str_replace($this->file_path, "", $this->file);
    }
    /**
     * Delete an image and thumbnails.
     * @param  string $file image with public path.    
     */
	public function delete($file)
	{
		$this->parseFileName($file);
		foreach ($this->config['sizes'] as $size) {
			$path = $this->file_path.'/'.$size['width'].'-'.$size['height'].'/'.$size['mode'].$this->filename;
			if (file_exists($path) ) {
				$this->ImageManager->deleteImage($path);
			}
		}
		$this->ImageManager->deleteImage($file);
	}
}
