---
sidebar_position: 2
---

# Installation

## Using Docker (Recommended)

**Step 1 − Download files**

Download all files from folder *bewegung-app* or download the release file.

**Step 2 − Unpack and run docker container**
```
# Go to your home directory
cd

# Download and unzip the archive
wget
unzip bewegung
mkdir bewegung

# Go to the directory
cd bewegung

# Initiate your Docker container
sudo docker compose up -d
```
**Step 3 − Edit settings file**
```text title="nano edit bewegung/iib-settings.yaml"
### Add your data source
trip-data:
  - provider: google-sheet
    spreadsheet-id: ENTER-YOUR-GOOGLE-SPREADSHEET-ID #<-----
    spreadsheet-name: ENTER-YOUR-GOOGLE-SPREADSHEET-NAME #<-----
    overview-name: Overview
    overview-gid: ENTER-OVERVIEW-GID #<-----
    events-name: Events
    events-gid: ENTER-EVENTS-GID #<-----
    map-name: Map
    map-gid: ENTER-MAP-GID #<-----

### Change Immich settings
immich-settings:
  - immich-server-address: http://127.0.0.1:2283/ # Remember last dash /
```
**Step 4 − Save trip data from data set**

Save your three sheets in tsv format to `bewegung/www/data/`. Read more under [Create the dataset](./create-dataset).

**Step 5 − Test you installation**

Your instance is not reachable at

http://localhost:2024/

## Install on bare metal

* Install a webserver (Nginx or Apache with PHP)
* Install yaml for php (sudo apt-get install php-yaml)