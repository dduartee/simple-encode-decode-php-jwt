<?php

require 'JWT.php';
$jwt = new JWT();

if(isset($_POST['encode'])) {
    $secret = $_POST['secret'];
    $payload = array(
        "nome" => $_POST['nome'],
        "email" => $_POST['email']
    );
    $token = $jwt::encode($payload, $secret);
}
if(isset($_POST['decode'])) {
    $tokendecode = $jwt::decode($_POST['jwt'], $_POST['secret'], array('HS256'));
    $decoded_array = (array) $tokendecode;
    $decodedToken = null;
    foreach ($decoded_array as $key => $value) {
        $decodedToken .= $key.": ".$value."<br>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>simple JWT encode and decode</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
    div {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-content: center;
        align-items: center;
    }
    </style>
</head>

<body>
    <div class="mx-auto">
        <h5>Encode JWT</h5>
    </div>
    <div class="form-group">
        <form method="POST">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome">
            <label for="email">Email</label>
            <input type="text" id="email" name="email">
            <label for="secret">Secret</label>
            <input type="password" id="secret" name="secret">
            <input type="submit" id="button" name="encode" value="Encode">
        </form>
        <?php if(isset($token)) { ?>
            <p>Seu token JWT: <?php echo $token; ?></p>
        <?php } ?>
    </div>
    <div class="mx-auto">
        <h5>Decode JWT</h5>
    </div>
    <div class="form-group">
        <form method="POST">
            <label for="jwt">JWT</label>
            <input type="text" id="jwt" name="jwt">
            <label for="secret">Secret</label>
            <input type="password" id="secret" name="secret">
            <input type="submit" id="button" name="decode" value="Decode">
        </form>
        <?php if(isset($decodedToken)) { ?>
            <p>Seu token JWT decodificado: <br><?php echo $decodedToken; ?></p>
        <?php } ?>
    </div>
</body>

</html>