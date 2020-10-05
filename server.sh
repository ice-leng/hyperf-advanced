#!/bin/sh

#pidFile="runtime/hyperf.pid"
#
#if [ -f "$pidFile" ]; then
#  kill -15 `cat $pidFile`
#fi
#
#rm -rf runtime/container

php bin/hyperf.php gen:error-code

#php bin/hyperf.php start
