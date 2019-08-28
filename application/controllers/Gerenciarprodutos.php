<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gerenciarprodutos extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public function index()
	{

		$this->load->library('session');
		$this->load->model('crudprodutos');
		$data['crudprodutos_obj'] = $this->crudprodutos; 
		$this->load->view('teste_view', $data);
	}

    public function alterarproduto(){
		$this->load->library('session');
		$this->load->model('Crudprodutos');
		//gera um array com os dados do produto a ser criado
		$produtoAlterado = [$this->input->post('nomeAlterado'), $this->input->post('qtdAlterada'), $this->input->post('idProduto')];
		//recebe a mensagem a ser exibida ao usuário, conforme o resultado
		$msg = $this->Crudprodutos->modificarProduto($produtoAlterado);

		//retorna a mensagem ao usuário
		$this->session->set_userdata('msg', $msg);
		$this->index();
    }

    public function desativarproduto(){
		$this->load->library('session');
		$this->load->model('Crudprodutos');
		//chama o Método reativarProduto no Model, passando o id do produto a ser desativado
		//recebe a mensagem a ser exibida ao usuário, conforme o resultado
		$msg = $this->Crudprodutos->desativarproduto($this->input->post('idProduto'));

		//retorna a mensagem ao usuário
		$this->session->set_userdata('msg', $msg);
		$this->index();
    }

    public function ativarproduto(){
		$this->load->library('session');
		$this->load->model('Crudprodutos');
		//chama o Método reativarProduto no Model, passando o id do produto a ser reativado
		//recebe a mensagem a ser exibida ao usuário, conforme o resultado
		$msg = $this->Crudprodutos->reativarProduto($this->input->post('idProduto'));

		//retorna a mensagem ao usuário
		$this->session->set_userdata('msg', $msg);
		$this->index();
    }

    public function cadastrarproduto(){
		$this->load->library('session');
		$this->load->model('Crudprodutos');
		//gera um array com os dados do produto a ser criado
		$produtoNovo = [$this->input->post('nomeNovo'), $this->input->post('qtdNova')];
		//recebe a mensagem a ser exibida ao usuário, conforme o resultado
		$msg = $this->Crudprodutos->inserirProduto($produtoNovo);

		//retorna a mensagem ao usuário
		$this->session->set_userdata('msg', $msg);
		$this->index();
    }
}
