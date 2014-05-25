<?php
class Flickr { 
	private $apiKey = 'c8914ccb88aa42f695cb103739a584a1';
 
	public function __construct() {
	} 
 
	public function search($query = null) { 
		$search = 'http://flickr.com/services/rest/?method=flickr.photos.search&api_key=' . $this->apiKey . '&text=' . urlencode($query) . '&per_page=3&format=php_serial&sort=relevance';
		$result = file_get_contents($search); 
		$final_result = unserialize($result);
		return $final_result;
	}
}
?>