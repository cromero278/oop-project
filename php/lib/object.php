<?php
namespace Deepdivedylan\DataDesign;

require_once(dirname(__DIR__, 1) . "/Classes/Author.php");

//*require_once(dirname(__DIR__, 1) . "/Classes/ValidateUuid.php");
//require_once(dirname(__DIR__, 1) . "/Classes/ValidateUuid.php");

$test = new Author (
	"befc1d76-4e82-4c47-b852-8c3a8b21300a",
	"www.test.com",
	"hahahahahahahahahahahahahahahaha",
	"test@email.com",
	"nanananananananananananananananananananananananananananananananananananananananananananananananaa",
	"testusername123");

var_dump($test);