# 📊 Structure de la Base de Données - Frederic N'DA E-commerce

## Vue d'Ensemble

Le projet utilise **7 tables principales** pour gérer toutes les fonctionnalités du site e-commerce.

### Schéma Relationnel Global

```
┌─────────────────────┐
│   categories        │
│─────────────────────│
│ id (PK)            │
│ name               │
│ slug               │
│ description        │
│ banner_title       │
│ banner_description │
│ image              │
│ order              │
│ is_active          │
│ created_at         │
│ updated_at         │
└─────────────────────┘
           │
           │ 1:N
           ▼
┌─────────────────────┐
│   products          │
│─────────────────────│
│ id (PK)            │
│ category_id (FK)   │◄────────┐
│ name               │         │
│ slug               │         │
│ description        │         │
│ price              │         │
│ image              │         │
│ dimensions         │         │
│ technique          │         │
│ support            │         │
│ materials          │         │
│ style              │         │
│ collection         │         │
│ sizes              │         │
│ year               │         │
│ is_available       │         │
│ is_featured        │         │
│ order              │         │
│ created_at         │         │
│ updated_at         │         │
└─────────────────────┘         │
           │                    │
           │ 1:N                │
           ▼                    │
┌─────────────────────┐         │
│   orders            │         │
│─────────────────────│         │
│ id (PK)            │         │
│ product_id (FK)    │─────────┘
│ customer_name      │
│ customer_email     │
│ customer_phone     │
│ message            │
│ product_name       │ (sauvegarde au cas où le produit est supprimé)
│ product_price      │
│ status             │
│ admin_notes        │
│ created_at         │
│ updated_at         │
└─────────────────────┘


┌─────────────────────┐
│ carousel_slides     │
│─────────────────────│
│ id (PK)            │
│ title              │
│ description        │
│ image              │
│ link               │
│ order              │
│ is_active          │
│ created_at         │
│ updated_at         │
└─────────────────────┘


┌─────────────────────┐
│   activities        │
│─────────────────────│
│ id (PK)            │
│ title              │
│ description        │
│ image              │
│ price              │
│ type               │
│ frequency          │
│ capacity           │
│ audience           │
│ tab                │
│ is_active          │
│ order              │
│ created_at         │
│ updated_at         │
└─────────────────────┘


┌─────────────────────┐
│   contacts          │
│─────────────────────│
│ id (PK)            │
│ name               │
│ email              │
│ phone              │
│ message            │
│ is_read            │
│ admin_response     │
│ created_at         │
│ updated_at         │
└─────────────────────┘


┌─────────────────────┐
│  site_settings      │
│─────────────────────│
│ id (PK)            │
│ key (UNIQUE)       │
│ value              │
│ type               │
│ group              │
│ created_at         │
│ updated_at         │
└─────────────────────┘
```

---

## 📋 Détail des Tables

### 1. Table `categories` (Catégories de produits)

**Description :** Gère les différentes catégories du site (Peinture, Design, Marque, Gallery).

| Colonne | Type | Contraintes | Description |
|---------|------|-------------|-------------|
| `id` | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Identifiant unique |
| `name` | VARCHAR(255) | NOT NULL | Nom de la catégorie |
| `slug` | VARCHAR(255) | NOT NULL, UNIQUE | URL-friendly identifier |
| `description` | TEXT | NULLABLE | Description courte |
| `banner_title` | VARCHAR(255) | NULLABLE | Titre de la bannière |
| `banner_description` | TEXT | NULLABLE | Description de la bannière |
| `image` | VARCHAR(255) | NULLABLE | Nom du fichier image |
| `order` | INT | DEFAULT 0 | Ordre d'affichage |
| `is_active` | BOOLEAN | DEFAULT TRUE | Catégorie active/inactive |
| `created_at` | TIMESTAMP | | Date de création |
| `updated_at` | TIMESTAMP | | Date de modification |

