<body>

    <!--Abrir chamado-->
    <div class="container border-2" style="padding-top:120px;">
        <div class="card">
            <h3 class="card-header text-dark bg-light">
                Abrir Chamado
            </h3>
            <div class="container">
                <form method="post" action="<?=base_url('/cadastrar-chamado');?>">
                    <div class="form-row mt-2">
                        <div class="form-group col-md-6">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sobrenome">Sobrenome</label>
                            <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="sobrenome" required>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="form-group col-md-6">
                            <label for="cargo">Cargo</label>
                            <select name="cargo" class="form-control">
                                <option selected>Escolher...</option>
                                <option value="consultor">Consultor</option>
                                <option value="gerente">Gerente</option>
                                <option value="auxiliar">Auxiliar</option>
                                <option value="supervisor">Supervisor</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="setor">Setor</label>
                            <select name="setor" class="form-control">
                                <option selected>Escolher...</option>
                                <option value="consignado">Consignado</option>
                                <option value="dp/rh">DP/RH</option>
                                <option value="financeiro">Financeiro</option>
                            </select>
                        </div>
                    </div>
					
					<div class="row">
						<div class="col-12 mt-2">
						<label for="solicitacao">Solicitação</label>
							<div class="input-group">
								<textarea class="form-control" id="solicitacao" name="solicitacao" required></textarea>
							</div>
							<input type="hidden" name="id_usuario" value="<?=$this->session->userdata('id');?>">
							<div class="float-right mt-3 mb-3">
								<button type="submit" class="btn btn-success">Enviar</>
							</div>
						</div>				
					</div>					
                </form>
				
            </div>
		</div>	
	</div>