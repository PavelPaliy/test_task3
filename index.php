<?php
include('config.php');


function get_tree()
{
	$pdo = new \PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . ";charset=utf8;", USER, PASS, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
	
	 $query = "SELECT id, title, parent_id
	 FROM categories";
	 $cat = $pdo->query($query);
	 $categories = $cat->fetchAll(PDO::FETCH_ASSOC);
	 
	 foreach ($categories as &$category) {
	         $category['subcategories'] = array();
	         $map[$category['id']] = &$category;
	     }

	     foreach ($categories as &$category) {
	         $map[$category['parent_id']]['subcategories'][] = &$category;
	     }

	     return $map[0]['subcategories'];
	
}

print_r(get_tree());