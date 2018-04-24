<?php
session_start();
$me = $_SESSION['me'];
echo 'Your name is '.$me->name.' '.$me->surname;