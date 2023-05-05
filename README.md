# TP2 PHP-crud-music  

## Pinon Mathias 
----------
<br>

## Pour commencer le TP2 j'ai créer un répertoire dans mes fichiers du nom de "php-crud-music" , puis ensuite éditer un fichier readme et un .gitignore. Suite à celà j'ai fais en sorte de connecter le répertoire à un git sur gitlab .

## Suite à celà j'ai instalé et configuré du fichier "Composer" afin de proceder au bon fonctionnement du tp  

## Dans l'exercice 3 on a creer un nouveau répertoire "public" avec un nouveau fichier php avec un code à l'intérieur de ce dernier . Suite à cella j'ai executer la commande 
```
php -d display_errors -S localhost:8000 -t public/
```
## et suite à cette comande nous avec été sur l'URL : 
http://localhost/8000/

## Instalation du ficher ".php-cs-fixer"
> Lancez une première vérification manuelle avec la commande :
```
php vendor/bin/php-cs-fixer fix --dry-run
```
<br>

> Lancez une nouvelle vérification manuelle avec la commande
```
php vendor/bin/php-cs-fixer fix --dry-run --diff
```
<br>

> Lancez une dernière vérification manuelle avec la commande :

```
php vendor/bin/php-cs-fixer fix
```

## On a creer des scripts dans le fichier composer.json pour faciliter l'utilisation de PHP CS Fixer