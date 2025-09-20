<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réponse à votre message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f7;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #e91e63;
            margin-top: 0;
        }

        p {
            line-height: 1.6;
            margin: 10px 0;
        }

        blockquote {
            border-left: 4px solid #e91e63;
            margin: 15px 0;
            padding-left: 10px;
            color: #555;
            font-style: italic;
            background: #fdf1f6;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>Bonjour {{ $messageData->name }},</h2>

        <p>Merci pour votre message envoyé via mon portfolio. Voici ma réponse :</p>

        <p><strong>Votre message :</strong></p>
        <blockquote>
            {{ $messageData->message }}
        </blockquote>

        <p><strong>Ma réponse :</strong></p>
        <blockquote>
            {{ $replyContent }}
        </blockquote>

        <div class="footer">
            ✉️ Cet email vous a été envoyé automatiquement depuis le portfolio de <strong>Sylvie Seguinaud</strong>.
        </div>
    </div>
</body>

</html>
