## Messagerie

### Installation
Installer Laravel en Homestead. Créer un fichier code dans le dossier Homestead. Télécharger le code et le placer dans Homestead/code/

- Modifier le fichier C:\Windows\System32\drivers\etc\hosts

````
#
127.0.0.1 localhost
::1 localhost
# Added by Docker Desktop
# 10.111.16.211 host.docker.internal
# 10.111.16.211 gateway.docker.internal
# To allow the same kube context to work on the host and the container:
127.0.0.1 kubernetes.docker.internal
# End of section
192.168.56.56 messagerie.test

````
- Modifier le fichier Homestead.yaml  dans C:\Users\(user)\Homestead\

````
---
ip: "192.168.56.56"
memory: 12288
cpus: 4
provider: virtualbox

authorize: .ssh/id_rsa.pub

keys:
    - .ssh/id_rsa

folders:
    - map: code
      to: /home/vagrant/code

sites:
    - map: messagerie.test
      to: /home/vagrant/code/messagerie/public

databases:
    - messagerie
    - messagerie_test


features:
    - mysql: true
    - mariadb: false
    - postgresql: false
    - ohmyzsh: false
    - webdriver: false

services:
    - enabled:
          - "mysql"
#    - disabled:
#        - "postgresql@11-main"

#ports:
#    - send: 33060 # MySQL/MariaDB
#      to: 3306
#    - send: 4040
#      to: 4040
#    - send: 54320 # PostgreSQL
#      to: 5432
#    - send: 8025 # Mailhog
#      to: 8025
#    - send: 9600
#      to: 9600
#    - send: 27017
#      to: 27017
````
- Modifier le fichier .env dans C:\Users\marin\Homestead\code\messagerie
````
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=messagerie
DB_USERNAME=homestead
DB_PASSWORD=secret
````

- Lier le code à la base de donnée sur workbench
- ouvrir le cmd :
 ``cd/Homestead`` ->
 ``vagrant reload --provision `` ->
  ``vagrant ssh`` ->
  ``cd code/messagerie`` ->
  ``artisan migrate``
  (le compte Admin sera directement créer à partir de UserFactory qui sera importer par la migration create_user_table)

### Lancer le formulaire
Ouvir un navigateur et taper dans la barre de recherche : ``messagerie.test/``

### Si problème
après avoir taper le lien si marche pas ouvrer un cmd taper : 
 `` cd homestead/code/messagerie`` avant de faire vagrant ssh puis -> ``npm run dev``

### Ajouter l'admin manuellement s'il y a un problème
L'ajouter à partir du register puis modifier dans la table users "is_admin" pour le passer à 1 puis Apply.




