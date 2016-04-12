<?php

/*
Student Name: Parag Mahajan
Student Id: 496019X
Description : this file destroys session.
*/
// code to destroy login session and redirecting to login page
	session_start();
	session_destroy();
	header("location:login.htm");
?>