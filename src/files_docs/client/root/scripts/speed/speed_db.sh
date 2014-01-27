#! /bin/bash

interface=eth0

rx1=`cat /sys/class/net/$interface/statistics/rx_bytes`
tx1=`cat /sys/class/net/$interface/statistics/tx_bytes`

cpu_load_all1=`cat /proc/stat | head -1`
cpu_load_user1=`echo $cpu_load_all1 | awk '{print $2}'`
cpu_load_nice1=`echo $cpu_load_all1 | awk '{print $3}'`
cpu_load_system1=`echo $cpu_load_all1 | awk '{print $4}'`
cpu_load_idle1=`echo $cpu_load_all1 | awk '{print $5}'`

echo $cpu_load_all1