**Relations :**
- **1:N avec `products`** - Une catégorie peut avoir plusieurs produits

**Exemple de données :**
```sql
id: 1, name: "Peinture", slug: "peinture", is_active: true
id: 2, name: "Design", slug: "design", is_active: true
id: 3, name: "Marque", slug: "marque", is_active: true
```

---

### 2. Table `products` (Produits)

**Description :** Stocke tous les produits du site (peintures, meubles, vêtements).

| Colonne | Type | Contraintes | Description |
|---------|------|-------------|-------------|
| `id` | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Identifiant unique |
| `category_id` | BIGINT UNSIGNED | FOREIGN KEY → categories(id) | Catégorie du produit |
| `name` | VARCHAR(255) | NOT NULL | Nom du produit |
| `slug` | VARCHAR(255) | NOT NULL, UNIQUE | URL-friendly identifier |
| `description` | TEXT | NULLABLE | Description détaillée |
| `price` | DECIMAL(10,2) | NULLABLE | Prix en FCFA |
| `image` | VARCHAR(255) | NULLABLE | Nom du fichier image |
| `dimensions` | VARCHAR(255) | NULLABLE | Dimensions (peinture, design) |
| `technique` | VARCHAR(255) | NULLABLE | Technique (peinture) |
| `support` | VARCHAR(255) | NULLABLE | Support (peinture) |
| `materials` | VARCHAR(255) | NULLABLE | Matériaux (design, marque) |
| `style` | VARCHAR(255) | NULLABLE | Style |
| `collection` | VARCHAR(255) | NULLABLE | Collection (marque) |
| `sizes` | VARCHAR(255) | NULLABLE | Tailles disponibles (marque) |
| `year` | VARCHAR(255) | NULLABLE | Année de création |
| `is_available` | BOOLEAN | DEFAULT TRUE | Disponible à la vente |
| `is_featured` | BOOLEAN | DEFAULT FALSE | Produit en vedette |
| `order` | INT | DEFAULT 0 | Ordre d'affichage |
| `created_at` | TIMESTAMP | | Date de création |
| `updated_at` | TIMESTAMP | | Date de modification |

**Relations :**
- **N:1 avec `categories`** - Un produit appartient à une catégorie
- **1:N avec `orders`** - Un produit peut avoir plusieurs commandes

**Contraintes :**
- `ON DELETE CASCADE` sur `category_id` : Si une catégorie est supprimée, ses produits sont supprimés

**Exemple de données :**
```sql
id: 1, category_id: 1, name: "Horizon Rouge", price: 450000.00, 
dimensions: "80 x 100 cm", technique: "Acrylique", support: "Toile"
```

---

### 3. Table `orders` (Commandes)

**Description :** Enregistre toutes les commandes passées par les clients.

| Colonne | Type | Contraintes | Description |
|---------|------|-------------|-------------|
| `id` | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Identifiant unique |
| `product_id` | BIGINT UNSIGNED | FOREIGN KEY → products(id), NULLABLE | Produit commandé |
| `customer_name` | VARCHAR(255) | NOT NULL | Nom du client |
| `customer_email` | VARCHAR(255) | NOT NULL | Email du client |
| `customer_phone` | VARCHAR(255) | NOT NULL | Téléphone du client |
| `message` | TEXT | NULLABLE | Message du client |
| `product_name` | VARCHAR(255) | NULLABLE | Nom du produit (sauvegarde) |
| `product_price` | DECIMAL(10,2) | NULLABLE | Prix du produit (sauvegarde) |
| `status` | ENUM | DEFAULT 'pending' | Statut de la commande |
| `admin_notes` | TEXT | NULLABLE | Notes de l'administrateur |
| `created_at` | TIMESTAMP | | Date de création |
| `updated_at` | TIMESTAMP | | Date de modification |

**Valeurs ENUM pour `status` :**
- `pending` - En attente
- `confirmed` - Confirmée
- `processing` - En traitement
- `completed` - Complétée
- `cancelled` - Annulée

