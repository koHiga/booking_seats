<?php
try{
	$pdo = new PDO(
			'mysql:dbname=php_demo;host=localhost;charset=utf8',
			'root',
			'root',
			[
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			]
			);
	
	/* ここからデータ処理を記述 */
	
	
} catch(PDOException $e) {
	header('Content-Type: text/plain; charset=UTF-8', true, 500);
	exit($e->getMessage());
}

$pdo = null;
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset=UTF-8/>
<title>Booking Seats</title>
</head>
<body>
	
</body>
</html>