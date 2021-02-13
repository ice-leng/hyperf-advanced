#!/bin/sh

#pidFile="runtime/hyperf.pid"
#
#if [ -f "$pidFile" ]; then
#  kill -15 `cat $pidFile`
#fi
#
#rm -rf runtime/container

php -d swoole.use_shortname=Off bin/hyperf.php gen:error-code

# php -d swoole.use_shortname=Off -e bin/hyperf.php start
