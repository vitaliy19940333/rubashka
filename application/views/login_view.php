<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Авторизация</title>
	<link rel="stylesheet" href="/css/style_auth.css" media="screen" type="text/css" />
	
</head>

<body>
    <div class="vladmaxi-top">
        <a href="#">Администрирование Emerson</a>
    <div class="clr"></div>
    </div>

	<div id="login">
		<h2><span class="fontawesome-lock"></span>Авторизация</h2>
		<form action="" method="POST">
			<fieldset>
				<p><label for="email">Логин или Email:</label></p>
				<p><input type="email" name='login' id="email" value="Логин" onBlur="if(this.value=='')this.value='логин'" onFocus="if(this.value=='Логин')this.value=''"></p>

				<p><label for="password">Пароль:</label></p>
				<p><input type="password" name="password" id="password" value="Пароль" onBlur="if(this.value=='')this.value='Пароль'" onFocus="if(this.value=='Пароль')this.value=''"></p> 
				<p><input type="submit"  name='enter' value="ВОЙТИ"></p>
			</fieldset>
		</form>
	</div>
</body>	
</html>