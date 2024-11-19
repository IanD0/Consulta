<?php
include('conexao.php');
include('protect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Busca - Rocha Soluções</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Consulta de dados</h1>
        <form action="" method="get" class="search-form">
            <input name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Digite os termos de pesquisa" type="text">
            <button type="submit">Pesquisar</button>
        </form>
        <br>
        <table class="data-table">
            <tr>
                <th>CPF</th>
                <th>TELEFONE 1</th>
                <th>TELEFONE 2</th>
            </tr>
            <?php
            if (!isset($_GET['busca']) || empty($_GET['busca'])) {
                ?>
                <tr>
                    <td colspan="3">Digite algo para pesquisar...</td>
                </tr>
                <?php
            } else {
                $pesquisa = $mysqli->real_escape_string($_GET['busca']);

                // Verifica se a pesquisa tem pelo menos 11 caracteres
                if (strlen($pesquisa) < 11) {
                    ?>
                    <tr>
                        <td colspan="3">Por favor, insira pelo menos 11 caracteres para realizar a busca.</td>
                    </tr>
                    <?php
                } else {
                    $sql_code = "SELECT * 
                        FROM consultaclientes 
                        WHERE cpf LIKE '%$pesquisa%' 
                        OR telefone1 LIKE '%$pesquisa%' 
                        OR telefone2 LIKE '%$pesquisa%' 
                        LIMIT 1"; 
                    
                    $sql_query = $mysqli->query($sql_code) or die("ERRO ao consultar! " . $mysqli->error); 
                    
                    if ($sql_query->num_rows == 0) {
                        ?>
                        <tr>
                            <td colspan="3">Nenhum resultado encontrado...</td>
                        </tr>
                        <?php
                    } else {
                        // Apenas o primeiro resultado será exibido
                        $dados = $sql_query->fetch_assoc();
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($dados['cpf']); ?></td>
                            <td><?php echo htmlspecialchars($dados['telefone1']); ?></td>
                            <td><?php echo htmlspecialchars($dados['telefone2']); ?></td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
        </table>
    </div>
</body>
</html>
