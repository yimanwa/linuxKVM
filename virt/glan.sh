#!/bin/bash
#Program:
#	This program handle all command from PHP above the pipe command file
#History:
#2014/9/13 
PATH=/usr/lib64/qt-3.3/bin:/usr/local/sbin:/usr/sbin:/sbin:/usr/local/bin:/usr/bin:/bin:/root/bin
export PATH
while [ 1==1  ]
do
if [ -e "command"  ]; then

	lock=$( cat lock )
	if [[ $lock == "0" ]]; then
		
		$( cat command )
		rm -rf command

	fi
fi
done
exit 0
