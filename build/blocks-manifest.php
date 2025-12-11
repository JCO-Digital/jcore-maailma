<?php
// This file is generated. Do not modify it manually.
return array(
	'global-content' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'jco/global-content',
		'version' => '0.1.0',
		'title' => 'JCORE Global Content',
		'category' => 'widgets',
		'icon' => 'text-page',
		'description' => '',
		'attributes' => array(
			'selectedPostId' => array(
				'type' => 'integer',
				'default' => 0
			)
		),
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'jcore-maailma',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'render' => 'file:./render.php'
	)
);
