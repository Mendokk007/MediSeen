<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediSeen</title>
    <style>
        /* --- Color Variables --- */
        :root {
            --primary-teal: #0F766E;      /* Trust, Stability */
            --primary-hover: #0D5F59;
            --accent-coral: #F97316;      /* Interaction, Action */
            --accent-hover: #EA580C;
            --bg-off-white: #F8FAFC;      /* Calm, Clean Background */
            --text-dark: #1E293B;         /* Readability */
            --text-light: #64748B;
            --border-color: #E2E8F0;
            --danger-red: #EF4444;
        }

        /* --- Global Styles --- */
        body { 
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: var(--bg-off-white); 
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* --- Navigation --- */
        nav { 
            background: var(--primary-teal); 
            padding: 15px 30px; 
            color: white; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        nav .logo {
            font-size: 1.25rem;
            letter-spacing: 0.5px;
        }
        nav a { 
            color: white; 
            text-decoration: none; 
            margin-left: 20px; 
            font-weight: 500;
            font-size: 0.95rem;
            transition: opacity 0.2s;
        }
        nav a:hover { opacity: 0.8; }
        nav .logout-btn {
            background-color: var(--accent-coral);
            padding: 6px 12px;
            border-radius: 4px;
        }
        nav .logout-btn:hover { background-color: var(--accent-hover); }

        /* --- Main Container --- */
        .container { 
            max-width: 900px; 
            margin: 40px auto; 
            background: white; 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); 
            border: 1px solid var(--border-color);
        }
        h2 {
            color: var(--primary-teal);
            margin-top: 0;
            border-bottom: 2px solid var(--bg-off-white);
            padding-bottom: 10px;
        }
        h3 { color: var(--primary-teal); }

        /* --- Forms --- */
        label { font-weight: 600; font-size: 0.9rem; margin-top: 10px; display: block; color: var(--text-dark); }
        input, textarea { 
            width: 100%; 
            padding: 12px; 
            margin: 8px 0 20px 0; 
            border: 1px solid var(--border-color); 
            border-radius: 6px; 
            box-sizing: border-box; 
            font-family: inherit;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: var(--primary-teal);
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        }

        /* --- Buttons --- */
        button { 
            background: var(--primary-teal); 
            color: white; 
            padding: 12px 20px; 
            border: none; 
            border-radius: 6px; 
            cursor: pointer; 
            font-size: 1rem;
            font-weight: 600;
            transition: background 0.2s;
        }
        button:hover { background: var(--primary-hover); }
        .btn-accent { background: var(--accent-coral); }
        .btn-accent:hover { background: var(--accent-hover); }
        
        /* --- Alerts & Errors --- */
        .error { color: var(--danger-red); background: #FEF2F2; padding: 10px; border-radius: 6px; border-left: 4px solid var(--danger-red); }
        .success { color: #047857; background: #ECFDF5; padding: 10px; border-radius: 6px; border-left: 4px solid #047857; }
        .success a { color: #047857; font-weight: bold; }

        /* --- Tables (Dashboard) --- */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border-bottom: 1px solid var(--border-color); padding: 15px 10px; text-align: left; }
        th { background: var(--bg-off-white); color: var(--text-light); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        tr:hover { background-color: #F1F5F9; }
        
        /* --- Links --- */
        a.action-link { color: var(--primary-teal); text-decoration: none; font-weight: 500; }
        a.action-link:hover { text-decoration: underline; }
        a.delete-link { color: var(--danger-red); text-decoration: none; font-weight: 500; }
        a.delete-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <nav>
        <div class="logo"><strong>MediSeen</strong></div>
        <div>
            <a href="/mediseen/public/index.php">Home</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="/mediseen/admin/dashboard.php">Dashboard</a>
                <span style="margin-left: 20px; font-size: 0.9rem; color: #CCFBF1;">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="/mediseen/public/logout.php" class="logout-btn">Logout</a>
            <?php else: ?>
                <a href="/mediseen/public/login.php">Login</a>
                <a href="/mediseen/public/register.php" style="background: rgba(255,255,255,0.2); padding: 6px 12px; border-radius: 4px;">Register</a>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container">