<?php

class UTILS{

	public static function write_log($message) {

		$str= "\n".date("Y-m-d H:i:s")." : " .$message;
		file_put_contents('log.txt', $str, FILE_APPEND);
	}
	
}
?>