**Relations :**
- **N:1 avec `products`** - Une commande concerne un produit

**Contraintes :**
- `ON DELETE SET NULL` sur `product_id` : Si un produit est supprimé, la commande garde `product_name` et `product_price`

**Logique Métier :**
```php
// Lors de la création d'une commande, on sauvegarde le nom et le prix
$order->product_name = $product->name;
$order->product_price = $product->price;
```

---

### 4. Table `carousel_slides` (Slides du Carousel)

**Description :** Gère les slides du carousel de la page d'accueil.

| Colonne | Type | Contraintes | Description |
|---------|------|-------------|-------------|
| `id` | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Identifiant unique |
| `title` | VARCHAR(255) | NOT NULL | Titre du slide |
| `description` | TEXT | NULLABLE | Description |
| `image` | VARCHAR(255) | NOT NULL | Nom du fichier image |
| `link` | VARCHAR(255) | NULLABLE | Lien optionnel |
| `order` | INT | DEFAULT 0 | Ordre d'affichage |
| `is_active` | BOOLEAN | DEFAULT TRUE | Slide actif/inactif |
| `created_at` | TIMESTAMP | | Date de création |
| `updated_at` | TIMESTAMP | | Date de modification |

**Relations :**
- Aucune relation avec d'autres tables

**Exemple de données :**
```sql
id: 1, title: "Art Contemporain", description: "Une exploration...", 
image: "img1.jpg", order: 1, is_active: true
```

---

### 5. Table `activities` (Activités du Workshop)

**Description :** Stocke les activités et événements du NÈGRE Workshop.

| Colonne | Type | Contraintes | Description |
|---------|------|-------------|-------------|
| `id` | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Identifiant unique |
| `title` | VARCHAR(255) | NOT NULL | Titre de l'activité |
| `description` | TEXT | NOT NULL | Description détaillée |
| `image` | VARCHAR(255) | NULLABLE | Nom du fichier image |
| `price` | VARCHAR(255) | NULLABLE | Prix (format texte) |
| `type` | VARCHAR(255) | NOT NULL | Type d'activité |
| `frequency` | VARCHAR(255) | NULLABLE | Fréquence |
| `capacity` | VARCHAR(255) | NULLABLE | Capacité d'accueil |
| `audience` | VARCHAR(255) | NULLABLE | Public cible |
| `tab` | VARCHAR(255) | DEFAULT 'activites' | Onglet d'affichage |
| `is_active` | BOOLEAN | DEFAULT TRUE | Activité active/inactive |
| `order` | INT | DEFAULT 0 | Ordre d'affichage |
| `created_at` | TIMESTAMP | | Date de création |
| `updated_at` | TIMESTAMP | | Date de modification |

**Valeurs possibles pour `tab` :**
- `atelier` - L'Atelier
- `activites` - Activités
- `evenements` - Événements
- `podcasts` - Podcasts

**Relations :**
- Aucune relation avec d'autres tables

**Exemple de données :**
```sql
id: 1, title: "Week-end Peinture et Chill", type: "Atelier loisir créatif",
frequency: "Tous les week-ends", capacity: "12 participants", tab: "activites"
```

---

### 6. Table `contacts` (Messages de Contact)

**Description :** Enregistre tous les messages envoyés via le formulaire de contact.

| Colonne | Type | Contraintes | Description |
|---------|------|-------------|-------------|
| `id` | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Identifiant unique |
| `name` | VARCHAR(255) | NOT NULL | Nom de l'expéditeur |
| `email` | VARCHAR(255) | NOT NULL | Email de l'expéditeur |
| `phone` | VARCHAR(255) | NOT NULL | Téléphone de l'expéditeur |
| `message` | TEXT | NOT NULL | Message |
| `is_read` | BOOLEAN | DEFAULT FALSE | Message lu/non lu |
| `admin_response` | TEXT | NULLABLE | Réponse de l'admin |
| `created_at` | TIMESTAMP | | Date de création |
| `updated_at` | TIMESTAMP | | Date de modification |

