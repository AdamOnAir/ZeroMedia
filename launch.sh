#!/bin/bash

IP=$(hostname -I)
port=8080
sudo php -S 192.168.1.17:$port -t src
