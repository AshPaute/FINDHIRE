<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application System</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'hr'): ?>
                    <li><a href="../hr/hr_dashboard.php">HR Dashboard</a></li>
                <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] == 'applicant'): ?>
                    <li><a href="../applicant/applicant_dashboard.php">Applicant Dashboard</a></li>
                <?php else: ?>
                    <li><a href="../login.php">Login</a></li>
                    <li><a href="../register.php">Register</a></li>
                <?php endif; ?>
                <?php if(isset($_SESSION['username'])): ?>
                    <li><a href="../logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
