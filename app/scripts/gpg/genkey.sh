export GNUPGHOMEDIR=/var/www/.gnupg
sudo -u www-data gpg --full-gen-key --pinentry=loopback --homedir=$GNUPGHOMEDIR