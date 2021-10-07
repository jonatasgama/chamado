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
</body>

</html>