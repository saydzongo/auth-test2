<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur la plateforme</title>
    
    <!-- ✅ Ajout du style CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('/images/etudiant2.jpg'); /* ✅ Remplace par ton image */
            background-size: 50%;
            background-size: cover;
            background-position: center;
        }

        .login-box {
            width: 350px;
            padding: 30px;
            background: rgba(0, 0, 0, 0.7); /* ✅ Boîte semi-transparente */
            border-radius: 10px;
            color: white;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 20px;
        }

        .login-box input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .login-box input::placeholder {
            color: #ddd;
        }

        .login-box button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .register-btn {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #fff;
            font-size: 14px;
            background: none;
            border: 1px solid white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .welcome-box {
    font-size: 40px; /* ✅ Augmenté pour être plus visible */
    font-weight: bold;
    color: white;
    text-align: center;
    margin-bottom: 20px;
}

.cursor {
    display: inline-block;
    width: 8px;
    background: white;
    animation: blink 0.7s infinite;
}

@keyframes blink {
    50% { opacity: 0; }
}
    </style>
</head>
<body>

<div class="welcome-box">
    <span id="welcome-text"></span><span class="cursor">|</span>
</div>

    <!-- ✅ Formulaire de connexion -->
    <div class="login-box">
        <h2>Connexion</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" autocomplete="new-password" value="" required>
            <input type="password" name="password" placeholder="Mot de passe" autocomplete="new-password" value="" required>
            <button type="submit">Se connecter</button>
        </form>

        <!-- ✅ Bouton "S’inscrire" -->
        <a href="{{ route('register') }}" class="register-btn">Créer un compte</a>
        <div class="text-center mt-3">
                <a href="{{ route('password.request') }}" class="forgot-password-btn">Mot de passe oublié?</a>
        </div>
    </div>




    <script>
document.addEventListener("DOMContentLoaded", function() {
    let text = "SOYEZ LES BIENVENUS SUR NOTRE PLATEFORME!!";
    let i = 0;
    let speed = 100; // ✅ Ajuste la vitesse ici (100ms par lettre)

    function typeEffect() {
        if (i < text.length) {
            document.getElementById("welcome-text").textContent += text.charAt(i);
            i++;
            setTimeout(typeEffect, speed);
        }
    }

    typeEffect();
});
</script>

</body>
</html>