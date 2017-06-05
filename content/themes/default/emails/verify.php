<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700" rel="stylesheet"> 
    </head>
    <body style="text-align: center; margin: 0; font-family: 'Open Sans', sans-serif;">
    <div style="background: #6F628C; padding: 10px 0 0; margin-bottom: 20px; text-align: center;">
    <img src="http://www.tellyvizion.com/content/uploads/settings/img-logo.png" style="height: auto; width: 200px;">
    </div>

        <h2 style="text-align: center; background: none;">Verify Your Email Address</h2>
        <div style="text-align: center;  font-size: 19px; line-height: 40px; margin-bottom: 30px;  margin-top: 30px; padding-left: 3%;  padding-right: 3%;"> Thanks for creating an account with <?= $website_name ?>.<br/>
            Please follow the link below to verify your email address<br/>
            <span style="color:#6F628C ;text-align: center;"><?= URL::to('verify/' . $activation_code) ?></span></div>
<div style="padding: 10px 0; background: #D8D8D8; margin-top: 50px; text-align: center;">Copyright © 2017 Tellyvizion</div>



        

    </body>
</html>