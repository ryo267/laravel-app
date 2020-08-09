sudo cat /var/app/current/config/php.conf > /etc/nginx/conf.d/elasticbeanstalk/php.conf
sudo cat /var/app/current/config/database.aws > /var/app/current/config/database.php
sudo nginx -s reload
sudo aws ssm get-parameters --region ap-northeast-1 --name laravel-myapp-env --with-decryption | jq -r .Parameters[].Value > .env
sudo cd /var/app/current/ | php artisan key:generate