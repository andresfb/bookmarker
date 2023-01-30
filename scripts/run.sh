#!/bin/bash

tmux splitw -d ./vendor/bin/sail up

echo "Waiting for docker..."
for i in $(seq 10 -1 1);
do
  echo -ne "\r$i ";
  sleep 1;
done
echo -ne "";

tmux splitw -d ./vendor/bin/sail npm run dev
tmux splitw -d ./vendor/bin/sail artisan horizon
tmux select-layout tiled
./vendor/bin/sail artisan websockets:serve --host=127.0.0.1
