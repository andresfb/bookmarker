#!/bin/sh

SOURCE_PATH=../
EXCLUDE_FILE=exclude.txt
DESTINATION_PATH=/data1/bookmarker

echo "Syncing code..."
rsync -ravuh --delete --progress --exclude-from $EXCLUDE_FILE $SOURCE_PATH $DESTINATION_PATH
