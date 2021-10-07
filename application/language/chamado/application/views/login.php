<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=base_url('vendor/css/bootstrap.css');?>">

  <title>Login</title>
</head>


<div class="container mt-5">
  <div id="formContent" class="pt-3">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="offset-4">
      <img src="<?=base_url('vendor/img/rs.png');?>" style="width: 20rem" class="rounded" alt="imagem-responsiva">
    </div>

<?php
	if($this->session->flashdata('msg-danger')){ ?>
		<div class="mt-2 alert alert-danger text-center">
			<?=$this->session->flashdata('msg-danger');?>
		</div>
<?php } ;?>

<?php
	if($this->session->flashdata('msg-success')){ ?>
		<div class="mt-2 alert alert-success text-center">
			<?=$this->session->flashdata('msg-success');?>
		</div>
<?php } ; ?>

<?php
	if($this->session->flashdata('msg-warning')){ ?>
		<div class="mt-2 alert alert-warning text-center">
			<?=$this->session->flashdata('msg-warning');?>
		</div>
<?php } ; ?>

    <!-- Login Form -->
    <form method="post" action="<?=base_url('/login');?>" class="mt-5">
	  <div class="form-group row">
		<label class="col-sm-2 col-form-label">Usuário</label>
		<div class="col-sm-8">
		  <input type="text" class="form-control" name="login" placeholder="Usuário" required>
		</div>
	  </div>
	  <div class="form-group row">
		<label class="col-sm-2 col-form-label">Senha</label>
		<div class="col-sm-8">
		  <input type="password" class="form-control" name="senha" placeholder="Senha" required>
		</div>
	  </div>
	  <input type="submit" class="btn btn-success" value="Entrar">

    </form>

  </div>
</div>
<!--<div class="text-center">
        <img src="img/rs.png" class="rounded" alt="...">
      </div>-->

<!-- Bootstrap e JavaScript -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="<?=base_url('vendor/js/jquery.mask.js');?>"></script>
	<script src="<?=base_url('vendor/js/bootstrap.js');?>"></script>

</body>

</html>