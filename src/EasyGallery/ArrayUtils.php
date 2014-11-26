<?php

namespace EasyGallery;

class ArrayUtils {
	public static function binary_find_first(array $array, callable $matcher) {
		$start = 0;
		$end = count ( $array ) - 1;
		while ( $start <= $end ) {
			$pivot = floor(($end - $start) / 2 + $start);
			$comparison = $matcher ( $array [$pivot] );
			if ($comparison < 0) {
				$start = $pivot + 1;
			} else if ($comparison > 0) {
				$end = $pivot - 1;
			} else {
				$res = $array [$pivot];
				//Walk back to first match
				while ( $pivot > 0 && $matcher ( $array [$pivot - 1] ) == 0) {
					$res = $array [$pivot - 1];
					$pivot -= 1;
				}
				return $res;
			}
		}
		return null;
	}
}

?>