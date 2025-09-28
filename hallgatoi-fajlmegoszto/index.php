<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hallgatói Fájlmegosztó - Széchenyi István Egyetem</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="index-page">
    <div class="container">
        <div class="login-container">
            <div class="header">
                <h1>Hallgatói Fájlmegosztó</h1>
                <p class="subtitle">Széchenyi István Egyetem</p>
            </div>
            
            <!-- Login Form -->
            <div id="loginForm" class="form-container active">
                <h2>Bejelentkezés</h2>
                <form class="form">
                    <div class="input-group">
                        <input type="text" id="loginEmail" placeholder="Felhasználónév vagy Email cím" required>
                    </div>
                    <div class="input-group">
                        <input type="password" id="loginPassword" placeholder="Jelszó" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="login()">Bejelentkezés</button>
                </form>
                <div class="form-links">
                    <a href="#" onclick="showRegisterForm()">Regisztráció</a>
                    <a href="#" onclick="showForgotForm()">Elfelejtett jelszó?</a>
                </div>
            </div>
            
            <!-- Registration Form -->
            <div id="registerForm" class="form-container">
                <h2>Regisztráció</h2>
                <form class="form">
                    <div class="input-group">
                        <input type="text" id="regUsername" placeholder="Felhasználónév" required>
                    </div>
                    <div class="input-group">
                        <input type="email" id="regEmail" placeholder="Email cím" required>
                    </div>
                    <div class="input-group">
                        <input type="password" id="regPassword" placeholder="Jelszó" required>
                    </div>
                    <div class="input-group">
                        <input type="password" id="regConfirmPassword" placeholder="Jelszó megerősítése" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="register()">Regisztráció</button>
                </form>
                <div class="form-links">
                    <a href="#" onclick="showLoginForm()">Vissza a bejelentkezéshez</a>
                </div>
            </div>
            
            <!-- Forgot Password Form -->
            <div id="forgotForm" class="form-container">
                <h2>Elfelejtett jelszó</h2>
                <p class="forgot-text">Add meg az email címedet, és küldünk egy helyreállítási linket.</p>
                <form class="form">
                    <div class="input-group">
                        <input type="email" id="forgotEmail" placeholder="Email cím" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="resetPassword()">Jelszó helyreállítása</button>
                </form>
                <div class="form-links">
                    <a href="#" onclick="showLoginForm()">Vissza a bejelentkezéshez</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="script.js"></script>
</body>
</html>