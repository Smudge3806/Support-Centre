<div id="functions_ui">
		<table style="width:348px !important">
			<tr>
				<td>
					<a href="https://www.barnsley-ltu.co.uk/support/new/moodle/<?php echo $user->id; ?>/">Add a support request.</a>
				</td>
			</tr>
			<tr>
				<td>
					<span id="name" onclick="this.innerHTML = document.getElementById('name_options').innerHTML;this.removeAttribute('onclick')">
						Change User's Name
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<span id="pass" onclick="this.innerHTML = document.getElementById('password').innerHTML;">
						Reset Password
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<span id="dept" onclick="this.innerHTML = document.getElementById('department').innerHTML;this.removeAttribute('onclick');">
						Change Department
					</span>
				</td>
			</tr>
			<?php
				if($user->account_type == 'User')
				{
			?>
			<tr>
				<td>
					<span id="promote" onclick="this.innerHTML = document.getElementById('account').innerHTML;">
						Promote to Administrator
					</span>
				</td>
			</tr>
			<?php
				}
				else
				{
			?>
			<tr>
				<td>
					<span>
						Is an Administrator
					</span>
				</td>
			</tr>
			<?php
				}
			?>
		</table>
		<div style="display:none">
			<div id="name_options">
				<span onclick="this.parentNode.innerHTML = document.getElementById('first_name').innerHTML"><?php echo $user->first_name; ?></span>
				<span onclick="this.parentNode.innerHTML = document.getElementById('last_name').innerHTML"><?php echo $user->last_name; ?></span>
			</div>
			<div id="first_name">
				<form name="forename" action="https://www.barnsley-ltu.co.uk/controllers/change_name.php" method="post">
					<input type="hidden" name="page" value="https://www.barnsley-ltu.co.uk/user/<?php echo $user->id; ?>/admin">
					<input type="hidden" name="field" value="forename">
					<input type="text" name="info" placeholder="Forename: <?php echo $user->first_name; ?>" required>
					<input type="submit" value="Change"> 
				</form>
			</div>
			<div id="last_name">
				<form name="surname" action="https://www.barnsley-ltu.co.uk/controllers/change_name.php" method="post">
					<input type="hidden" name="page" value="https://www.barnsley-ltu.co.uk/user/<?php echo $user->id; ?>/admin">
					<input type="hidden" name="field" value="surname">
					<input type="text" name="info" placeholder="Surname: <?php echo $user->last_name; ?>" required>
					<input type="submit" value="Change"> 
				</form>
			</div>
			<div id="password">
				<form name="password" method="post" action="https://www.barnsley-ltu.co.uk/controllers/change_password.php">
					<input type="hidden" name="page" value="https://www.barnsley-ltu.co.uk/user/<?php echo $user->id; ?>/admin">
					<input type="hidden" name="password" value="password">
					<input type="submit" value="Reset Password">
				</form>
			</div>
			<div id="department">
				<?php include("controllers/department_list.php"); ?>
				<form name="department" method="post" action="https://www.barnsley-ltu.co.uk/controllers/change_department.php">
					<input type="hidden" name="page" value="https://www.barnsley-ltu.co.uk/user/<?php echo $user->id; ?>/admin">
					<input type="hidden" name="user" value="<?php echo $user->id; ?>">
					<?php include('views/department_select.php'); ?>
					<input type="submit" value="Change">
				</form>
			</div>
			<div id="account">
				<form name="account" method="post" action="https://www.barnsley-ltu.co.uk/user/<?php echo $user->id; ?>/admin">
					<input type="hidden" name="page" value="https://www.barnsley-ltu.co.uk/user/<?php echo $user->id; ?>/admin">
					<input type="hidden" name="uid" value="<?php echo $user->id; ?>">
					<input type="hidden" name="type" value="Admin">
					<input type="submit" value="Promote">
				</form>
			</div>
		</div>
</div>
