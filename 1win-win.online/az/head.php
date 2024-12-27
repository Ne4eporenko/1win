<?php
function head($title, $description)
{
    return '<head>
    <meta charset="UTF-8" />
    <title>' . $title . '</title>
    <meta name="description" content="' . $description . '" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="yandex-verification" content="a4b93d97ce652269" />
    <meta name="google-site-verification" content="uXeWtx6SBtu1LjnVX0PzlbG5c0xN6s2320sOQOPYeG0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Commissioner:wght@100..900&family=M+PLUS+Rounded+1c&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/style/style.css" />
    <link rel="icon" href="/images/logo/logo.png" type="image.png" sizes="64x64" alt="logo" />
</head>';
}
