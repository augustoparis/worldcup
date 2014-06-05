﻿<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" >
	<title><?= L::title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<?php include_once('include-css.php'); ?>	
</head>
<body>
	<?php // include_once('main-operadores-novo.php'); ?>
		
	<div class="container">
	    <div class="row">
	        <div class="col-sm-6 col-md-4 col-md-offset-4">
	            <h1 class="text-center login-title"><?= L::title ?></h1>
	            <div class="account-wall">
	                <img class="profile-img" src="img/logo.png" alt="" >
	                <form id="form-login" name="form-login" class="form-signin" >
						<div class="input-group margin-bottom-sm">
						  	<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
			                <input id="usuario" name="usuario" type="text" class="form-control" placeholder="Usuário" required autofocus >
						</div>							
						<div class="input-group margin-bottom-sm">
						  	<span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
			                <input id="senha" name="senha" type="password" class="form-control" placeholder="Senha" required >
						</div>
						<br />
		                <button class="btn btn-lg btn-primary btn-block" type="submit">Logar</button>
		                <label class="checkbox pull-left"><!-- <input type="checkbox" value="remember-me"> Remember me --></label>
		                <a href="#" class="pull-right need-help">Esqueceu a Senha?</a><span class="clearfix"></span>
	                </form>
	            </div>
				<a href="javascript:void(0)" onclick="OperadoresNovo.show()" class="text-center new-account" >Cadastre-se!</a>
	        </div>
	    </div>
	</div>

	<?php include_once('include-js.php'); ?>	
</body>
</html>