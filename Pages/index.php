<?php
session_start();
require_once('../Processing/Post.php');
$Posts = new Post();
$data = $Posts->getPost()->fetchAll();
require "../Layouts/indexView.php";

