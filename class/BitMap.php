<?php

/**
 * Class BitMap
 */
class BitMap {
	private $bitmap = 0;

	public function setBit($offset, $value) {
		$mask = $this->getMask($offset);
		if ($value == 1) {
			$this->bitmap |= $mask;
		} else {
			$this->bitmap &= ~$mask;
		}
		// example: 
		// bitmap: 0001
		// offset: 2
		// if "1" : 0001 & ~ 0010  = 0001
		// if "0" : 0001 | 0010 = 0011
	}

	public function getMask($offset) {
		$mask = 1 << $offset - 1;
		return $mask;
	}

	public function getBit($offset) {
		$mask = $this->getMask($offset);
		return ($this->bitmap & $mask == $mask) ? 1 : 0;
	}

	public function getBitMap() {
		return $this->bitmap;
	}

	public function bitCount() {
		$count = 0;
		$binary = decbin($this->bitmap);
		for($i = 0; $i<strlen($binary); $i++) {
			if ($binary{$i} == 1) {
				$count++;
			}
		}
		return $count;
	}
}
