<?php

/**
 * 
 * Clear all post in wp, strip html tags
 * 
 */

include_once(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'wp-load.php');

//пропускаем определенные блоги, это их идентификаторы
$exception = array(
	1, 338, 349, 368, 371, 377, 2318, 2330
);

$total = $wpdb->get_var( "SELECT count(*) as total FROM {$wpdb->posts}");
$perpage = 100;

for($i = 0; $i <= ceil($total/$perpage); $i++)
{
		$sql = "SELECT id, post_content, post_excerpt, post_parent FROM {$wpdb->posts} ORDER by id DESC LIMIT " . $perpage . " OFFSET " . ($i * $perpage);

		if($result = $wpdb->get_results( $sql , ARRAY_A))
		{
			foreach ($result as $key => $value) {

				if(in_array($value['id'], $exception))	continue;
				if(in_array($value['post_parent'], $exception))	continue;

				$insert = array();
				$insert['post_content'] = strip_tags($value['post_content']);
				$insert['post_excerpt'] = strip_tags($value['post_excerpt']);
				$wpdb->update($wpdb->posts, $insert, array('id'=> $value['id']));
			}
		}
}

?>