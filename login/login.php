<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../signup/style.css">
<title>Book Store | Sign In</title>
</head>
<div class="container">
    <form id="signup" action="signincheck.php" method="post">

        <div class="header">
        
            <h3>Sign in</h3>
            
        </div>
        
        <div class="sep"></div>

        <div class="inputs">
        
            <input type="text" name="username" placeholder="Username" required="" autofocus />
        
            <input type="password" name="password" placeholder="Password" required=""/>

            <div class="checkboxy">
                <input name="checky" id="checky" value="1" type="checkbox" /><label class="terms">I'm an adminisrator</label>
            </div>
            
            <input id="submit" type="Submit" name="Submit" value="Sign in">

        </div>

    </form>

</div>
</body>
</html>