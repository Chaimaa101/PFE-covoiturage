<?php
$conn = new mysqli("localhost", "root", "", "covoituragedb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}