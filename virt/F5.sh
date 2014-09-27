#!/bin/bash
#Program:
#	This program renew the status file ever 1 second
#History:
#2014/9/22 
PATH=/usr/lib64/qt-3.3/bin:/usr/local/sbin:/usr/sbin:/sbin:/usr/local/bin:/usr/bin:/bin:/root/bin

while [ 1==1  ]
do

virsh list --all |tr -d '-' | tr -s ' \n' >status

sleep 1

done