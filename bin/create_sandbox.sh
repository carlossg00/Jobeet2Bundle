#!/bin/sh

DIR=`php -r "echo realpath(dirname(\\$_SERVER['argv'][0]));"`
VERSION=2_0_PR6
rm -rf /tmp/sandbox
mkdir /tmp/sandbox
cp -r app /tmp/sandbox/
cp -r src /tmp/sandbox/
cp -r vendor /tmp/sandbox/
cp -r web /tmp/sandbox/
cp -r README /tmp/sandbox/
cp -r LICENSE /tmp/sandbox/
cd /tmp/sandbox
sudo rm -rf app/cache/* app/logs/* .git*
chmod 777 app/cache app/logs
cd ..
# avoid the creation of ._* files
export COPY_EXTENDED_ATTRIBUTES_DISABLE=true
export COPYFILE_DISABLE=true
tar zcpf $DIR/build/sandbox_$VERSION.tgz sandbox
sudo rm -f $DIR/build/sandbox_$VERSION.zip
zip -rq $DIR/build/sandbox_$VERSION.zip sandbox
