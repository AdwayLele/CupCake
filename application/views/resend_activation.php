<?php
global $baseURL, $errors, $successes;
require_once("$baseURL/application/third_party/user_cake/models/header.php");

echo "
<body>
<div id='wrapper'>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<h1>UserCake (Via CupCake)</h1>
<h2>Resend Activation</h2>
<div id='left-nav'>";

include("$baseURL/application/third_party/user_cake/left-nav.php");

echo "
</div>
<div id='main'>";

echo resultBlock($errors,$successes);

echo "<div id='regbox'>";

//Show disabled if email activation not required
if(!$emailActivation)
{ 
        echo lang("FEATURE_DISABLED");
}
else
{
	echo "<form name='resendActivation' action='".$_SERVER['PHP_SELF']."' method='post'>
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
        </form>";
}

echo "
</div>           
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>