**Relations :**
- Aucune relation avec d'autres tables

**Méthodes du modèle :**
```php
// Marquer comme lu
$contact->markAsRead();

// Scopes
Contact::unread()->get();  // Messages non lus
Contact::read()->get();    // Messages lus
```

---

### 7. Table `site_settings` (Paramètres du Site)

**Description :** Stocke les paramètres configurables du site (contact, WhatsApp, etc.).

| Colonne | Type | Contraintes | Description |
|---------|------|-------------|-------------|
| `id` | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Identifiant unique |
| `key` | VARCHAR(255) | NOT NULL, UNIQUE | Clé du paramètre |
| `value` | TEXT | NULLABLE | Valeur du paramètre |
| `type` | VARCHAR(255) | DEFAULT 'text' | Type de paramètre |
| `group` | VARCHAR(255) | DEFAULT 'general' | Groupe de paramètres |
| `created_at` | TIMESTAMP | | Date de création |
| `updated_at` | TIMESTAMP | | Date de modification |

**Types possibles :**
- `text` - Texte simple
- `textarea` - Texte long
- `image` - Chemin d'image
- `number` - Nombre

**Groupes possibles :**
- `general` - Paramètres généraux
- `contact` - Informations de contact
- `social` - Réseaux sociaux

**Méthodes du modèle :**
```php
// Récupérer une valeur
$email = SiteSetting::get('contact_email', 'default@example.com');

// Définir une valeur
SiteSetting::set('contact_email', 'new@example.com', 'text', 'contact');
```

**Exemple de données :**
```sql
id: 1, key: "contact_email", value: "fredericnda.ci@gmail.com", 
type: "text", group: "contact"

id: 2, key: "whatsapp_number", value: "2250768298965", 
type: "text", group: "contact"
```

---

## 🔗 Résumé des Relations

### Diagramme de Relations

```
categories (1) ──────────< (N) products
                              │
                              │
                              └──────────< (N) orders

[Tables Indépendantes]
├── carousel_slides (aucune relation)
├── activities (aucune relation)
├── contacts (aucune relation)
└── site_settings (aucune relation)
```

### Tableau des Relations

| Relation | Type | Contrainte | Description |
|----------|------|------------|-------------|
| `categories` → `products` | **One-to-Many** | CASCADE | Une catégorie peut avoir plusieurs produits. Si la catégorie est supprimée, ses produits le sont aussi. |
| `products` → `orders` | **One-to-Many** | SET NULL | Un produit peut avoir plusieurs commandes. Si le produit est supprimé, `product_id` devient NULL mais `product_name` et `product_price` sont préservés. |

### Clés Étrangères

```sql
-- products.category_id → categories.id
ALTER TABLE products 
ADD CONSTRAINT fk_products_category 
FOREIGN KEY (category_id) 
REFERENCES categories(id) 
ON DELETE CASCADE;

-- orders.product_id → products.id
ALTER TABLE orders 
ADD CONSTRAINT fk_orders_product 
FOREIGN KEY (product_id) 
REFERENCES products(id) 
ON DELETE SET NULL;
```

---

## 📈 Scopes et Méthodes Utiles

### Category Model

```php
// Récupérer les catégories actives
Category::active()->ordered()->get();

// Récupérer une catégorie avec ses produits
Category::with('products')->find(1);
```

### Product Model

```php
// Produits disponibles d'une catégorie
Product::byCategory('peinture')->available()->ordered()->get();

// Produits en vedette
Product::featured()->get();

// Prix formaté
$product->formatted_price; // "450 000 FCFA"
```

### Order Model

```php
// Commandes en attente
Order::pending()->get();

// Commandes par statut
Order::byStatus('confirmed')->get();

// Commandes avec leur produit
Order::with('product')->get();
```

### Contact Model

```php
// Messages non lus
Contact::unread()->get();

// Marquer comme lu
$contact->markAsRead();
```

