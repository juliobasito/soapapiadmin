<?php
function __autoload ($nomClasse)
{
	require_once "/model" . $nomClasse . ".php";
}
?>
