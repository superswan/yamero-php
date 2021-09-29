sudo -u gpg --export $1 > $1-pub.pub
sudo -u gpg --export-secret-keys $1 > $1-sec.asc