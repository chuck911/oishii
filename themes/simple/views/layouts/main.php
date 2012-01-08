<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jScrollPane.css" rel="stylesheet">
		<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/facebox.css" rel="stylesheet">
		<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet">
		<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.min.js"></script>
		<script src="<?php echo Yii::app()->baseUrl; ?>/js/jScrollPane.js"></script>
		<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.mousewheel.js"></script>
		<script src="<?php echo Yii::app()->baseUrl; ?>/js/facebox.js"></script>
		<script>
			var themeBase = "<?php echo Yii::app()->theme->baseUrl; ?>";
		</script>
		<script src="<?php echo Yii::app()->baseUrl; ?>/js/app.js"></script>
	</head>
	<body>
		<div class="container-fluid">
			<?php echo $content; ?>
		</div>
	</body>
</html>