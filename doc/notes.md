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

## Amélioration du modèle

Pour le moment, en schema.json bête et méchant :

* CreativeWork
* Event
* MediaObject
* Organization
* Person
* Place
* PostalAddress

Pour coller aux données existantes et au "métier" des CCC, on pourrait plutôt avoir :

### Un event / un évènement

Donc un event pourrait avoir un 
* type (talk, lightning, coding ...)
* un ou plusieurs speakers de type Person
* un lieu / Place
* un organisateur (CaenCamp / Devops CaenCamp / Coding CaenCamp)

Mais en vrai, on devrait avoir une distinction entre l'évènement et les sessions qu'il contient. Par exemple pour une édition des CaenCamp, on doit pouvoir avoir un Talk et un lightning ! => Fouiller les sur/sous évènements de schema.org !

On doit aussi pouvoir associer une ou plusieurs photos et une ou plusieurs vidéos à un event. En fait, plusieur CreativeWork qui pourraient-être de plusieurs types (audio - vidéos - photos - slides ...)

### Une organization / Boite

Une personne peut travailler pour une boite
Une boite peut être sponsor
Une boite peut prêter un lieu (Place)

### Une personne

Une personne peut travailler dans une boite
Une personne peut faire un event (sous-event)

### Des médias

CreativeWork associés à des events

### Un lieu

Un lieu correspond à un lieux physique et donc à une adresse postale.
Un lieu peut accueillir un évènement en tant que tel, mais un lieu peut aussi être associer à une boite.

## Stop, on arrête, et c'est pas grave !

Bon premier conseil, ne pas essayer de tout faire dès le début ! Allons-y entité par ententé... 
Donc je me concentre dans un premier temps sur les personnes et les organization, les boites ...

Voila le schema tiré de schema.org

```yaml
id:
  generationStrategy: uuid
validator:
  assertType: true
types:
  PostalAddress:
    properties:
      addressCountry: { range: "Text" }
      addressLocality: ~
      postalCode: ~
      streetAddress: ~
  Place:
    properties:
      address: { range: "PostalAddress" }
      hasMap: { range: "URL" }
      latitude: { range: "Number" }
      longitude: { range: "Number" }
      maximumAttendeeCapacity: ~
  Organization:
    properties:
      name: ~
      description: ~
      disambiguatingDescription: ~
      image: ~
      url: ~
      location: { range: "Place" }
      email: ~
      employees:
        cardinality: "(0..*)"
        range: "Person"
  Person:
    properties:
      additionalName: ~
      familyName: ~
      givenName: ~
      honorificPrefix: ~
      description: ~
      disambiguatingDescription: ~
      image: ~
      url: ~
      memberOf: { range: "Organization" }

```

Deux remarques : 
* l'uuid avec le tips de db.init
* la relation `employees` avec un cardinality de (0..*) pour définir un array d'employées de type Person

Voyons le résultat :

Une doc complète (c'est chouette), mais avec des objets dont on ne veut pas de routes d'API : PostalAddress et Place 

![Premiere version de swagger](swaggerV1.png)

Autre problème : La relation entre une adresse, une place et un organisations se fait via des url (logique, mais chiant).
Du coup, 3 call pour une organization complète.
Et côté RA, besoins de creer une adresse puis un lieux puis un organisation, et difficile de les lier entre eux via des url pointant vers la ressource qui ne sont pas très lisible.

![Première version RA](raV1.png)

Ceci dit la relation entre les objet se fait quand même très bien. 
! Par contre la relation employees d'une organisation ne passe pas par la même table/relation que celle lien une personne à une organization !
** Il faudra trouver une solution pour ça ! **

Non, ce que je veux, c'est juste de la doc pour le CRUD des personnes et des organizations Lorsque l'on créer un organisation, on doit créer en même temps l'adresse postale et le lieux. Mais il faut que cela reste de la donnée liée sur le json-ld ! 

Comment faire ça ? 

Premiere approche en séparant les objet open-api et les objets métier gérant la persistance ... Design first et non plus code first... Et la tout de suite un peu galère car on entre dans des problématique symfonique et doctriniènne ... pas vraiment envie. Et en plus cela ne semble pas vraiment la solution. En suivant la lecture de la doc, il semble qu'il faille mieux passer par les serializer et les groupe (et oui \o/ ^^ - c'est le vie).

Donc effectivement, il faut passer par les groupes des sérialiseurs : https://api-platform.com/docs/core/serialization/#embedding-relations

```json
{
  "@context": "/contexts/Organization",
  "@id": "/organizations/0898f0e9-a8ec-4735-9d94-8af67d834d2e",
  "@type": "http://schema.org/Organization",
  "name": "Marmelab",
  "description": "Boite boite",
  "disambiguatingDescription": "vous êtes blond",
  "url": "https://www.marmelab.com",
  "location": {
    "@id": "/places/8e8d2035-0aae-422f-a15b-cb94d5daffd1",
    "@type": "http://schema.org/Place",
    "address": {
      "@id": "/postal_addresses/d0e95384-cb13-450e-8472-1f2d61f48336",
      "@type": "http://schema.org/PostalAddress",
      "addressCountry": "FR",
      "addressLocality": "Caen",
      "postalCode": "14000",
      "streetAddress": "8bis des rosiers"
    },
    "maximumAttendeeCapacity": 5
  },
  "email": "contact@marmelab.com",
  "employees": [
    "/people/fc3c821f-f2e5-4186-9255-cdf80be68e0b",
    "/people/d709a9b6-16fc-4acb-95a5-26f546115fe7"
  ]
}
```

