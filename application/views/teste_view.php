<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set('display_errors',1);
?><!DOCTYPE html>
<html lang="en">
<head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<title>CRUD Teste</title>
</head>
<body>
	<!-- as classes das divs representam classes do bootstrap -->
	<div class="container-fluid" id="container">
		<div class="container-fluid pt-5 col-lg-8 col-sm-12">
		<form class="needs-validation" method="POST" >
			<p class="h1">Cadastro de Produtos</p>
			<p class="text-muted"> Aqui você pode cadastrar, remover, esconder e alterar produtos!<br/>
		    Produtos em vermelho estão desativados e não podem ser vistos pelos clientes</p>
			
				<table id ="tabelaDeProdutos" class="table">
					<thead>
						<tr>
							<th></th>
							<th>#</th>
							<th>Nome do produto</th>
							<th>Quantidade em estoque</th>
						</tr>
					</thead>
					<tbody>

					<?php
					$crudprodutos_obj->montarTabela();
					?>
					</tbody>
				</table>
				<input type="hidden" id="idProduto" name="idProduto">
			<hr/>
			<div class="alert alert-dark alert-dismissible fade show" role="alert">
			<?php 
			if (isset($_SESSION['msg'])){
				echo $_SESSION['msg'];
			}
			?>
  				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
  				</button>
			</div>


			<h4>O que deseja fazer?</h4>

				<div class="container" id="grupoDeOperacoes">
					<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#formularioCriar"data-parent = "#grupoDeOperacoes">Criar um produto</button>
					<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#formularioAlterar"data-parent = "#grupoDeOperacoes">Alterar um produto</button>
					<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#certezaDesativar"data-parent = "#grupoDeOperacoes">Desativar um produto</button>
					<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#certezaReativar"data-parent = "#grupoDeOperacoes">Reativar um produto</button>
				
					<div id="formularioCriar" data-parent = "#grupoDeOperacoes" class=" pt-1 px-2 collapse">

							<div class="form-group">
							<h2> Cadastro de produto</h2>
								<label for="novoNome">Qual o nome desejado?</label>
								<input type="text" class="form-control" id="nomeNovo" name="nomeNovo" placeholder="Nome do Produto">
								
								<label for="novaQtd">Qual a quantidade em estoque?</label>
								<input type="number" class="form-control" id="qtdNova" name="qtdNova" placeholder="quantidade em estoque">
								<button type="submit" class="btn btn-primary" name="criar" formaction='<?php echo base_url('cadastrarProduto'); ?>'>Cadastrar o produto</button>
							</div>

					</div>

					<div id="formularioAlterar" data-parent = "#grupoDeOperacoes" class=" pt-1 px-2 collapse">

							<div class="form-group">
								<h2> Alteração de produto</h2>
								<label for="novoNome">Qual o novo nome?</label>
								<input type="text" class="form-control" id="nomeAlterado" name="nomeAlterado"placeholder="Nome do Produto">
								
								<label for="novaQtd">Qual a nova quantidade?</label>
								<input type="number" class="form-control" id="qtdAlterada" name="qtdAlterada"placeholder="quantidade em estoque">
								<button type="submit" action= ""class="btn btn-primary" name="Alterar "formaction='<?php echo base_url('modificarProduto'); ?>'>Alterar o produto</button>
							</div>

					</div>

					<div id="certezaDesativar"  data-parent = "#grupoDeOperacoes" class=" pt-1 px-2 collapse">
						<p class="h2"> Você tem certeza que quer DESATIVAR o produto selecionado?</p>
						<input class="btn-lg btn-warning" type="submit" name="desativar" value="Desativar" formaction='<?php echo base_url('desativarProduto'); ?>'>
					</div>

					<div id="certezaReativar"  data-parent = "#grupoDeOperacoes" class=" pt-1 px-2 collapse">
					<p class="h2"> Você tem certeza que quer REATIVAR o produto selecionado?</p>
					<input class="btn-lg btn-warning" type="submit" name="reativar" value="Reativar" formaction='<?php echo base_url('reativarProduto'); ?>'>
					</div>

				</div>

			
			

		
		</form>
		</div>
	</div>


	<!-- Esses scripts são necessários para o funcionamento do bootstrap. -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<!-- inicializa as tooltips indicando que o objeto está desativado -->
	<script type="text/javascript">
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<!-- popula os campos de alterar produto com os campos da nova seleção -->
	<script type="text/javascript">

		$(
			document.getElementById('tabelaDeProdutos').addEventListener('click', popularAlteracao));



			function popularAlteracao(){
				
				var campoNome = document.getElementById("nomeAlterado");
				var campoQtd = document.getElementById("qtdAlterada");
				var campoId = document.getElementById("idProduto");


				//recupera os dados da tabela atual
				var tableInfo = Array.prototype.map.call(document.querySelectorAll('#tabelaDeProdutos tr'), function(tr){
  						return Array.prototype.map.call(tr.querySelectorAll('td'), function(td){
    					return td.innerHTML;
    				});
  				});

				//determina qual radio está selecionado
				var idSelecionado = document.querySelector('input[name="selecao"]:checked').id;
				console.log(tableInfo);
				//recupera os valores da linha selecionada e altera o input
				
				campoId.value = Number(tableInfo[idSelecionado][1]);
 				campoNome.value = tableInfo[idSelecionado][2];
				campoQtd.value = Number(tableInfo[idSelecionado][3]); 
				};

				
				function tableToArray(table) {
					var result  = [].reduce.call(table.rows, function (result, row) {
						result.push([].reduce.call(row.cells, function(res, cell) {
							res.push(cell.textContent);
							return res;
						}, []));
					return result;
					}, []);
				return result;
}
	</script>

  </body>

</html>