<html class="no-js" xmlns="http://www.w3.org/1999/xhtml" lang="bg" prefix="og: http://ogp.me/ns#">

<head>
    <!-- Bootstrap core CSS -->
    <link href="/media/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        td,
        th {
            border: 1px solid black;
            padding: 5px;
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
    </style>

    <meta charset="utf-8" />
    <title>Проследяване на пратки по Български пощи</title>


    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="viewport" content="width=device-width" />
    <meta name="description" content="Проследяване на пратки по Български пощи, пратки от aliexpress, пратка по пощата, bgpost" />


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VQJ5L4HHEW"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-VQJ5L4HHEW');
    </script>

</head>

<body>
    <div class="container">
        <div class="page-header text-center">
            <h1 class="mt-5">Проследяване на пратки по пощата - <a href="http://www.bgpost.bg/" target="_blank">bgPost.bg</a></h1>
            <p>Данните се пазят само при вас в local storage в browser-а</p>
        </div>
        <div class="row text-center">
            <form class="add-items form-inline" autocomplete="off">
                <input type="text" class="form-control" id="tracking-item" placeholder="Номер на пратката">
                <input type="text" class="form-control" id="tracking-item-link" placeholder="Линк към продукта">
                <button class="add btn btn-sm btn-info" type="submit">Проследи</button>
            </form>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-auto">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Проследяващ номер</th>
                            <th>Статус</th>
                            <th>Дата</th>
                            <th>Продукт</th>
                            <th>bgPost.bg</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tracking-item-table">

                    </tbody>
                </table>
            </div>
        </div>
        <div>
            Въведете в празното поле проследяващия номер на пратката, който съдържа: <br />

            За международни пратки: <br />

            13 символа: Първа буква <strong>R</strong>,<strong>С</strong>, <strong>Е</strong> или <strong>V</strong>, следва втора буква от <strong>A</strong> до <strong>Z</strong>, следват девет цифри, следват две букви с кода на държавата, от която е изпратена пратката. Например: <strong>RH054250664CN</strong>, <strong>CP004152151BG</strong>, <strong>EC610548787UA</strong>, <strong>VV015975882ES</strong>. <br />

            За вътрешни пратки: <br />

            Буквено-цифрова комбинация от тринадесет символа. Номерът започва с букви <strong>PS</strong>. <br />

            На проследяване подлежат и пратки Ейвън. <br /> <br />
            <h2>API:</h2>
            <p>Това API използва "screen scraping" за парсване на информацията от Български пощи.</p>
            <pre>GET: https://bgpost.dakovdev.com/api/v1/tracking?code=<strong>tracking-number</strong></pre>
            Резултат с данни:
            <pre>
[
  {
    "date": "09.08.2020   22:35",
    "country": "SINGAPORE",
    "location": "SINGAPORE SAL",
    "event": "Insert item into bag (Otb) and Send item abroad",
    "info": "",
    "status": "traveling"
  },
  {
    "date": "12.08.2020   22:35",
    "country": "SINGAPORE",
    "location": "SINGAPORE SAL",
    "event": "Send item abroad (EDI-received)",
    "info": "",
    "status": "traveling"
  },
  {
    "date": "31.08.2020   11:15",
    "country": "BULGARIA",
    "location": "SOFIA LC/AO",
    "event": "Receive item at office of exchange (Inb)",
    "info": "",
    "status": "traveling"
  },
  {
    "date": "31.08.2020   13:18",
    "country": "BULGARIA",
    "location": "SOFIA LC/AO",
    "event": "Send item to domestic location (Inb)",
    "info": "",
    "status": "traveling"
  },
  {
    "date": "11.09.2020   16:30",
    "country": "BULGARIA",
    "location": "IRM CC 1880",
    "event": "Deliver item (Inb)",
    "info": "",
    "status": "traveling"
  }
]
            </pre>
            Резултат без данни:
            <pre>
[
  {
    "date": "",
    "country": "",
    "location": "",
    "event": "",
    "info": "",
    "status": "no_data"
  }
]
            </pre>
            Резултат с грешен номер:
            <pre>
[
  {
    "date": "",
    "country": "",
    "location": "",
    "event": "",
    "info": "",
    "status": "wrong_code"
  }
]
            </pre>
        </div>
    </div>
    <footer class="footer mt-auto py-3">
        <div class="container">
            <div class="row">
                <span class="text-muted">created by <a href="https://twitter.com/StanislavDakov" target="_blank">@StanislavDakov</a></span>
                <span class="text-muted" style="float: right;">open source project at <a href="https://github.com/stdakov/bgpost" target="_blank">github</a></span>

            </div>
            <br />
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="/media/scripts.js"></script>
</body>

</html>