<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle Note</title>
</head>
<body>
    <h1>Nouvelle Note Ajoutée</h1>
    <p>Bonjour,</p>
    <p>Une nouvelle note a été saisie pour vous :</p>
    <ul>
        <li><strong>Note :</strong> {{ $noteDetails['note'] }}</li>
        <li><strong>Date :</strong> {{ $noteDetails['date'] }}</li>
    </ul>
    <p>Cordialement,</p>
    <p>L'équipe {{ config('app.name') }}</p>
</body>
</html>