---

## 🎯 Index et Performances

### Index Recommandés

```sql
-- Categories
CREATE INDEX idx_categories_slug ON categories(slug);
CREATE INDEX idx_categories_active ON categories(is_active);

-- Products
CREATE INDEX idx_products_slug ON products(slug);
CREATE INDEX idx_products_category ON products(category_id);
CREATE INDEX idx_products_available ON products(is_available);
CREATE INDEX idx_products_featured ON products(is_featured);

-- Orders
CREATE INDEX idx_orders_status ON orders(status);
CREATE INDEX idx_orders_product ON orders(product_id);

-- Contacts
CREATE INDEX idx_contacts_read ON contacts(is_read);

-- Activities
CREATE INDEX idx_activities_tab ON activities(tab);
CREATE INDEX idx_activities_active ON activities(is_active);

-- Site Settings
CREATE UNIQUE INDEX idx_settings_key ON site_settings(key);
```

---

## 🔐 Intégrité Référentielle

### Règles de Suppression

| Suppression de | Impact sur | Règle | Résultat |
|----------------|------------|-------|----------|
| **Category** | Products | `CASCADE` | Les produits de cette catégorie sont supprimés |
| **Product** | Orders | `SET NULL` | `product_id` devient NULL, mais `product_name` et `product_price` restent |

### Exemple Pratique

```php
// Si on supprime une catégorie
$category = Category::find(1);
$category->delete();
// Résultat : Tous les produits avec category_id = 1 sont supprimés

// Si on supprime un produit
$product = Product::find(1);
$product->delete();
// Résultat : Les commandes gardent product_name et product_price
// mais product_id devient NULL
```

---

## 📊 Statistiques et Requêtes Courantes

### Compter les éléments

```php
// Nombre de produits par catégorie
Category::withCount('products')->get();

// Nombre de commandes par produit
Product::withCount('orders')->get();

// Nombre de messages non lus
Contact::unread()->count();
```

### Requêtes avec Relations

```php
// Catégories avec leurs produits disponibles
Category::with(['products' => function($query) {
    $query->available()->ordered();
}])->get();

// Commandes avec produit et catégorie
Order::with('product.category')->pending()->get();
```

---

## 🛠️ Migrations - Ordre d'Exécution

Les migrations doivent être exécutées dans cet ordre :

1. `create_categories_table` *(pas de dépendance)*
2. `create_products_table` *(dépend de categories)*
3. `create_orders_table` *(dépend de products)*
4. `create_carousel_slides_table` *(pas de dépendance)*
5. `create_activities_table` *(pas de dépendance)*
6. `create_contacts_table` *(pas de dépendance)*
7. `create_site_settings_table` *(pas de dépendance)*

```bash
php artisan migrate:fresh --seed
```

---

## 📝 Seeders - Ordre d'Exécution

Les seeders doivent être exécutés dans cet ordre :

1. **CategorySeeder** - Créer les catégories en premier
2. **ProductSeeder** - Créer les produits (nécessite les catégories)
3. **CarouselSlideSeeder** - Indépendant
4. **ActivitySeeder** - Indépendant
5. **SiteSettingSeeder** - Indépendant

```php
// DatabaseSeeder.php
$this->call([
    CategorySeeder::class,
    ProductSeeder::class,
    CarouselSlideSeeder::class,
    ActivitySeeder::class,
    SiteSettingSeeder::class,
]);
```

---

## 🎨 Diagramme ERD (Entity Relationship Diagram)

### Version Textuelle Complète

