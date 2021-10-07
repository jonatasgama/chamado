<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=base_url('vendor/css/bootstrap.css');?>">
	
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Abertura de Chamados | RS</title>
</head>

    <!--Menu-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
        <div class="container">
            <a class="rounded mx-auto d-block" href="#banner"><img src="<?=base_url('vendor/img/rs.png');?>" width="200px" height="100px"
                    class="img-fluid" alt="Imagem responsiva"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto align-center">
					<li class="nav-item dropdown">
					  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">Olá, <?=$this->session->userdata('nome');?></a>
					  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="<?=base_url('/logout');?>">Logout</a>
						<a class="dropdown-item" data-toggle="modal" href="" data-target="#alterarSenha">Mudar Senha</a>
					  </div>					  
					</li>				
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('tecnico/chamadosEmFila');?>">Chamados em Fila
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('tecnico/chamadosEmAndamento');?>">Chamados em Andamento</a>
                    </li>	
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('tecnico/chamadosFinalizados');?>">Chamados Finalizados</a>
                    </li>					
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('/logout');?>">Logout</a>
                    </li>					
                </ul>
            </div>
        </div>
    </nav>
	
	<div class="modal" tabindex="-1" role="dialog" id="alterarSenha">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Alterar Senha</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<!-- formulário-->
			<form method="post" action="<?=base_url('/alterar-senha');?>" name="FormSenha">
			  <div class="form-group">
				<label for="senhaAtual">Senha Atual</label>
				<input type="password" class="form-control" id="senhaAtual" name="senhaAtual" placeholder="Senha Atual" required>
			  </div>
			  <div class="form-group">
				<label for="senhaNova">Nova Senha</label>
				<input type="password" class="form-control" id="senhaNova" name="senhaNova" placeholder="Nova Senha" required>
			  </div>
			  <div class="form-group">
				<label for="repeteSenha">Repetir Senha</label>
				<input type="password" class="form-control" id="repeteSenha" name="repeteSenha" placeholder="Repetir Senha" required>
			  </div>	
			<button type="button" class="btn btn-primary" onclick="validarSenha()">Salvar</button>		  
			</form>
			<!-- formulário-->			
		  </div>
		</div>
	  </div>
	</div>		