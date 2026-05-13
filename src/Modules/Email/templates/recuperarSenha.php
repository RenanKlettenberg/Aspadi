<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            color: #333;
        }

        .card {
            background: #fff;
            max-width: 400px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .code-box {
            background-color: #e9ecef;
            color: #007bff;
            padding: 15px 20px;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 5px;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
            border: 1px dashed #007bff;
        }

        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 25px;
            line-height: 1.5;
        }

        h2 {
            color: #222;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Recuperação de Senha</h2>
        <p>Use o código abaixo para validar a alteração de senha da sua conta na <strong>Aspadi</strong>.</p>

        <div class="code-box"><?=$params['usu_codigo_auth']?></div>

        <p class="footer">
            Este código é válido até amanhã às <?= (new DateTime('+1 day'))->format('H:i:s') ?>.<br>
            Se não foi você quem solicitou, basta ignorar este e-mail por segurança.
        </p>
    </div>

    <? include_once("footer.php"); ?>
</body>

</html>