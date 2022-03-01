#!/bin/bash
CURRENT_USER=$(whoami)
 echo julian1 | sshpass -p "julian1" ssh -tt -o StrictHostKeyChecking=No jq52@10.242.196.151 "sudo service rabbitmq-server start "
 #echo h8 | sshpass -p "h8" ssh -tt -o StrictHostKeyChecking=No jq53@10.242.109.103 "sudo service rabbitmq-server start "
echo password | sshpass -p "password" ssh -tt -o StrictHostKeyChecking=No casey@10.242.222.211 "sudo service mysql start"
echo Cameron10# | sshpass -p "Cameron10#" ssh -tt -o StrictHostKeyChecking=No cameron9167@10.242.244.173 "echo hostname -I"
echo dpp58@njit.edu | sshpass -p "dpp58@njit.edu" ssh -tt -o StrictHostKeyChecking=No deep@10.242.60.95 "sudo service apache2 start"
