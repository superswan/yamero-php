# Yamero
### Pomf/Uguu clone that uses PGP encyrption for file uploads and pastes.

This project was started as an exercise in Web Dev and to learn PHP. 

## Setup
To setup the development environment you will need ```docker``` and ```docker-compose```, example configuration files are provided to assist with the setup.

## PHP-GnuPG
This extension is used on the backend for any PGP/GPG requirements. It can be sort of a pain to setup as it expects the ```www-data``` user to control the keychain. Scripts have been provided but you will need to run these commands as ```root``` user in order to setup the keychain.

```
sudo mkdir -p /home/www-data/.gnupg
sudo chown -R www-data:www-data /home/www-data/.gnupg
sudo chmod -R 700 /home/www-data/.gnupg
```

Additionally you should set the environment variable ```GNUPGHOME``` to wherever you
would like to store the keychain and run ```gpg``` commands as the webserver user with the ```--homedir``` parameter set. 

```
export GNUPGHOMEDIR=/var/www/.gnupg
sudo -u www-data gpg --full-gen-key --pinentry=loopback --homedir=$GNUPGHOMEDIR
```