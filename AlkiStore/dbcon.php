<?php

$conn = new mysqli('localhost', 'root', '', 'alkigrocery');

if ($conn->connect_error) {
    exit('Connection failed: '.$conn->connect_error);
}





