# bgpost

This api uses screen scraping to get the package travelling information from the bulgarian post.

## Guidelines

### Tracking number

### For international shipments:

13 characters: First letter R, C, E or V, followed by a second letter from A to Z, followed by nine digits, followed by two letters with the country code from which the shipment was sent.
For example: **RH054250664CN**, **CP004152151EN**, **EC610548787UA**, **VV015975882ES**.

### For domestic shipments:

An alphanumeric combination of thirteen characters. The number starts with the letters PS.

For example: **PS054250664CN**, **PS004152151EN**, **PS610548787UA**, **PS015975882ES**.

### RESTful URLs

- Get package data:
  - GET https://bgpost.dakovdev.com/api/v1/?code=(tracking-number)
