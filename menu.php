<?php
// connect to db
require_once 'db.php';
// get menu function
class MenuCreate {
	public function createMainMenu($arrayMenu) {
		if (! is_array ( $arrayMenu ) || ! count ( $arrayMenu )) {
			return;
		}
		echo '<ul class="nav navbar-nav">';
		foreach ( $arrayMenu as $key => $value ) {
			echo '<li>' . "<a href='category.php?id={$key}'> ";
			echo $value;
			echo '</a></li>';
		}
		echo '</ul>';
	}
	public function getAllCategories() {
		$link = mysqli_connect ( SERVERNAME, USERNAME, PASSWORD, DBNAME );
		if (! $link) {
			die ( 'Ошибка подключения (' . mysqli_connect_errno () . ') ' . mysqli_connect_error () );
		}
		$result = array ();
		
		$query = "SELECT id, name FROM  category" or die ( "Error in the consult.." . mysqli_error ( $link ) );
		$queryResult = $link->query ( $query );
		
		while ( $row = mysqli_fetch_array ( $queryResult ) ) {
			$result [$row ['id']] = $row ["name"];
		}
		return $result;
	}
	public function getSinglePosts() {
		$connection = new mysqli ( SERVERNAME, USERNAME, PASSWORD, DBNAME );
		if ($connection->connect_error)
			die ( $connection->connect_error );
			// $query = "SELECT * FROM post WHERE id = $value";
		$query = "SELECT * FROM post where id = '" . $_GET ['id'] . "'";
		$result = $connection->query ( $query );
		if (! $result)
			die ( $connection->error );
		$rows = $result->num_rows;
		for($j = 0; $j < $rows; ++ $j) {
			$result->data_seek ( $j );
			$row = $result->fetch_array ( MYSQLI_ASSOC );
			$post_id = $row ['id'];
			$post_title = $row ['title'];
			$post_text = $row ['text'];
			$post_create = $row ['create_at'];
			$post_author = $row ['name'];
			echo "<div>";
			echo " <h2> $post_title </h2>";
			echo "<p>$post_text</p>";
			echo "Author: $post_author , published: $post_create";
			echo "</div>";
			echo "<br />";
		}
	}
}

