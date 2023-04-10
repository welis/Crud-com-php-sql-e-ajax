<?php
 include './model/coneccao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <title>Cadastro de clientes</title>
</head>
<body>

<div class="container-fluid" style="padding: 50px;">
	<div class="row">
		<div class="col-md-6">
            <form method = "POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>
                <div class="mb-3">
                    <label for="endereco" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="endereco" name="cpf">
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="email" name="endereco">
                </div>
                <button type="submit" class="btn btn-primary" name="cadastrar">Cadastrar</button>
            </form>
		</div>
		<div class="col-md-6">
            <?php
                $conexao = new Conexao();
                $dbh = $conexao->conectar();
                $sql = "SELECT * FROM cliente";
                $stmt = $dbh->prepare($sql);
                $stmt->execute();
            ?>
            <table class="table">
                <tr class="table-dark">
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Opções</th>
                </tr>
                <tr>
                    <?php while($cliente = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                    <td><?php echo $cliente->nome; ?></td>
                    <td><?php echo $cliente->cpf; ?></td>
                    <td><?php echo $cliente->telefone; ?></td>
                    <td><?php echo $cliente->endereco; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $cliente->id; ?>" class="btn btn-primary">Editar</a>
                        <a href="excluir.php?id=<?php echo $cliente->id; ?>" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
		</div>
	</div>
</div>

<?php
    if(isset($_POST['cadastrar'])) {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        $sql = "INSERT INTO cliente (nome, cpf, telefone, endereco) VALUES (:nome, :cpf, :telefone, :endereco)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            echo "<script>alert('Cliente cadastrado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar cliente!');</script>";
        }
    }
    
?>  
</body>
<script>
    $(document).ready(function() {
        $('#cadastrar').click(function() {
            var dados = $('#form').serialize();
            $.ajax({
                url: 'cadastrar.php',
                type: 'POST',
                dataType: 'html',
                data: dados,
                success: function(data) {
                    alert(data);
                }
            });
        });
    });
</script>
</html>