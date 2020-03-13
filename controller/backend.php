<?php
session_start();
require('../model/frontend.php');
$req = new model;
$req->pushcoms();
