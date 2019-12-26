<?php
include('config.php');


function get_tree()
{
	$pdo = new \PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . ";charset=utf8;", USER, PASS, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
	
	 $query = "SELECT categories_id, parents_id
	 FROM categories";
	 $cat = $pdo->query($query);
	 $categories = $cat->fetchAll(PDO::FETCH_ASSOC);
	 $map = array(
	         0 => array('subcategories' => array())
	     );
	 foreach ($categories as &$category) {
	        //в массиве создается подмассив с полем 'subcategories'
	         $category['subcategories'] = array();
	         /*в массив $map заносим категорию, передача идет по ссылке, потому что иначе категории не будут обновляться при добавлении подкатегорий*/
	         $map[$category['categories_id']] = &$category;
	         /* добавление категорий в массив 'subcategories' родителя */
	         $map[$category['parents_id']]['subcategories'][] = &$category;
	         
	     }

	     
	     return $map[0]['subcategories'];
	
}

print_r(get_tree());
