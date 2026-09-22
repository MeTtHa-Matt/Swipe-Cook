# Swipe&Cook

PWA mobile-first de découverte de recettes par swipe, avec mode cuisine pas à pas et gestion du contenu du frigo.

## Lancer le projet

Depuis la racine :

```bash
php -S localhost:8080
```

Puis ouvrir `http://localhost:8080`.

## Fonctionnalités incluses

- Cartes de recettes avec gestes tactiles et souris, boutons de secours et filtres.
- Catalogue local de recettes éditoriales en français, disponible hors connexion.
- Mode cuisine avec portions, ingrédients recalculés et étapes.
- Frigo persistant en `localStorage`, recherche et suggestions aléatoires.
- Scanner préparé avec `Html5-Qrcode` et recherche produit Open Food Facts.
- Manifest et service worker pour l'installation PWA.

`data/recipes.json` contient le catalogue local éditorial. Les recettes et leurs étapes sont disponibles sans appel de service de recettes distant. La caméra doit être servie en HTTPS (ou localhost).

La recherche du frigo est alimentée par `data/ingredients.json`, organisé par familles : frais, fruits, viandes et poissons, produits laitiers, bocaux et conserves, épicerie, sauces, épices et surgelés. Il suffit d'ajouter un ingrédient dans la catégorie souhaitée pour le rendre disponible dans la recherche.

