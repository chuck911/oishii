<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/facebox.css" rel="stylesheet">
		<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bookmark.css" rel="stylesheet">
	</head>
	<body>
		<div id="facebox">
			<div class="popup">
				<div class="content">
					<?php
					$popup = 1; 
					$this->renderPartial('_bookmark_detail_form',compact('url','title','tags','popup')); 
					?>
				</div>
			</div>
		</div>
	</body>
</html>