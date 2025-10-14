# Configuration des Variables d'Environnement

## 📝 Nouvelles variables ajoutées

Pour une meilleure sécurité et maintenabilité, les informations sensibles ont été déplacées dans le fichier `.env`.

---

## 🔐 Variables WhatsApp

### WHATSAPP_NUMBER
Numéro WhatsApp pour les réservations et commandes.

```env
WHATSAPP_NUMBER=2250769465904
```

**Format** : Code pays + numéro (sans espaces, ni symboles)
- Côte d'Ivoire : `225` + numéro à 10 chiffres

**Utilisation dans le code** :
```php
// Dans les vues
{{ $whatsappNumber }}

// Dans les contrôleurs
config('services.whatsapp.number')
```

---

## 📧 Variables EmailJS

### EMAILJS_PUBLIC_KEY
Clé publique EmailJS pour initialiser le SDK.

```env
EMAILJS_PUBLIC_KEY=2j_2TpjW4-LkHHqA5
```

**Où la trouver** :
1. Connectez-vous sur [EmailJS.com](https://www.emailjs.com/)
2. Allez dans **Account** > **General**
3. Copiez la **Public Key**

### EMAILJS_SERVICE_ID
ID du service email configuré dans EmailJS.

```env
EMAILJS_SERVICE_ID=service_atkfepu
```

**Où la trouver** :
1. Allez dans **Email Services**
2. Sélectionnez votre service
3. Copiez le **Service ID**

### EMAILJS_TEMPLATE_ID
ID du template d'email.

```env
EMAILJS_TEMPLATE_ID=template_nrtko5u
```

**Où la trouver** :
1. Allez dans **Email Templates**
2. Sélectionnez votre template
3. Copiez le **Template ID**

**Utilisation dans le code** :
```php
// Dans les vues (JavaScript)
{{ json_encode($emailjsConfig) }}

// Dans les contrôleurs
config('services.emailjs.public_key')
config('services.emailjs.service_id')
config('services.emailjs.template_id')
```

---

## ⚙️ Configuration

### Fichiers modifiés

#### 1. `config/services.php`
Ajout de la configuration WhatsApp et EmailJS :

```php
'whatsapp' => [
    'number' => env('WHATSAPP_NUMBER', '2250769465904'),
],

'emailjs' => [
    'public_key' => env('EMAILJS_PUBLIC_KEY'),
    'service_id' => env('EMAILJS_SERVICE_ID'),
    'template_id' => env('EMAILJS_TEMPLATE_ID'),
],
```

#### 2. `app/Providers/AppServiceProvider.php`
Partage des variables avec toutes les vues :

```php
view()->composer('*', function ($view) {
    $view->with('whatsappNumber', config('services.whatsapp.number'));
    $view->with('emailjsConfig', [
        'publicKey' => config('services.emailjs.public_key'),
        'serviceId' => config('services.emailjs.service_id'),
        'templateId' => config('services.emailjs.template_id'),
    ]);
});
```

#### 3. `public/js/emailjs-handler.js`
Ajout d'une fonction pour charger la configuration :

```javascript
window.setEmailJSConfig = function(config) {
    if (config && config.publicKey && config.serviceId && config.templateId) {
        EMAIL_CONFIG = config;
        emailjs.init(EMAIL_CONFIG.publicKey);
    }
};
```

#### 4. `resources/views/layouts/app.blade.php`
Initialisation automatique depuis le .env :

```blade
<script>
    @if(isset($emailjsConfig))
    setEmailJSConfig(@json($emailjsConfig));
    @endif
</script>
```

---

## 🚀 Installation / Mise à jour

### Pour un nouveau développeur

1. **Copier le fichier `.env.example`** :
```bash
cp .env.example .env
```

2. **Remplir les variables** :
```env
WHATSAPP_NUMBER=votre_numero
EMAILJS_PUBLIC_KEY=votre_cle_publique
EMAILJS_SERVICE_ID=votre_service_id
EMAILJS_TEMPLATE_ID=votre_template_id
```

3. **Vider le cache** :
```bash
php artisan config:clear
php artisan cache:clear
```

### Pour un serveur de production

1. **Définir les variables dans le `.env` de production**

2. **Ne jamais commiter le fichier `.env`** (déjà dans `.gitignore`)

3. **Vider le cache après modification** :
```bash
php artisan config:cache
```

---

## 🔒 Sécurité

### ✅ Avantages de cette approche

- **Pas de secrets dans le code source**
- **Facile à changer sans modifier le code**
- **Configuration par environnement** (dev, staging, prod)
- **Respect des bonnes pratiques Laravel**

### ⚠️ Important

- ❌ **Ne jamais commit

ter le fichier `.env`**
- ✅ Toujours committer `.env.example` (sans valeurs sensibles)
- ✅ Utiliser des valeurs différentes en production
- ✅ Limiter l'accès au fichier `.env` sur le serveur

---

## 📋 Variables complètes du .env

```env
# WhatsApp
WHATSAPP_NUMBER=2250769465904

# EmailJS Configuration
EMAILJS_PUBLIC_KEY=2j_2TpjW4-LkHHqA5
EMAILJS_SERVICE_ID=service_atkfepu
EMAILJS_TEMPLATE_ID=template_nrtko5u
```

---

## 🧪 Test

Pour vérifier que la configuration fonctionne :

1. **Vérifier les variables** :
```bash
php artisan tinker
config('services.whatsapp.number')
config('services.emailjs.public_key')
```

2. **Tester dans le navigateur** :
   - Ouvrez la console du navigateur (F12)
   - Vous devriez voir : `EmailJS configuré depuis .env`

3. **Tester une commande** :
   - Essayez de passer une commande
   - Vérifiez que l'email est envoyé
   - Vérifiez que le bouton WhatsApp fonctionne

---

## 🔄 Migration depuis l'ancienne version

Si vous aviez les valeurs en dur dans le code :

### Avant
```javascript
const whatsappNumber = "2250769465904";
const EMAIL_CONFIG = {
    publicKey: '2j_2TpjW4-LkHHqA5',
    // ...
};
```

### Après
```javascript
const whatsappNumber = "{{ $whatsappNumber }}";
// EMAIL_CONFIG chargé automatiquement depuis .env
```

**Aucune modification nécessaire** si vous avez déjà mis à jour vers cette version !

---

## 📞 Support

En cas de problème :

1. Vérifiez que le fichier `.env` contient les bonnes variables
2. Videz le cache : `php artisan config:clear`
3. Vérifiez la console du navigateur pour les erreurs JavaScript
4. Consultez les logs Laravel : `storage/logs/laravel.log`

---

## 📚 Ressources

- [Laravel Configuration](https://laravel.com/docs/configuration)
- [Laravel Environment Configuration](https://laravel.com/docs/configuration#environment-configuration)
- [EmailJS Documentation](https://www.emailjs.com/docs/)

---

**Dernière mise à jour** : 14 Octobre 2025  
**Version** : 2.0

