    <!--Abrir chamado-->
    <div class="container border-2" style="margin-top:100px;">
        <div class="card">
            <h3 class="card-header text-dark bg-light">
                Chamados em Andamento
            </h3>
            <div class="container">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
							<th scope="col">Solicitante</th>
                            <th scope="col">Beneficiado</th>
                            <th scope="col">Solicitação</th>
                            <th scope="col">Status</th>
							<th scope="col">Cargo</th>
							<th scope="col">Setor</th>							
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach($chamados as $chamado){ ;?>
                        <tr>
                            <th scope="row"><?=$chamado->id;?></th>
							<td><?=$chamado->solicitante;?></td>
                            <td><?=$chamado->nome;?></td>
                            <td><?=$chamado->solicitacao;?></td>
                            <td><?=$chamado->status;?></td>
							<td><?=$chamado->cargo;?></td>
							<td><?=$chamado->setor;?></td>							
                            <td>
							<button class="btn btn-light btn-sm" onclick="enviaIdFinaliza(<?=$chamado->id;?>)" data-toggle="modal" data-target="#finalizar"><i class="far fa-calendar-check text-success"></i></button>
							<button class="btn btn-light btn-sm" onclick="enviaIdCancela(<?=$chamado->id;?>)" data-toggle="modal" data-target="#cancelar"><i class="far fa-calendar-times text-danger"></i></button>
							</td>
                        </tr>
						<?php } ;?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
	
	<div class="modal" tabindex="-1" role="dialog" id="finalizar">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Resolução do Chamado</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
		  
			<form method="post" action="<?=base_url('tecnico/finaliza');?>">
			  <div class="form-group">
				<div class="form-group">
					<label for="resolucao">Resolução</label>
					<textarea class="form-control" id="resolucao" name="resolucao" rows="3"></textarea>
					<input type="hidden" id="id_finaliza" name="id">
				</div>
				<button class="btn btn-primary" >Salvar</button>
			</form>
			
			</div>
		 </div>
	   </div>
	  </div>	
	</div>
	
	<div class="modal" tabindex="-1" role="dialog" id="cancelar">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Motivo do cancelamento</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
		  
			<form method="post" action="<?=base_url('tecnico/cancela');?>">
			  <div class="form-group">
				<div class="form-group">
					<label for="resolucao">Resolução</label>
					<textarea class="form-control" id="resolucao" name="resolucao" rows="3"></textarea>
					<input type="hidden" id="id_cancela" name="id">
				</div>
				<button class="btn btn-primary" >Salvar</button>
			</form>
			
			</div>
		 </div>
	   </div>
	  </div>	
	</div>	