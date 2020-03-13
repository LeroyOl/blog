<?php
session_start();
require_once('../Processing/Post.php');
$Post = new Post();
$data = $Post->PostShow()->fetchAll();
require "../Layouts/commentsView.php";
