

<?php
class Crudprodutos extends CI_Model{

    public $sqlinsert = "INSERT INTO produtos (produto, qtd, ativo) VALUES (?, ?, 1)";
    public $sqlbuscarUmProduto = "SELECT * FROM produtos WHERE id = ?";
    public $sqlbuscarPorNome = "SELECT * FROM produtos WHERE produto = ?";
    public $sqldesativar = "UPDATE produtos SET ativo = 0 WHERE id = ?";
    public $sqlreativar = "UPDATE produtos SET ativo = 1 WHERE id = ?";
    public $sqlalterar = "UPDATE produtos SET produto = ?, qtd = ? WHERE id = ?";

    //função responsável por recuperar os dados do banco de dados e retornar os mesmos em uma array
    function getProdutos(){
        $this->load->database();
        $resultado = $this->db->query('select * from produtos');
        $arrayDeProdutos = [];
        //loop cada row do resultado, e adiciona a uma array
        foreach ($resultado->result_array() as $row)
            {       
                array_push($arrayDeProdutos, $row);
            }
        //retorna uma array de arrays com os resultados
        return $arrayDeProdutos;
    }
    //função responsável por popular os dados da tabela
    function montarTabela(){
        $produtos = $this->getProdutos();
        //cria uma row na tabela representando cada produto no banco
        foreach($produtos as $linha){
            $isdesativado;
            
            if ($linha['ativo']){
                $isdesativado = "<tr>";
            } else {
                $isdesativado = "<tr class=\" table-danger data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Itens vermelhos estão desativados.\"\" >";
            }

            $botaoRadio = "
                <div class=\"form-check\">
                <td><input class =\"\" type=\"radio\" id=\"".$linha['id'] ."\" name=\"selecao\" style=\"transform:scale(1.2)\" )\"> </td>
                </div>";

            echo($isdesativado);
            echo($botaoRadio);
            echo("<td> ". $linha['id'] . "</td>");
            echo("<td> ". $linha['produto'] . "</td>");
            echo("<td> ". $linha['qtd'] ."</td>");
            echo("</tr>");
        }
    }

    function inserirProduto($itemAInserir){
        $this->load->database();

        $resultado = $this->db->query($this->sqlbuscarPorNome, array($itemAInserir[1]));

        foreach($resultado->result() as $row){
            if ($row->produto == $itemAInserir[0]){
                return("Esse produto já foi cadastrado");
            }                
        }          
        //verifica se os campos foram preenchidos corretamente
        if ($itemAInserir[0] && $itemAInserir[1]){
            $this->db->query($this->sqlinsert, $itemAInserir);
            return("O produto foi cadastrado com sucesso.");
        } else{
            return("Por favor verifique os dados do produto.");
        }
    }



    public function reativarProduto($produtoAReativar){
        $this->load->database();
        //verifica se o produto já está ativo
        $resultado = $this->db->query($this->sqlbuscarUmProduto, array($produtoAReativar));

        foreach($resultado->result() as $row){
            if ($row->ativo){
                return("Esse produto já está ativo");
            } else {
                $this->db->query($this->sqlreativar, array($produtoAReativar));
                return("O produto foi reativado.");
            }
        }    
        
    }

    function desativarProduto($ProdutoADesativar){
        $this->load->database();
        //verifica se o produto já está desativado
        $resultado = $this->db->query($this->sqlbuscarUmProduto, array($ProdutoADesativar));


        
        foreach($resultado->result() as $row){
            if (!$row->ativo){
                return("Esse produto já está desativado");
            } else {
                $this->db->query($this->sqldesativar, array($ProdutoADesativar));
                return("O produto foi desativado.");
            }
        }    
        
    }

function modificarProduto($produtoAModificar){
    $this->load->database();
        //verifica se os campos foram preenchidos corretamente
        if ($produtoAModificar[0] && $produtoAModificar[1] && $produtoAModificar[2]){
            $this->db->query($this->sqlalterar, $produtoAModificar);
            return("O produto foi modificado com sucesso.");
        } else{
            return("Por favor verifique os dados do produto.");
        }

}

}
?>