```
┌─────────────────────────────────────────────────────────────────┐
│                   BASE DE DONNÉES E-COMMERCE                    │
│                      Frederic N'DA                              │
└─────────────────────────────────────────────────────────────────┘

┌──────────────────┐         ┌──────────────────┐         ┌──────────────────┐
│   CATEGORIES     │         │    PRODUCTS      │         │     ORDERS       │
├──────────────────┤         ├──────────────────┤         ├──────────────────┤
│ • id             │1────────N│ • id             │1────────N│ • id             │
│ • name           │         │ • category_id FK │         │ • product_id FK  │
│ • slug UNIQUE    │         │ • name           │         │ • customer_name  │
│ • description    │         │ • slug UNIQUE    │         │ • customer_email │
│ • banner_title   │         │ • description    │         │ • customer_phone │
│ • banner_desc    │         │ • price          │         │ • message        │
│ • image          │         │ • image          │         │ • product_name   │
│ • order          │         │ • dimensions     │         │ • product_price  │
│ • is_active      │         │ • technique      │         │ • status ENUM    │
│ • timestamps     │         │ • support        │         │ • admin_notes    │
└──────────────────┘         │ • materials      │         │ • timestamps     │
                             │ • style          │         └──────────────────┘
                             │ • collection     │
                             │ • sizes          │
                             │ • year           │
                             │ • is_available   │
                             │ • is_featured    │
                             │ • order          │
                             │ • timestamps     │
                             └──────────────────┘

┌──────────────────┐         ┌──────────────────┐         ┌──────────────────┐
│ CAROUSEL_SLIDES  │         │   ACTIVITIES     │         │    CONTACTS      │
├──────────────────┤         ├──────────────────┤         ├──────────────────┤
│ • id             │         │ • id             │         │ • id             │
│ • title          │         │ • title          │         │ • name           │
│ • description    │         │ • description    │         │ • email          │
│ • image          │         │ • image          │         │ • phone          │
│ • link           │         │ • price          │         │ • message        │
│ • order          │         │ • type           │         │ • is_read        │
│ • is_active      │         │ • frequency      │         │ • admin_response │
│ • timestamps     │         │ • capacity       │         │ • timestamps     │
└──────────────────┘         │ • audience       │         └──────────────────┘
                             │ • tab            │
                             │ • is_active      │         ┌──────────────────┐
                             │ • order          │         │  SITE_SETTINGS   │
                             │ • timestamps     │         ├──────────────────┤
                             └──────────────────┘         │ • id             │
                                                          │ • key UNIQUE     │
                                                          │ • value          │
                                                          │ • type           │
                                                          │ • group          │
                                                          │ • timestamps     │
                                                          └──────────────────┘

LÉGENDE:
─────────  Relation One-to-Many (1:N)
• column   Colonne de la table
FK         Foreign Key (Clé étrangère)
UNIQUE     Contrainte d'unicité
ENUM       Type énuméré
```

---

## 💡 Bonnes Pratiques Implémentées

### ✅ Intégrité des Données
- Clés étrangères avec contraintes appropriées
- Contraintes d'unicité sur les slugs
- Valeurs par défaut pertinentes

### ✅ Soft Deletes (Possible Extension)
Pour garder l'historique, on peut ajouter soft deletes sur :
```php
use Illuminate\Database\Eloquent\SoftDeletes;

// Dans le modèle
use SoftDeletes;
```

### ✅ Timestamps
Toutes les tables ont `created_at` et `updated_at` automatiques

### ✅ Scopes Eloquent
Facilite les requêtes courantes (active, available, etc.)

---

## 🚀 Améliorations Futures Possibles

### 1. Images Multiples
```php
// Nouvelle table : product_images
products (1) ──────────< (N) product_images
```

### 2. Variations de Produits
```php
// Nouvelle table : product_variations
products (1) ──────────< (N) product_variations
// (couleurs, tailles, etc.)
```

### 3. Panier d'Achat
```php
// Nouvelles tables
users (1) ──────────< (N) carts (1) ──────────< (N) cart_items
```

### 4. Système de Notes/Avis
```php
// Nouvelle table : product_reviews
products (1) ──────────< (N) product_reviews
```

---

**Documentation générée pour le projet Frederic N'DA E-commerce**  
*Version 1.0 - Octobre 2025*

