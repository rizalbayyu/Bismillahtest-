#!/bin/bash
cat << _EOF_
Rizal Bayu Aji Pradana

_EOF_

if [ $EUID -ne 0 ]; then
    echo "This script must be run as root. Please Login as root"
    exit 1
else

echo "=========================================================================="
echo "===============================Preparing=================================="
echo "=========================================================================="

add-apt-repository ppa:ondrej/php
apt -y update
apt -y install expect unzip vim nginx apt install dnsmasq dnsutils ldnsutils

# Allow access to port 80 & 53
sudo ufw allow 80
sudo ufw allow 53
systemctl start nginx
systemctl enable nginx

# Install PHP
apt -y install php8.0 php8.0-fpm php8.0-mysql

# Install mysql server
apt install -y mysql-server

echo "=========================================================================="
echo "===========================MySQL Secure Installation=============================="
echo "=========================================================================="

# Install Secure Mysql
# Menggunakan spawn, send, expect agar program berjalan secara otomatis
# Spawn=Memanggil atau memulai Script atau Program
# expect=Menunggu output dari program
# send=Memberi balasan untuk program
SECURE_MYSQL=$(expect -c "
spawn mysql_secure_installation
expect \"Press y|Y for Yes, any other key for No:\"
send \"n\r\"
expect \"New password:\"
send \"akuganteng\r\"
expect \"Re-enter new password:\"
send \"akuganteng\r\"
expect \"Remove anonymous users? (Press y|Y for Yes, any other key for No) :\"
send \"y\r\"
expect \"Disallow root login remotely? (Press y|Y for Yes, any other key for No) :\"
send \"y\r\"
expect \"Remove test database and access to it? (Press y|Y for Yes, any other key for No) :\"
send \"y\r\"
expect \"Reload privilege tables now? (Press y|Y for Yes, any other key for No) :\"
send \"y\r\"
expect eof");
echo "$SECURE_MYSQL"
systemctl enable mysql

echo "=========================================================================="
echo "===========================Database=============================="
echo "=========================================================================="
sleep 2s

#Create Database
mysql -u root -pakuganteng < ./setupdb.sql
echo "===============================Done!!!===================================="

echo "=========================================================================="
echo "===========================Install Wordpress=============================="
echo "=========================================================================="
# Preparing Installation WordPress
mkdir -p /var/www/html/wordpress.demo.net/
wget http://wordpress.org/latest.tar.gz -P /opt/
# extract Archieve from /opt/wordpress directory to this directory
tar -xvzf /opt/latest.tar.gz

# Move wordpress to /var/www/html/wordpress
mv wordpress/* /var/www/html/wordpress.demo.net/

# rsync beberapa file konfigurasi yang telah disesuaikan
rsync -a wp-config.php /var/www/html/wordpress.demo.net/
rsync -a wordpress.conf /etc/nginx/sites-available/
rsync -a nginx.conf /etc/nginx/nginx.conf
rsync -a www.conf /etc/php/8.0/fpm/pool.d/www.conf

#Change Owner
chown -R rizal:rizal /var/www/html
#change access permissions
chmod -R 755 /var/www/
chmod -R 755 /etc/nginx/sites-available/
chmod -R 755 /etc/nginx/sites-enabled/

sudo ln -s /etc/nginx/sites-available/wordpress.conf /etc/nginx/sites-enabled/

#hapus file yang tidak dipakai
rm /etc/nginx/sites-enabled/default

# nginx -t
systemctl restart nginx

echo "=========================================================================="
echo "===========================Setting Domain=============================="
echo "=========================================================================="

# Setting domain menggunakan tools dnsmasq
systemctl disable --now systemd-resolved
rm -rf /etc/resolv.conf

rsync -a resolv.conf /etc/resolv.conf
rsync -a hosts /etc/hosts
rsync -a dnsmasq.conf /etc/dnsmasq.conf

dnsmasq --test
systemctl restart dnsmasq
fi
