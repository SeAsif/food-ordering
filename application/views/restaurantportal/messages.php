<?
if(isset($_SESSION['user_msgs'])){
	extract($_SESSION['user_msgs']);
	unset($_SESSION['user_msgs']);
}
            if (isset($success["msg"]))
			{
			?>
<div class="alert alert-success" role="alert">
	<?= $success["msg"] ?>
</div>

<?
            }	
			?>
<?
            if (isset($errors) && count($errors))
			{
			?>
<?
                    foreach ($errors as $error)
					{
						if(!empty($error)){
						?>
<div class="alert alert-danger" role="alert">
	<?= $error ?>
</div>
<?
					}
					}
					
            }
			?>
