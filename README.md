# bgpost

This api uses screen scraping to get the package travelling information from the bulgarian post.

## Guidelines

### Tracking number

#### For international shipments:

13 characters: First letter R, C, E or V, followed by a second letter from A to Z, followed by nine digits, followed by two letters with the country code from which the shipment was sent.

For example: **RH054250664CN**, **CP004152151EN**, **EC610548787UA**, **VV015975882ES**.

#### For domestic shipments:

An alphanumeric combination of thirteen characters. The number starts with the letters PS.

For example: **PS123456789A**, **PS004152151EN**, **PS610548787UA**, **PS015975882ES**.

### RESTful URLs

- Get package data:
  - GET https://bgpost.dakovdev.com/api/v1/tracking?code=tracking-number

Good response:

```json
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
```

Bad response (wrong or not supported tracking number):

```json
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
```

Bad response (missing information):

```json
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
```
