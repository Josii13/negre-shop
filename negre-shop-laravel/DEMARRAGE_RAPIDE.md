# 🚀 Guide de Démarrage Rapide

## Installation en 5 Minutes

### 1. Configuration Initiale
```bash
cd negre-shop-laravel
composer install
copy .env.example .env
php artisan key:generate
```

### 2. Base de Données
```bash
# Créer la base de données SQLite (si elle n'existe pas)
type nul > database\database.sqlite

# Exécuter les migrations et seeders
php artisan migrate:fresh --seed
```

### 3. Images
Copiez les images depuis le dossier parent :
```bash
copy ..\img1.jpg public\images\img1.jpg
copy ..\img2.jpg public\images\img2.jpg
copy ..\logo.jpg public\images\logo.jpg
```

### 4. Lancer le Serveur
```bash
php artisan serve
```

### 5. Accéder au Site
Ouvrez votre navigateur : **http://localhost:8000**

## ✅ Vérifications Post-Installation

- [ ] La page d'accueil affiche le carousel
- [ ] Les catégories (Peinture, Design, Marque, Gallery) sont visibles
- [ ] Les produits s'affichent dans chaque catégorie
- [ ] Le formulaire de contact fonctionne
- [ ] Les commandes peuvent être passées

## 📊 Compte Admin par Défaut

- **Email** : admin@example.com
- **Password** : password

## 🛠️ Commandes Utiles

### Réinitialiser complètement
```bash
php artisan migrate:fresh --seed
```

### Vider les caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Voir toutes les routes
```bash
php artisan route:list
```

## 📦 Structure des URLs

| URL | Page | Description |
|-----|------|-------------|
| `/` | Accueil | Page d'accueil avec carousel |
| `/peinture` | Peinture | Catalogue des peintures |
| `/design` | Design | Catalogue du mobilier |
| `/marque` | Marque | Catalogue vêtements |
| `/gallery` | Gallery | NÈGRE Workshop |
| `/contact` | Contact | Formulaire de contact |

## 🎨 Modifier les Données

### Via les Seeders
Modifiez les fichiers dans `database/seeders/` puis :
```bash
php artisan db:seed --class=NomDuSeeder
```

### Directement en Base de Données
Vous pouvez utiliser un client SQLite comme :
- DB Browser for SQLite
- phpLiteAdmin
- DBeaver

Fichier de base de données : `database/database.sqlite`

## 🔧 Configuration WhatsApp

Changez le numéro dans la table `site_settings` :
```sql
UPDATE site_settings 
SET value = 'VOTRE_NUMERO' 
WHERE key = 'whatsapp_number';
```

## 📝 Ajouter un Produit Manuellement

```php
use App\Models\Product;
use App\Models\Category;

$category = Category::where('slug', 'peinture')->first();

Product::create([
    'category_id' => $category->id,
    'name' => 'Nom du produit',
    'slug' => 'nom-du-produit',
    'description' => 'Description...',
    'price' => 500000,
    'image' => 'img1.jpg',
    'dimensions' => '100 x 80 cm',
    'technique' => 'Acrylique',
    'support' => 'Toile',
    'year' => '2024',
    'is_available' => true,
    'order' => 1,
]);
```

## 🐛 Résolution des Problèmes

### Erreur : "Class not found"
```bash
composer dump-autoload
```

### Erreur : "Route not found"
```bash
php artisan route:clear
php artisan cache:clear
```

### Erreur : "View not found"
```bash
php artisan view:clear
```

### Base de données verrouillée
```bash
# Arrêter le serveur et réessayer
# Ou supprimer database.sqlite et recréer
```

## 📱 Test Responsive

Testez le site sur :
- Desktop (1920x1080)
- Tablet (768x1024)
- Mobile (375x667)

## 🎯 Prochaines Étapes

1. Ajoutez vos vraies images dans `public/images/`
2. Modifiez les données dans les seeders
3. Personnalisez les couleurs dans `style.css`
4. Ajoutez plus de produits via les seeders
5. Configurez l'email pour les notifications

## 💡 Astuces

- Utilisez `php artisan tinker` pour tester les modèles
- Les logs sont dans `storage/logs/laravel.log`
- Mode debug : `APP_DEBUG=true` dans `.env`

---

**Besoin d'aide ?** Consultez le README_PROJET.md pour plus de détails.

