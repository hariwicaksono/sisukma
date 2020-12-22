<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mylibrary {
	function anti_injection($data){
		$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
		return $filter;
	}
}

/* End of file Mylibrary.php */
/* Location: ./system/application/libraries/Mylibrary.php */