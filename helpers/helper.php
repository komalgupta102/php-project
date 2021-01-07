<?php
function subview($file){
	$file = __DIR__.'/../shared/'.$file;
	include $file;
}

function imageFile($file){
	$file = 'assets/images/'.$file;
	return $file;
}

function blogFile($file){
	$file = 'admin/uploads/blogs/'.$file;
	return $file;	
}