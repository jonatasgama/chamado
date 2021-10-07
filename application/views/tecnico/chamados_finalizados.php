    <!--Abrir chamado-->
    <div class="container border-2" style="margin-top:100px;">
        <div class="card">
            <h3 class="card-header text-dark bg-light">
                Chamados Finalizados
            </h3>
            <div class="container">

			   <!-- Posts List -->
			   <table class="table table-borderd" id='postsList'>
				 <thead>
				  <tr>
					<th scope="col">ID</th>
					<!--<th scope="col">Solicitante</th>-->
					<th scope="col">Favorecido</th>
					<th scope="col">Solicitação</th>
					<th scope="col">Status</th>
					<th scope="col">Cargo</th>
					<th scope="col">Setor</th>	
				  </tr>
				 </thead>
				 <tbody></tbody>
			   </table>
			   
			   <!-- Paginate -->
			   <div id='pagination'></div>	
			   
				<form method="post">
					<button type="submit" class="btn btn-success" name="export" formaction="<?=base_url('tecnico/extrairFinalizados');?>">Download</button>	
				</form>				
            </div>
        </div>
    </div>