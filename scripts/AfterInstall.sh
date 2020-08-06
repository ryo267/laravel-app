sudo echo /var/app/current/config/php.conf > /etc/nginx/conf.d/elasticbeanstalk/php.conf 
sudo echo /var/app/current/config/database.aws > /var/app/current/config/database.php 
sudo nginx -s reload 
sudo cp /var/app/current/.env.dep .env 
sudo /var/app/current/php artisan key:generate
