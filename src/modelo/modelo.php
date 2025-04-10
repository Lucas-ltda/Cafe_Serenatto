<?php

Class Produto{
    private ?int $id;
    private string $tipo;
    private string $nome;
    private string $imagem;
    private float $preco;
    private string $descricao;

    function __construct(?int $id, string $tipo, string $nome, float $preco, string $descricao, string $imagem = 'logo-serenatto.png') {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->nome = $nome;
        $this->imagem = !empty($imagem) ? $imagem : 'logo-serenatto.png';
        $this->preco = $preco;
        $this->descricao = $descricao;
    }    
    

    public function getId():int{
        return $this->id;
    }

    public function getTipo():string{
        return $this->tipo;
    }

    public function getNome():string{
        return $this->nome;
    }

    public function getImagem():string{
        return $this->imagem;
    }

    public function getImagemFormated():string{
        return "img/".$this->imagem;
    }
    public function getPreco():float{
        return $this->preco;
    }

    public function getPrecoFormated():string{
        return "R$ ".number_format($this->preco,2);
    }

    function getDescricao():string{
        return $this->descricao;
    }

    function setImagem(string $imagem){
        $this->imagem = $imagem;
    }
}