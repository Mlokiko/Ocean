<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="/git/app/css/register.css">
</head>
<body>
<div class="login-container">
    <h1>Dziennik</h1><br><br>
    <h2>Zarejestruj się</h2>
    <form action="" method="post">
        <div class="input-group">
            <label for="username">Nazwa użytkownika</label>
            <input type="text" name="username" id="username" autofocus>
            <label for="firstname">Imię</label>
            <input type="text" name="firstname" id="firstname" >
            <label for="lastname">Nazwisko</label>
            <input type="text" name="lastname" id="lastname" >
            <label for="password">Hasło</label>
            <input type="password" name="password" id="password">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="dateofbirth">Data urodzenia</label>
            <input type="date" name="dateofbirth" id="dateofbirth">
        </div>
        <button type="submit">Zarejestruj się</button>
    </form>
</div>
</body>
</html>
