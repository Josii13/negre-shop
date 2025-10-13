# Projet E-commerce Frederic N'DA - Laravel

## Description
Site e-commerce complet pour la vente d'œuvres d'art, de design mobilier et de vêtements de la marque Frederic N'DA. Le projet inclut également une galerie/workshop (NÈGRE Workshop) avec activités et événements.

## Technologies Utilisées
- **Laravel 12.x** - Framework PHP
- **SQLite** - Base de données (par défaut)
- **Blade** - Moteur de templates
- **CSS personnalisé** - Styles
- **JavaScript Vanilla** - Interactivité

## Structure du Projet

### Base de Données

Le projet utilise 7 tables principales :

1. **categories** - Catégories de produits (Peinture, Design, Marque, Gallery)
2. **products** - Produits (peintures, meubles, vêtements)
3. **orders** - Commandes passées par les clients
4. **contacts** - Messages de contact
5. **carousel_slides** - Slides du carousel de la page d'accueil
6. **activities** - Activités du NÈGRE Workshop
7. **site_settings** - Paramètres du site (contact, etc.)

### Modèles (Models)
Tous les modèles sont dans `app/Models/` :
- `Category.php` - Gestion des catégories
- `Product.php` - Gestion des produits avec relations
- `Order.php` - Gestion des commandes
- `Contact.php` - Gestion des messages de contact
- `CarouselSlide.php` - Gestion du carousel
- `Activity.php` - Gestion des activités du workshop
- `SiteSetting.php` - Gestion des paramètres du site

### Controllers (Contrôleurs)
Tous les contrôleurs sont dans `app/Http/Controllers/` :
- `HomeController.php` - Page d'accueil
- `PeintureController.php` - Page peinture
- `DesignController.php` - Page design mobilier
- `MarqueController.php` - Page marque (avec WhatsApp)
- `GalleryController.php` - Page galerie/workshop
- `ContactController.php` - Page et formulaire de contact
- `OrderController.php` - Gestion des commandes

### Routes
Les routes sont définies dans `routes/web.php` :
- `/` - Page d'accueil
- `/peinture` - Catalogue peintures
- `/design` - Catalogue design mobilier
- `/marque` - Catalogue marque/vêtements
- `/gallery` - NÈGRE Workshop Gallery
- `/contact` - Formulaire de contact
- `POST /order` - Création de commande
- `POST /contact` - Envoi de message

### Vues (Blade Templates)
Templates dans `resources/views/` :
- `layouts/app.blade.php` - Layout principal avec navigation
- `home.blade.php` - Page d'accueil avec carousel
- `peinture.blade.php` - Catalogue peintures
- `design.blade.php` - Catalogue design
- `marques.blade.php` - Catalogue marque
- `gallery.blade.php` - Gallery avec onglets
- `contact.blade.php` - Formulaire de contact

### Form Requests (Validation)
Validations personnalisées dans `app/Http/Requests/` :
- `StoreOrderRequest.php` - Validation des commandes
- `StoreContactRequest.php` - Validation des messages de contact

## Installation et Configuration

### Prérequis
- PHP 8.2 ou supérieur
- Composer
- SQLite ou MySQL

### Étapes d'Installation

1. **Naviguer dans le dossier du projet**
   ```bash
   cd negre-shop-laravel
   ```

2. **Copier le fichier d'environnement**
   ```bash
   copy .env.example .env
   ```

3. **Installer les dépendances Composer**
   ```bash
   composer install
   ```

4. **Générer la clé d'application** (si pas déjà fait)
   ```bash
   php artisan key:generate
   ```

5. **Créer la base de données SQLite** (si pas déjà fait)
   ```bash
   type nul > database\database.sqlite
   ```

6. **Exécuter les migrations**
   ```bash
   php artisan migrate
   ```

7. **Exécuter les seeders (données de test)**
   ```bash
   php artisan db:seed
   ```

8. **Copier les images** (img1.jpg, img2.jpg, logo.jpg)
   Copiez les images depuis le dossier parent vers `public/images/`

9. **Lancer le serveur de développement**
   ```bash
   php artisan serve
   ```

10. **Accéder au site**
    Ouvrez votre navigateur et allez sur : `http://localhost:8000`

## Fonctionnalités

### Pour les Visiteurs
- ✅ Parcourir le catalogue de peintures avec détails (dimensions, technique, support)
- ✅ Parcourir le catalogue de design mobilier avec détails (matériaux, dimensions)
- ✅ Parcourir le catalogue de vêtements avec commande via WhatsApp
- ✅ Consulter les activités et événements du NÈGRE Workshop
- ✅ Passer des commandes via formulaire
- ✅ Envoyer des messages via formulaire de contact
- ✅ Navigation responsive (mobile-friendly)
- ✅ Carousel interactif sur la page d'accueil
- ✅ Modals pour voir les détails des produits

### Gestion Dynamique
- ✅ Toutes les données sont en base de données (aucune donnée statique)
- ✅ Carousel géré depuis la base de données
- ✅ Catégories gérées depuis la base de données
- ✅ Produits gérés depuis la base de données
- ✅ Activités gérées depuis la base de données
- ✅ Paramètres du site gérés depuis la base de données
- ✅ Commandes sauvegardées avec statut
- ✅ Messages de contact sauvegardés

## Données de Test (Seeders)

Les seeders créent automatiquement :
- 4 catégories (Peinture, Design, Marque, Gallery)
- 7 produits (3 peintures, 2 designs, 2 vêtements)
- 3 slides de carousel
- 5 activités pour le workshop
- Paramètres de contact
- 1 utilisateur admin (admin@example.com)

## Commandes Utiles

### Réinitialiser la base de données
```bash
php artisan migrate:fresh --seed
```

### Créer une nouvelle migration
```bash
php artisan make:migration nom_de_la_migration
```

### Créer un nouveau modèle
```bash
php artisan make:model NomDuModele
```

### Créer un nouveau controller
```bash
php artisan make:controller NomController
```

### Créer un nouveau seeder
```bash
php artisan make:seeder NomSeeder
```

### Vider le cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Structure des Assets

```
public/
├── css/
│   └── style.css          # Styles personnalisés
├── js/
│   └── script.js          # JavaScript
└── images/
    ├── img1.jpg          # Images des produits
    ├── img2.jpg
    └── logo.jpg
```

## Configuration WhatsApp

Le numéro WhatsApp est défini dans :
- Les seeders : `SiteSettingSeeder.php`
- Utilisé dans : `marques.blade.php` et `gallery.blade.php`

Pour changer le numéro, modifiez la valeur dans la base de données (table `site_settings`, clé `whatsapp_number`).

## Sécurité

- ✅ Protection CSRF sur tous les formulaires
- ✅ Validation des données avec Form Requests
- ✅ Échappement automatique des données avec Blade
- ✅ Relations Eloquent sécurisées

## Prochaines Étapes (Suggestions)

1. **Administration** : Créer un panneau d'administration pour gérer :
   - Les produits
   - Les catégories
   - Les commandes
   - Les messages de contact
   - Le carousel
   - Les activités

2. **Améliorations** :
   - Upload d'images pour les produits
   - Gestion des stocks
   - Système de paiement en ligne
   - Envoi d'emails de confirmation
   - Authentification utilisateur
   - Système de recherche
   - Filtres et tri des produits

3. **Performance** :
   - Mise en cache des requêtes
   - Optimisation des images
   - Pagination des produits

## Support

Pour toute question ou problème :
- Email : fredericnda.ci@gmail.com
- Téléphone : +225 07 68 29 89 65

---

**Développé pour Frederic N'DA - Artiste Peintre & Designer**

