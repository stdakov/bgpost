<html class="no-js" xmlns="http://www.w3.org/1999/xhtml" lang="bg" prefix="og: http://ogp.me/ns#">

<head>
    <link rel="apple-touch-icon" sizes="57x57" href="/media/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/media/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/media/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/media/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/media/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/media/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/media/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/media/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/media/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/media/icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/media/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/media/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/media/icon/favicon-16x16.png">
    <link rel="manifest" href="/media/icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/media/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Bootstrap core CSS -->
    <link type="text/css" href="/media/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="/media/table/css/footable.bootstrap.min.css" rel="stylesheet" />
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        td,
        th {
            border: 2px solid #ddd;
        }

        table,
        td {
            font-size: 13px;
        }

        .tracking_completed .tracking_number {
            text-decoration: line-through;
        }

        .tracking_completed .track_status {
            background-color: #04f700;
        }

        .tracking_in_bg .track_status {
            background-color: #7fe7ff66;
        }

        .tracking_travel .track_status {
            background-color: #fff57f66;
        }

        .tracking_no_info .track_status {
            background-color: #ff7f7f40;
        }

        pre {
            color: black;
        }

        .hide1 {
            display: none;
        }

        .form-inline>* {
            margin: 5px 3px;
        }
    </style>

    <meta charset="utf-8" />
    <title>Проследяване на пратки по Български пощи</title>


    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="viewport" content="width=device-width" />
    <meta name="description" content="Проследяване на пратки по Български пощи, пратки от aliexpress, пратка по пощата." />
    <meta name="keywords" content="bgpost, bulgarski poshti, bulgarski poshti prosledqvane, bulgarski poshti tracking">
    <script async defer data-website-id="3243ddec-9423-4b7b-8fcc-94fe894f17f4" src="https://stats.dakovdev.com/umami.js"></script>
</head>

<body>
    <div class="container">
        <div class="page-header text-center d-print-none">
            <h1 class="mt-5">Проследяване на пратки по пощата</h1>
            <p>Данните се пазят само при вас в local storage в browser-а</p>
        </div>
        <div class="text-center">
            <form class="add-items form-inline" autocomplete="off">
                <input type="text" class="form-control" id="tracking-item" placeholder="Номер на пратката">
                <input type="text" class="form-control" id="tracking-item-link" placeholder="Линк към продукта">
                <button class="add btn btn-info" type="submit">Добави</button>
            </form>
        </div>
        <div class="row justify-content-center hide1" id="table-box">
            <table class="table table-responsive table-hover">
                <thead>
                    <tr>
                        <th data-breakpoints="xs">№</th>
                        <th>Проследяващ номер</th>
                        <th>Местонахождение</th>
                        <th data-breakpoints="xs">Статус</th>
                        <th data-breakpoints="xs">Дата</th>
                        <th data-breakpoints="xs sm">Продукт</th>
                        <th data-breakpoints="xs sm">bgPost.bg</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tracking-item-table">

                </tbody>
            </table>



        </div>

        <div class="alert alert-success hide1" id="no_item_alert" role="alert">Нямате регистрирани пратки</div>
        <div class="panel panel-default">
            <div class="panel-body">
                Въведете в празното поле проследяващия номер на пратката, който съдържа: <br />

                За международни пратки: <br />

                13 символа: Първа буква <strong>R</strong>,<strong>С</strong>, <strong>Е</strong> или <strong>V</strong>, следва втора буква от <strong>A</strong> до <strong>Z</strong>, следват девет цифри, следват две букви с кода на държавата, от която е изпратена пратката. Например: <strong>RH054250664CN</strong>, <strong>CP004152151BG</strong>, <strong>EC610548787UA</strong>, <strong>VV015975882ES</strong>. <br />

                За вътрешни пратки: <br />

                Буквено-цифрова комбинация от тринадесет символа. Номерът започва с букви <strong>PS</strong>. <br />

                На проследяване подлежат и пратки Ейвън.
            </div>
        </div>
        <a class="" style="float: right;" href="/info.php">REST API</a><br />
        <footer class="footer mt-auto py-3">
            <div class="alert alert-info" role="alert">Това <strong>не</strong> е офециалния сайт на Български пощи! Този инструмент използва "screen scraping" за парсване на информацията от Български пощи. Идеята на инструментта е да се даде възмостност за добавяне на лист от поръчки, които искаме да следим едновременно.</div>
            <?php /*
            <div class="container">
                <div class="row">
                    <span class="text-muted">created by <a href="https://twitter.com/StanislavDakov" target="_blank">@StanislavDakov</a></span>
                </div>
                <br />
            </div>
            */ ?>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="/media/moment.js"></script>
    <script type="text/javascript" src="/media/table/js/footable.min.js"></script>
    <script type="text/javascript" src="/media/scripts.js"></script>
</body>

</html>