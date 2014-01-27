if [ -z "$1" ];then
echo "Usage: $0 <interface>"
exit
fi
clear

int=$1
COUNT=0
start=`date +%s`
rx1=`cat /sys/class/net/$int/statistics/rx_bytes`
tx1=`cat /sys/class/net/$int/statistics/tx_bytes`
while [ 1 ]; do
rx3=`cat /sys/class/net/$int/statistics/rx_bytes`
tx3=`cat /sys/class/net/$int/statistics/tx_bytes`
sleep 1
#read
stop=`date +%s`
rx2=`cat /sys/class/net/$int/statistics/rx_bytes`
tx2=`cat /sys/class/net/$int/statistics/tx_bytes`

let COUNT=COUNT+1 

let "downl1 = (rx2-rx1)/1000"
let "upl1 = (tx2-tx1)/1000"
let "downl = (rx2-rx3)/1000"
let "upl = (tx2-tx3)/1000"
let "rxspeed = downl/1"
let "txspeed = upl/1"

tput cup 0 0
echo "                                 "
echo "                                 "
echo "                                 "
echo "                                 "
echo "                                 "
tput cup 0 0
echo "Прием    = $rxspeed"
echo "Перадача = $txspeed"
echo "за $COUNT секунд:"
echo "Скачано : $downl1 K"
echo "Отдано  : $upl1 K"

done
let "secs = stop-start"
let "downl = (rx2-rx1)/1000"
let "upl = (tx2-tx1)/1000"
let "rxspeed = downl/$secs"
let "txspeed = upl/$secs"


echo "Прием    = $rxspeed"
echo "Перадача = $txspeed"
echo "за $secs секунд:"
echo "Скачано : $downl K"
echo "Отдано  : $upl K"
