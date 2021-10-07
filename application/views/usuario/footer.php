<!-- Bootstrap e JavaScript -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="<?=base_url('vendor/js/jquery.mask.js');?>"></script>
	<script src="<?=base_url('vendor/js/bootstrap.js');?>"></script>
	<script src="<?=base_url('vendor/js/md5.js');?>"></script>
	
    <script>
		function validarSenha(){
			senhaAtual = document.getElementById('senhaAtual').value;
			atual = '<?=$this->session->userdata('senha');?>';
			senhaNova = document.getElementById('senhaNova').value;
			repeteSenha = document.getElementById('repeteSenha').value;
		   if(md5(senhaAtual) != atual){
			   alert("Senha atual incorreta");
			   console.log(md5(senhaAtual));
			   console.log(atual);
		   }else if (senhaNova != repeteSenha){
			  alert("SENHAS DIFERENTES!\nFAVOR DIGITAR SENHAS IGUAIS"); 
		   }else{
			   document.FormSenha.submit();
		   }
		}
        </script>
		
   <script type='text/javascript'>
   $(document).ready(function(){
 
     $('#pagination').on('click','a',function(e){
       e.preventDefault(); 
       var pageno = $(this).attr('data-ci-pagination-page');
       loadPagination(pageno);
     });
 
     loadPagination(0);
 
     function loadPagination(pagno){
       $.ajax({
         url: '<?=base_url('usuario/paginacao/');?>'+pagno,
         type: 'get',
         dataType: 'json',
         success: function(response){
            $('#pagination').html(response.pagination);
            createTable(response.result,response.row);
         }
       });
     }
 
    function createTable(result,sno){
		sno = Number(sno);
		$('#postsList tbody').empty();
	   	console.log(result);
		for(index in result){
				var id = result[index].id;
				//var solicitante = solicitanteNome(result[index].login);
				var nome = result[index].nome;
				var solicitacao = result[index].solicitacao;
				var status = result[index].status;
				var cargo = result[index].cargo;
				var setor = result[index].setor;
				sno+=1;
		 
				var tr = "<tr>";
				tr += "<td>"+ id +"</td>";
				//tr += "<td>"+ solicitante +"</td>";
				tr += "<td>"+ nome +"</td>";
				tr += "<td>"+ solicitacao +"</td>";
				tr += "<td>"+ status +"</td>";
				tr += "<td>"+ cargo +"</td>";
				tr += "<td>"+ setor +"</td>";
				tr += "</tr>";
				$('#postsList tbody').append(tr);
		  
			}
		}
       
    });
	
    </script>		

	<script>

	function envia(){

		let nome           = document.getElementById('nome').value;
		let sobrenome      = document.getElementById('sobrenome').value;
		let cargo          = document.getElementById('cargo').value;
		let setor          = document.getElementById('setor').value;
		let solicitacao    = document.getElementById('solicitacao').value;
		let id_usuario     = document.getElementById('id_usuario').value;
		
		$.ajax({
			url : "<?=base_url('/cadastrar-chamado');?>",
			type : 'post',
			data : {
				nome : nome,
				sobrenome : sobrenome,
				cargo: cargo,
				setor: setor,
				solicitacao: solicitacao,
				id_usuario: id_usuario
			},
			beforeSend : function(){
				$("form").html(`<div class="mt-3 text-center">
				Enviado...</div>`);
				$("#loader").show();
			}
			})
			.done(function(dados){
				let myJson = JSON.parse(dados);
				$("form").html(`<div class="mt-3 alert alert-primary text-center" role="alert">
				${myJson.msg}</div>`);
				$("#loader").hide();
			})
			.fail(function(jqXHR, textStatus, msg){
			alert(msg);
			});
	}

	</script>    

</body>

</html>