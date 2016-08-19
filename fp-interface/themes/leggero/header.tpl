<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$flatpress.title|tag:wp_title:'&laquo;'}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$flatpress.charset}" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:image" content="avatar.png"/>
	<meta name="description" content="Το Flatpress μου!">
	<meta name="keywords" content="Flatpress, Ελληνικό, Blog, Greek">
	<meta name="author" content="ΕΛΛΗΝΙΚΟ FLATPRESS">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'/>
	{action hook=wp_head}
</head>

<body>
	<div id="body-container">

		<div id="head">
			<h1><a href="{$smarty.const.BLOG_BASEURL}">{$flatpress.title}</a></h1>
			<p class="subtitle">{$flatpress.subtitle}</p>
		</div> <!-- end of #head -->
	
	<div id="outer-container">
