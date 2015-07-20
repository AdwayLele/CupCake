<?php
global $baseURL, $errors, $successes;
require_once("$baseURL/application/third_party/user_cake/models/header.php");
echo "
<body>
<div id='wrapper'>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<h1>UserCake (Via CupCake)</h1>
<h2>Register</h2>

<div id='left-nav'>";
include("$baseURL/application/third_party/user_cake/left-nav.php");
echo "
</div>

<div id='main'>";

echo resultBlock($errors,$successes);

echo "
<div id='regbox'>
<form name='newUser' action='".str_replace('index.php/', '', site_url('register'))."' method='post'>

<p>
<label>User Name:</label>
<input type='text' name='username' />
</p>
<p>
<label>Display Name:</label>
<input type='text' name='displayname' />
</p>
<p>
<label>Password:</label>
<input type='password' name='password' />
</p>
<p>
<label>Confirm:</label>
<input type='password' name='passwordc' />
</p>
<p>
<label>Email:</label>
<input type='text' name='email' />
</p>
<p>
<label>Security Code:</label>".
$cap['image']
."</p>
<label>Enter Security Code:</label>
<input name='captcha' type='text'>
</p>
<label>&nbsp;<br>
<input type='submit' value='Register'/>
</p>

</form>
</div>

</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>