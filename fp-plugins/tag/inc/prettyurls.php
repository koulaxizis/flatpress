<?php
/**
 * tag_prettyurls
 *
 * This class is a patch for PrettyURLs.
 * Infact PrettyURLs has problems with pages.
 *
 * See http://www.vdfn.altervista.org/2010/08/14/flatpress-nextprev-page-link-and-prettyurls/
 */
class tag_prettyurls {
	# The "original" PrettyURLs
	var $original=null;
	# The baseurl
	var $baseurl=null;
	# The taglink; set by the init_tag class.
	var $taglink='';
	/**
	 * tag_prettyurls
	 *
	 * The constructor.
	 * Saves the "original" PrettyURLs and the baseurl
	 *
	 * @param onject &$original: The original PrettyURLs
	 */
	function tag_prettyurls(&$original) {
		$this->original=&$original;
		$this->baseurl=&$original->baseurl;
	}
	# The functions called by the hooks.
	# They just call "original" functions
	function permalink($str, $id) {
		return $this->original->permalink($str, $id);
	}

	function commentlink($str, $id) {
		return $this->original->commentlink($str, $id);
	}

	function feedlink($str, $type) {
		return $this->original->feedlink($str, $type);
	}

	function commentsfeedlink($str, $type, $id) {
		return $this->original->commentsfeedlink($str, $type, $id);
	}

	function staticlink($str, $id) {
		return $this->original->staticlink($str, $id);
	}

	function categorylink($str, $catid) {
		return $this->original->categorylink($str, $catid);
	}

	function yearlink($str, $y) {
		return $this->original->yearlink($str, $y);
	}

	function monthlink($str, $y, $m) {
		return $this->original->monthlink($str, $y, $m);
	}

	function daylink($str, $y, $m, $d) {
		return $this->original->daylink($str, $y, $m, $d);
	}

	/**
	 * nextprevlink
	 *
	 * This function is the only function that is a bit changed.
	 *
	 * It just adds tag/$tagname/
	 *
	 * @param string $nextprev: NextPage or PrevPage: it depends on the callback to call
	 * @param integer $v: +1 or -1: the number to sum to the current page
	 * @returns array: the array with the link and the text (Next/Prev Page)
	 */
	function nextprevlink($nextprev, $v) {
		global $fp_params, $fpdb;
		$this->fp_params=&$fp_params;
		if(!empty($fp_params['tag'])) {
			if(empty($this->tag_link)) {
				return array();
			}
			$l=$this->tag_link;
			## Code by plugin.prettyurls.php, by NoWhereMan
				$q =& $fpdb->getQuery();
				list($caption, $id) = call_user_func(array(&$q, 'get'.$nextprev));
				$page = 1;
				if (isset($this->fp_params['paged']) && $this->fp_params['paged']>1) 
					$page = $this->fp_params['paged'];
				$page += $v;
				if ($page > 0)
					$l .= 'page/' . $page . '/';
				return array($caption, $l);
			## End Code by PrettyURLs
		} else {
			# If it's not the tag, let's call the "original" function
			return $this->original->nextprevlink($nextprev, $v);
		}
	}
}