On a donc toutes les info dans une seule requêtes. Reste :
* A virer les adresses postales et les places de la doc swagger
* permettre de créer le lieux et l'adresse postale en création d'organization (rq: en l'état, ra ne marche plus sur les place/adresse d'une organization).

### Virer le doc
Mettre une seule route sur place et adress, et puis l'exlure de la doc
https://api-platform.com/docs/core/operations/#expose-a-model-without-any-routes

### RA organization: créer/editer/supprimer la location

Tout d'abord, il faut débrailler RA ! 

Ensuite, si cela fonctionne bien pour tout ce qui est view (list et show), cela ne suffit pas pour le POST/PUT/PATCH ! On a des erreur du type 

```
api platform Nested documents are not allowed. Use IRIs instead.
```

Pour éviter cela, on doit repasser par les context de serialisation/de-serialisation, en ajoutant un 
```
denormalizationContext={"groups"={"organization"}}
```
aux entités Organisation et Place (note: on met le même groupe que pour les GET, puisqu'on veut du CRUD identique dans les deux cas !)

Après, il suffit de dérouler de le view CREATE et EDIT de RA en descendant dans les json (exemple location.adress.postalCode)


Donc c'est chouette, on a une Doc d'API comme on veut, et une interface d'admin adhoc.

Dans les ptit truc à faire :
* [DONE] inversion relation people/organization
* [DONE ]utiliser un slug comme identifier
* [DONE]travailler la validation
* [DONE mais exploitation FAIL] générer les json-schema pour validation front
* [DONE] Ajouter des filtres et du tri !!!!
* [DONE] afficher un name pour people baser sur les 3 autres (test unit)
* authentification JWT

Ensuite : 
* Linter
* Tests
* CI
* Déploiement
* afficher la data formatée avec du microdata
* graphQL
* Vulcain
* Mercure

Et un jour :
* RA de base
* composant RA pour une Place/Address
* composant RA pour un CreativeWork

### 11/08 Reprise du modele de la liason boite/person

!!! ATTENTION : Lorsque l'on regenere les entitée depuis le schema, on efface les tweek qu'on a ajouter :( Beurk

Donc voir la doc Doctrine pour les relation manyToMany !

### Slug comme identifiant

Encore une fois, de la conf
https://github.com/Atlantic18/DoctrineExtensions
https://symfony.com/doc/master/bundles/StofDoctrineExtensionsBundle/index.html
https://api-platform.com/docs/core/identifiers/#changing-identifier-in-a-doctrine-entity

### Validation

Par configuration côté API encore ! Mais efficace
Export du schema json valide et prometeuses, par contre, je n'ai pas sû et pas passer le temps pour l'exploiter côté front avec ajv.
https://www.npmjs.com/package/ajv
A tester plus tard ! entre autre avec
https://github.com/hyperjump-io/json-schema-validator

### Filtres et Trie

Objectif sur une organisation :

Filtre par :
* nom
* code postal
* geolocalisé

Tri par :
* nom
* code postal
* nombre de developpeur ?

Donc dans un premier temps, pour une un filtre sur la props d'un objet, magie de la programmation par configuration : 

```
 * @ApiFilter(
 *   SearchFilter::class,
 *   properties={"name": "partial"}
 * )
```

Permet de : 

* Créer le service (oui, le filtre est un service symfony) doctrine sans rien d'avoir d'autre à faire
* la documentation du filtres dans OpenAPI (et graphQl si installer)
* ajoute le lien du filtre (hydra-search) dans le Json-LD
* et du coup, génération automatique du filtre dans RA

Un gain de temps de furieux !!!!!

MAIS, on est sur un props de l'objet, on impose le type de filtre (%LIKE, LIKE%, %LIKE%) au niveau de l'API (logique à cause de hydra ?)

Ok, donc cela marche avec les objet imbriqué ! (du genre le code postal d'une orga) Classe ! Mais il semble que dans ce cas, la génération
du filtre ne marche pas côté RA. Pas grave, ca s'implemente facilement.

Le sort est aussi un filtre
On peut definir l'ordre par defaut : 
```
@ApiResource(attributes={"order"={"foo": "ASC"}})
```


Plein de moyen de spécifier ses filtres (avec du vrai code \o/)

Bin, c'est quand même plutôt classe !

J'ai donc pas tester les filtres de tri custom qui serait le nombre de développeurs

> Note: on a une pagination par default, j'y avais même pas prêter attention. Mais c'est aussi un gros gain de temps !!!!


