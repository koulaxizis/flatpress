<?php 

$language = @$_POST['language']? $_POST['language'] :'el-gr';

$lf = "lang.$language.php";
if (!preg_match('|^lang\.[a-z]{2}-[a-z]{2}\.php$|', $lf))
	die('Σφάλμα με το αρχείο γλώσσας');

include('./setup/lang/' . $lf);
include('./setup/lib/main.lib.php');

$step = null;

$id = getstep($step);

$l =& $lang[$step];


include("./setup/tpls/header.tpl.php");
include("./setup/tpls/{$step}.tpl.php");
include("./setup/tpls/footer.tpl.php");


?>
