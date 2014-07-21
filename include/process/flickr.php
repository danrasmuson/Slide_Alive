<?php
/*
 * SlideAlive - Automatic Presentation Generation Software
 * --------------
 * flickr.php - Interact with the Flickr API to perform calls for images for given queries.
 * Created by William Teder using PHPstorm on 7/21/14 at 3:13 PM.
 */

class Flickr { 
	private $apiKey = 'c8914ccb88aa42f695cb103739a584a1';
 
	public function __construct() {
	} 
 
	public function search($query = null) { 
		$search = 'http://flickr.com/services/rest/?method=flickr.photos.search&api_key=' . $this->apiKey . '&text=' . urlencode($query) . '&per_page=1&format=php_serial&sort=relevance';
		$result = unserialize(file_get_contents($search));
		return $result;
	}
}
?>