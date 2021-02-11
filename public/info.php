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

  <script async defer data-website-id="9103710f-b999-4e6f-a5ae-878b39506f19" src="https://stats.dakovdev.com/umami.js"></script>
</head>

<body>
  <div class="container">
    <h2>API</h2>
    <div>
      <div class="alert alert-info" role="alert">
        <p>Това API използва "screen scraping" за парсване на информацията от Български пощи.</p>
        <pre>GET: https://bgpost.dakovdev.com/api/v1/tracking?code=<strong>tracking-number</strong></pre>
      </div>
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
      </div>
      <br />
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="/media/scripts.js"></script>
</body>

</html>