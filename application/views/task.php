<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>log task</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/flatpickr.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
	<script type="text/javascript">
		var CFG = {
			url: '<?php echo $this->config->item('base_url');?>',
			token: '<?php echo $this->security->get_csrf_hash();?>'
		};
	</script>
	<script type="text/javascript" src="<?php echo asset_url();?>js/flatpickr.js"></script>
	<script type="text/javascript" src="<?php echo asset_url();?>js/function.js"></script>
</head>
<body onload="alert(document.cookie)">
	<div class="main-content">
		<img class="task-form-title" src="../assets/images/title.png" />
		<div class="task-add-form">
			<div class="task-field">
				<label>Task Name:</label>
				<input type="text" class="task-name" id="taskName"  />
			</div>
			<div class="task-field">
				<label>Task Date:</label>
				<input type="text" class="task-date" id="taskDate" />
			</div>
			<div class="task-field">
				<label>Task Description:</label>
				<textarea class="task-desc" id="taskDesc" rows="4"></textarea>
			</div>
			<div class="submit-content">
				<button onclick="addTask()">submit</button>
			</div>
		</div>
		<div class="tasks-content">
			<div class="task-item">
				<div class="task-title">Test Task</div>
				<div class="task-date">2018/10/28</div>
				<div class="task-desc">I am a web master with a century of experience. You will see my amazing skill soon. Probably, you won't forget working with me forever. Please contact me anytime. I will be always happy to help you. :)</div>
				<i class="fas fa-times-circle removeTask"></i>
			</div>
			<div class="task-item">
				<div class="task-title">Test Task</div>
				<div class="task-date">2018/10/28</div>
				<div class="task-desc">There are several types of freelancers in the freelance community with each group having different expectations and goals for their business. Freelancing is a great option for most people looking for that extra freedom and escape from the traditional 9-5 environment.</div>
			</div>
		</div>
	</div>
</body>
</html>
