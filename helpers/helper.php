<?php
function subview($file){
	$file = __DIR__.'/../shared/'.$file;
	include $file;
}

function imageFile($file){
	$file = 'assets/images/'.$file;
	return $file;
}