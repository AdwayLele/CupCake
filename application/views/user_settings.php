<?php
global $baseURL, $errors, $successes, $loggedInUser;
require_once("$baseURL/application/third_party/user_cake/models/header.php");
echo "
<body>
<div id='wrapper'>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<h1>UserCake (Via CupCake)</h1>
<h2>User Settings</h2>
<div id='left-nav'>";
include("$baseURL/application/third_party/user_cake/left-nav.php");

echo "
</div>
<div id='main'>";

echo resultBlock($errors,$successes);

echo "
<div id='regbox'>
<form name='updateAccount' action='".str_replace('index.php/', '', site_url('user_settings'))."' method='post'>
<p>
<label>Old Password:</label>
<input type='password' name='password' />
</p>
<p>
<label>Email:</label>
<input type='text' name='email' value='".$loggedInUser->email."' />
</p>
<p>
<label>New Password:</label>
<input type='password' name='passwordc' />
</p>
<p>
<label>Confirm Password:</label>
<input type='password' name='passwordcheck' />
</p>
<p>
<label>&nbsp;</label>
<input type='submit' value='Update' class='submit' />
</p>
</form>
</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>