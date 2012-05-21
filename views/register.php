<div class="register">
	<fieldset class="container" id="register">
		<form method="get" action="controllers/register.php">
		<table>
			<tr>
				<td>Email Address:</td>
				<td><input type="text" name="email" value="Email Address" onfocus="ClickClear(this, 'Email Address')" onblur="ClickReturn(this, 'Email Address')"></td>
				
			</tr>
			<tr>
				<td>Full Name:</td>
				<td><input type="text" name="name" value="Full Name" onfocus="ClickClear(this, 'Full Name')" onblur="ClickReturn(this, 'Full Name')" ></td>
				
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" value="Password" onfocus="ClickClear(this, 'Password')" onblur="ClickReturn(this, 'Password')" ></td>
				
			</tr>
			<tr>
				<td>Department:</td>
				<td><select name="department" onchange="unlock()">
					<option value="Select a Department">Select a Department</option>
					<option value="Learning Technologies Unit">Learning Technologies Unit</option>
				</select></td>
				
			</tr>
			<tr>
				<!--ReCaptcha Goes Here-->
			</tr>
			<tr>
				<td></td>
				<td><input id="submit" type="hidden" value="Register"></td>
			</tr>
		</table>
		</form>
	</fieldset>
</div>
