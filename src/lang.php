<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require get_languages_file();
function get_languages_file()
{
	// kijkt of lang(taal) al een waarde heeft anders pakt het en(engels)
	$_SESSION['lang'] = $_SESSION['lang'] ?? 'en';
	//kijkt of session lang een andere waarde heeft gekregen anders pakt het de vorige
	$_SESSION['lang'] = $_GET['lang'] ?? $_SESSION['lang'];


	return "talen/".$_SESSION['lang'].".php";
}


function Vertalen($str)
{
	//als lang niet empty is dan vergelijkt hij woorden met taal
	global $lang;
	if(!empty($lang[$str]))
	{
		//return vertaling
		return $lang[$str];
	}
	//return orgineel
	return $str;
}

?>