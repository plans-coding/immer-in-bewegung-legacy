---
sidebar_position: 6
---

# Other needs

## Expose web server to internet
Before you allow access from internet
* Add support for https
    * E.g. via Let's encrypt
* Use user authentication via
    * Authelia, or
    * Authentik, or
    * Client certificates

## Update documentation automatically
It is possible to reach spreadsheet data via API, however this is not a part of the current Immer in Bewegung release
* Login to https://console.cloud.google.com/
* Create a project, e.g. *immer-in-bewegung*
* Enable Google Sheet API for that project
* Create an API key
* Make an integration via curl and PHP e.g.