<?php
try {
	
	$objDb = new PDO('mysql:host=localhost;dbname=comments', 'root', 'password');
	$objDb->exec('SET CHARACTER SET utf8');
	
	$sql = "SELECT *,
			DATE_FORMAT(`date`, '%d/%m/%Y') AS `date_formatted`
			FROM `comments`
			WHERE `active` = 1
			ORDER BY `date` ASC";
	$statement = $objDb->query($sql);
	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
	
} catch(Exception $e) {
	echo $e->getMessage();
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Confirm dialog with jQuery</title>
<meta name="description" content="Confirm dialog with jQuery">
<meta name="keywords" content="Confirm dialog with jQuery">
<meta name="author" content="SSD Tutorials">
<link rel="stylesheet" href="/css/core.css" media="all" type="text/css">
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>

<div id="wrapper">

	<div id="comments">
	
		<?php if (!empty($posts)) { ?>
			
			<?php foreach($posts as $row) { ?>
			
				<div class="comment">
				
					<div class="confirm">
						<a href="#" class="button buttonGreen cancel flr">No</a>
						<a href="#" class="button remove flr mrr4" data-id="<?php echo $row['id']; ?>">Yes</a>
						<span>Are you sure you wish to remove this record?</span>
					</div>
					
					<div class="commentContent">
						
						<a href="#" class="removeConfirm flr">Remove</a>
						<span class="name">Posted by <?php echo htmlentities(stripslashes($row['full_name'])); ?>
						 on <time datetime="<?php echo date('Y-m-d', $row['date']); ?>"><?php echo $row['date_formatted']; ?></time></span>
						<p><?php echo htmlentities(stripslashes($row['comment'])); ?></p>
					</div>
					
				</div>
			
			<?php } ?>
			
		<?php } else { ?>
			
			<p>There are currently no comments.</p>
			
		<?php } ?>
		
	</div>

</div>

<script src="/js/jquery-1.7.1.min.js"></script>
<script src="/js/core.js"></script>
</body>
</html>



