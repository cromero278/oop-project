<?php
namespace cromero278\oop;

require_once(dirname(__DIR__, 1) . "/Classes/Author.php");

//*require_once(dirname(__DIR__, 1) . "/Classes/ValidateUuid.php");
//require_once(dirname(__DIR__, 1) . "/Classes/ValidateUuid.php");

$test = new Author (
	"8eb2afba6ae64749919abcffb904dbe6",
	"www.test.com",
	"hahahahahahahahahahahahahahahaha",
	"test@email.com",
	"nanananananananananananananananananananananananananananananananananananananananananananananananaa",
	"testusername123");

var_dump($test);

