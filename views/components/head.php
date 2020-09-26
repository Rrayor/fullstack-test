<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>

<body>
    <div id="main_container">
        <div id="head_container">
            <header>
                <div id="identity">
                    <img src="public/assets/images/pills-img.png" alt="" id="head_pills">
                    <h1 id="company_name">SPEAKER PORTAL</h1>
                </div>

                <nav id="header_nav">
                    <div id="links_container">
                        <div id="header_links">
                            <div id="language_select_container">
                                <select name="language_select" id="language_select">
                                    <option value="eng">English</option>
                                    <option value="hu">Magyar</option>
                                </select>
                            </div>
                            <a href="#">Contact</a>
                            <a href="#">Sitemap</a>
                        </div>
                        <div id="auth_links">
                            <?php
                                if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
                                    echo '
                                    <a href="#"><img src="public/assets/images/folder-img.png" width="10px" height="10px" />My Collection</a>
                                    <a href="/logout"><img src="public/assets/images/close-img.png" width="10px" height="10px" />Logout</a>
                                    ';
                                }else {
                                    echo '<a href="/login">Login</a>';
                                }
                            ?>
                        </div>
                    </div>
                    <img src="public/assets/images/logo-img.png" alt="Logo" id="header_logo">
                </nav>
            </header>