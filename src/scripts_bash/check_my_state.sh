#!/bin/bash
# Данный файл запускается по крону и сообщает мастер серверу о своем состоянии

echo "Reading config...." >&2

. /home/serv.conf

echo "servername: $servername" >&2
loadavarage=`uptime | awk -F'average: ' '{print $2}' | awk -F', ' '{print $3}'`
echo "load avarage: $loadavarage" >&2
diskgb=`df / -h | awk -F' ' '{print $2}'| grep G | grep -Eo '([0-9]*)'`
echo "Disk space: $diskgb" >&2
tmpip=`ifconfig | grep "inet addr" | grep "Bcast" | awk -F':' '{print $2}' | grep -Eo '[0-9,.]*'`
resip=""
for ip_item in $tmpip;
do
        if [ -z "$resip" ]; then
        resip=$ip_item;
        else
        resip=$resip:$ip_item;
        fi
done;
zapros=$destination"?id="$server_id"&load_avarage="$loadavarage"&diskgb="$diskgb"&ips="$resip
echo $zapros
wget -qO /dev/null $zapros
