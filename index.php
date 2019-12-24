<?php
include('config.php');


function get_tree($parent_id=0, $level = 0)
{
	$pdo = new \PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . ";charset=utf8;", USER, PASS, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
	try {
	 $query = "SELECT id, title
	 FROM categories
	 WHERE parent_id = :parent_id";
	 $cat = $pdo->prepare($query);
	 $cat->execute(['parent_id' => $parent_id]);
	 while($category = $cat->fetch())
	 {
	 	echo str_repeat('--', $level).$category['title']."<br>"; 
	 	get_tree($category['id'], $level+1);
	 }
	 return '';
	 } 
	 catch (PDOException $e) {
	 echo "Ошибка выполнения запроса: " . $e->getMessage();
	 } 

}
get_tree(0, 0);

