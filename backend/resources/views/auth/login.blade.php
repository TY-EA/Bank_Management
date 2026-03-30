<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #e0c3fc 0%, #8ec5fc 100%);
         
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        position: relative;
        overflow: hidden;
        
    }

    .container {
        display: flex;
        background: white;
        border-radius: 30px;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        max-width: 900px;
        width: 100%;
        min-height: 550px;
        position: relative;
        z-index: 1;
    }

    .left-panel {
        background: linear-gradient(135deg, #667eea 0%, #0b0977ff 100%);
        flex: 1;
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .left-panel::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -100px;
        left: -100px;
    }

    .left-panel::after {
        content: '';
        position: absolute;
        width: 250px;
        height: 250px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        bottom: -80px;
        right: -80px;
    }

    .left-panel h1 {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 15px;
        text-align: center;
        z-index: 1;
    }

    .left-panel p {
        font-size: 16px;
        margin-bottom: 30px;
        opacity: 0.9;
        text-align: center;
        z-index: 1;
    }

    .register-btn {
        padding: 14px 40px;
        background: transparent;
        border: 2px solid white;
        border-radius: 25px;
        color: white;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 1;
    }

    .register-btn:hover {
        background: white;
        color: #3259d8ff;
        transform: translateY(-2px);
    }

    .right-panel {
        flex: 1;
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .right-panel h2 {
        font-size: 32px;
        font-weight: 700;
        color: #333;
        margin-bottom: 40px;
        text-align: center;
    }

    label {
        font-size: 14px;
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
        color: #555;
    }

    .input-group {
        position: relative;
        margin-bottom: 25px;
    }

    input {
        width: 100%;
        padding: 14px 45px 14px 16px;
        border-radius: 10px;
        border: 1px solid #ddd;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    input:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .input-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 18px;
    }

    .forgot-password {
        text-align: right;
        margin-top: -15px;
        margin-bottom: 25px;
    }

    .forgot-password a {
        color: #667eea;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
    }

    .forgot-password a:hover {
        text-decoration: underline;
    }

    button[type="submit"] {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #2045ebff 0%, #362ccfff 100%);
        border: none;
        border-radius: 10px;
        color: white;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        margin-bottom: 25px;
    }

    button[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
    }

    button[type="submit"]:active {
        transform: translateY(0);
    }

    .social-login {
        text-align: center;
    }

    .social-login p {
        color: #30a2eeff;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .social-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .social-icon {
        width: 45px;
        height: 45px;
        border: 1px solid #ddd;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }

    .social-icon:hover {
        border-color: #284ce9ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .social-icon svg {
        width: 20px;
        height: 20px;
    }

    .error-message {
        color: #e53e3e;
        font-size: 13px;
        margin-top: -15px;
        margin-bottom: 15px;
        padding: 10px 12px;
        background: #fff5f5;
        border-radius: 8px;
        border-left: 3px solid #e53e3e;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .error-icon {
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }
        
        .left-panel {
            padding: 40px 30px;
        }
        
        .right-panel {
            padding: 40px 30px;
        }
        
        .left-panel h1 {
            font-size: 32px;
        }
        
        .right-panel h2 {
            font-size: 26px;
        }
    }
    </style>
</head>
<body>

    <div class="container">
        <!-- Left Panel -->
        <div class="left-panel">
            <h1>Hello, Welcome!</h1>
            <p>Connectez-vous à votre compte</p>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <h2>Login</h2>

            <form method="POST" action="/login">
                @csrf

                <div class="input-group">
                    <label for="email">Username</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Username" required autofocus>
                </div>
                
                @error('email')
                    <p class="error-message">
                        {{ $message }}
                    </p>
                @enderror

                <div class="input-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Password" required>
                </div>

                <div class="forgot-password">
                    <a href="#"></a>
                </div>

                <button type="submit">Login</button>
                
                @if ($errors->has('email') && $errors->first('email') === 'Email ou mot de passe incorrect.')
                    <p class="error-message">
                        {{ $errors->first('email') }}
                    </p>
                @endif

                
            </form>
        </div>
    </div>

</body>
</html>