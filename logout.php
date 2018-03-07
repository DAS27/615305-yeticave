<?php
session_start();
unset($_SESSION['user']);
session_destroy();
header('Location: http://' . $_SERVER['HTTP_HOST']);
