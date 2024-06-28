#!/bin/bash

IP=$(hostname -I)
port=80
php -S $IP:$port -t src