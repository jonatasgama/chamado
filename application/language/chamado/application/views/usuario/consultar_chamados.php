<body>

    <!--Consultar chamado-->
    <div class="container mt-2 border-2" style="padding-top:120px;">
        <div class="card">
            <h3 class="card-header text-dark bg-light">
                Chamados <?=$this->session->flashdata('msg');?>
            </h3>
            <div class="container">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Solicitação</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>

						<?php foreach($chamados as $chamado){ ;?>
						<tr>
                            <th scope="row"><?=$chamado->id;?></th>
                            <td><?=$chamado->nome;?></td>
                            <td><?=$chamado->solicitacao;?></td>
                            <td><?=$chamado->status;?></td>
						</tr>	
						<?php } ;?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>