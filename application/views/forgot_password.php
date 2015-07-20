<?php
global $baseURL, $errors, $successes;
require_once("$baseURL/application/third_party/user_cake/models/header.php");
echo "
<body>
<div id='wrapper'>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<h1>UserCake (Via CupCake)</h1>
<h2>Forgot Password</h2>
<div id='left-nav'>";

include("$baseURL/application/third_party/user_cake/left-nav.php");

echo "
</div>
<div id='main'>";

echo resultBlock($errors,$successes);

echo "
<div id='regbox'>
<form name='newLostPass' action='".str_replace('index.php/', '', site_url('forgot_password'))."' method='post'>
<p>
<label>Username:</label>
<input type='text' name='username' />
</p>
<p>    
<label>Email:</label>
<input type='text' name='email' />
</p>
<p>
<label>&nbsp;</label>
<input type='submit' value='Submit' class='submit' />
</p>
</form>
</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>