<?php 

class ProdutoRepositorio{
    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    private function formarObjeto($dados){
        return new Produto($dados['id'],
                    $dados['tipo'],
                    $dados['nome'],
                    $dados['preco'],
                    $dados['descricao'],
                    $dados['imagem']);
    }


    function opcoesCafe():array{

        $sqlQuery1 = "SELECT * FROM produtos where tipo='Café'";
        $statement = $this-> pdo -> query($sqlQuery1);
        $produtosCafe = $statement -> fetchAll(PDO::FETCH_ASSOC);

            $dadosCafe = array_map(function ($cafe){
                return $this->formarObjeto($cafe);
            },$produtosCafe);
        return $dadosCafe;
    }

    function opcoesAlmoco():array{
        $sqlQuery2 = "SELECT * FROM produtos where tipo='Almoço'";
        $statement = $this->pdo ->query($sqlQuery2);
        $produtosAlmoco = $statement -> fetchAll(PDO::FETCH_ASSOC);

            $dadosAlmoco = array_map(function ($almoco){
                return $this->formarObjeto($almoco);
            },$produtosAlmoco);
        return $dadosAlmoco;
    }
    

    public function todasOpcoes():array{
        $sqlQuery3 =  'SELECT * FROM produtos ORDER BY tipo';
        $statement = $this->pdo->query($sqlQuery3);
        $queryResultOpcoes = $statement ->  fetchAll(PDO::FETCH_ASSOC);

        $dadosOpcoes = array_map(function ($opcoes){
            return $this->formarObjeto($opcoes);
        },$queryResultOpcoes);
        return $dadosOpcoes;
    }

    public function excluir(int $id){
        $sql = 'DELETE FROM produtos WHERE id = ?';
        $statement = $this->pdo -> prepare($sql);
        $statement -> bindValue(1,$id);
        $statement -> execute();
    }

    public function salvar(Produto $produto){
        $sql = "INSERT INTO produtos(tipo,nome,imagem,preco,descricao) VALUES (?,?,?,?,?); ";
        $statement = $this->pdo->prepare($sql);
        $statement -> bindValue(1,$produto -> getTipo());
        $statement -> bindValue(2,$produto -> getNome());
        $statement -> bindValue(3,$produto -> getImagem());
        $statement -> bindValue(4,$produto -> getPreco());
        $statement -> bindValue(5,$produto -> getDescricao());
        $statement -> execute();
    }

    public function buscar(int $id){
        $sql = "SELECT * FROM produtos where id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement ->bindValue(1,$id);
        $statement -> execute();

        $queryResult = $statement -> fetch(PDO::FETCH_ASSOC);
        return $this->formarObjeto($queryResult);
    }
    

    public function atualizar(Produto $produto){
        $sql = "UPDATE produtos set tipo = ?, nome = ?, descricao = ?,preco = ?, imagem = ? where id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement -> bindValue(1,$produto -> getTipo());
        $statement -> bindValue(2,$produto -> getNome());
        $statement -> bindValue(3,$produto -> getDescricao());
        $statement -> bindValue(4,$produto -> getPreco());
        $statement -> bindValue(5,$produto -> getImagem());
        $statement -> bindValue(6,$produto -> getId());
        $statement -> execute();
    }
}