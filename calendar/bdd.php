<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=greenstudios;charset=utf8', 'root', 'djGj5DAzFChLpm');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
