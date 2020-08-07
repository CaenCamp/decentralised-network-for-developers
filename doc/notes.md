# Notes prises en main API PLatform

## Pourquoi API plateform

Experience du jobboard en js : mise en place d'openAPI, volonté de coller aux standards schema, opendata ... Très long à mettre en place from scratch avec toutes les bonnes pratiques.
API Platform à tout ça "nativement" : 

* OpenAPI
* json et JSON-LD
* génération du modèle depuis schema.org
* un ORM (bon ça ce discutte ! mais ca va vite)
* du graphQL pour offrir une bon pannel
* Mercure (pour quoi faire ! pas tester)
* Vulcain (pas encore tester non plus)
* Et à priori un bon environnement de dev (tests, génération de fixtures, ...)

Mais pour résumer, un framework exploitant à bloque les standard web, avec des brique de "linked data" fondatrices d'une démarche de décentralisation. So, let's go !

## Le Hello world
Quelques problèmes (sur le graphql avec nécessité d'intervenir sur un bundle, des tests capricieux, pas de linter de facto comme le serait Eslint, quel standard appliqué, ... mais bon, y'a un bout que je fais plus de Php :( ).
Mais globallement très convaincant !

## Création des modèles des CaenCamp

### Mise en place d'un premier schema depuis schema.org.
Ok, bonnant malan, en virant certaines props experimentales que l'outils de génération n'arrivait pas à gérer.
Problème avec les uuid (le fonction n'est pas disponible dans la db fournie dans le docker-compose) du coup je suis repassé aux id incrémentaux pour le moment.
Le modèle est franchement explosé en plein d'objets.

Next steps : 

* régler le problème des uuid
* simplifier le modèle pour avoir moins d'objets à gérer
* Faire mieux coller le modèle au données existantes de CaenCamp
* Reprendre les interface auto-générer de react-admin
* bosser les validations (tester par exemple la génératoin des json-schema des objets !)
* faire un script pour importer les données existantes
* faire un générateur de fixtures avec le bundle truc truc.

Et puis pour le "lancement du projet"

* Makefile
* Linter et githook
* Readme
* Open-sourcing
* tests
* intégration continue

## Problème de l'uuid

1) Ajout d'un sql.init dans le repertoire docker et montage du script dans le docker-compose
2) Ajout de la conf des uuid dans le schema.yaml

It's working \o/
