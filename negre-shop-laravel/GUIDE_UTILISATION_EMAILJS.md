# Guide d'Utilisation - Système EmailJS Global

## 📚 Vue d'ensemble

Le système EmailJS est maintenant **global** et peut être utilisé partout dans l'application. Vous n'avez plus besoin de dupliquer le code !

## 🎯 Fichiers créés

### 1. **CSS Global** : `public/css/modals.css`
- Modales de succès et d'erreur
- Notifications toast
- Animations et responsive

### 2. **JavaScript Global** : `public/js/emailjs-handler.js`
- Gestion EmailJS centralisée
- Fonctions utilitaires réutilisables
- Configuration unique

### 3. **Layout** : `resources/views/layouts/app.blade.php`
- Modales globales intégrées
- Scripts EmailJS chargés automatiquement

---

## ⚙️ Configuration initiale

### Étape 1 : Configurer EmailJS

Éditez le fichier `public/js/emailjs-handler.js` :

```javascript
const EMAIL_CONFIG = {
    publicKey: 'VOTRE_PUBLIC_KEY',      // Remplacez
    serviceId: 'VOTRE_SERVICE_ID',      // Remplacez
    templateId: 'VOTRE_TEMPLATE_ID'     // Remplacez
};
```

**C'est tout !** La configuration est maintenant globale pour toute l'application.

---

## 🚀 Utilisation

### 1. Modale de succès simple

```javascript
showSuccessModal({
    title: 'Bravo !',
    message: 'Votre action a été effectuée avec succès.',
    subMessage: 'Vous recevrez une confirmation par email.',
    showLoading: false,
    autoCloseDelay: 3000  // Fermeture auto après 3s
});
```

### 2. Modale d'erreur

```javascript
showErrorModal({
    title: 'Oups !',
    message: 'Une erreur est survenue.',
    subMessage: 'Veuillez réessayer plus tard.'
});
```

### 3. Notification Toast (légère)

```javascript
// Succès
showToast('Produit ajouté au panier !', 'success', 3000);

// Erreur
showToast('Impossible de supprimer cet élément', 'error', 3000);

// Avertissement
showToast('Attention : stock limité', 'warning', 3000);

// Information
showToast('Nouvelle mise à jour disponible', 'info', 3000);
```

### 4. Envoi d'email manuel

```javascript
const emailData = {
    to_email: 'client@example.com',
    to_name: 'Jean Dupont',
    product_name: 'Tableau artistique',
    product_price: '50 000 FCFA',
    customer_phone: '+225 XX XX XX XX',
    message: 'Votre message personnalisé'
};

sendEmail(emailData, {
    showSuccessModal: true,
    showErrorModal: true,
    reloadOnSuccess: false,
    onSuccess: (response) => {
        console.log('Email envoyé !', response);
    },
    onError: (error) => {
        console.error('Erreur email', error);
    }
});
```

### 5. Gestion complète d'un formulaire

**HTML du formulaire :**
```html
<form id="contactForm" action="{{ route('contact.store') }}" method="POST">
    @csrf
    <input type="text" name="name" required>
    <input type="email" name="email" required>
    <textarea name="message" required></textarea>
    <button type="submit">Envoyer</button>
</form>
```

**JavaScript :**
```javascript
const contactForm = document.getElementById('contactForm');

if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Préparer les données pour EmailJS
        const prepareEmailData = (formData, serverData) => ({
            to_email: formData.get('email'),
            to_name: formData.get('name'),
            message: formData.get('message')
        });

        // Utiliser le gestionnaire global
        handleFormSubmit(contactForm, prepareEmailData, {
            showSuccessModal: true,
            sendEmail: true,
            reloadOnSuccess: true,
            reloadDelay: 3000,
            successMessage: 'Votre message a été envoyé !',
            successSubMessage: 'Nous vous répondrons dans les plus brefs délais.'
        });
    });
}
```

---

## 📋 Exemples d'utilisation

### Exemple 1 : Formulaire de contact

```javascript
// resources/views/contact.blade.php
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        handleFormSubmit(form, (formData, serverData) => ({
            to_email: formData.get('customer_email'),
            to_name: formData.get('customer_name'),
            subject: 'Nouveau message de contact',
            message: formData.get('message')
        }), {
            successMessage: 'Message envoyé avec succès !',
            successSubMessage: 'Nous vous répondrons rapidement.'
        });
    });
});
</script>
@endsection
```

### Exemple 2 : Newsletter

```javascript
const newsletterForm = document.getElementById('newsletterForm');

newsletterForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(newsletterForm);
    
    // Soumission simple sans email
    fetch(newsletterForm.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': formData.get('_token')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Merci ! Vous êtes inscrit à notre newsletter.', 'success', 4000);
            newsletterForm.reset();
        }
    })
    .catch(error => {
        showToast('Erreur lors de l\'inscription', 'error', 3000);
    });
});
```

### Exemple 3 : Devis personnalisé

```javascript
const devisForm = document.getElementById('devisForm');

devisForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    handleFormSubmit(devisForm, (formData, serverData) => ({
        to_email: formData.get('email'),
        to_name: formData.get('name'),
        service: formData.get('service'),
        budget: formData.get('budget'),
        details: formData.get('details')
    }), {
        successMessage: 'Demande de devis envoyée !',
        successSubMessage: 'Nous étudions votre demande et revenons vers vous sous 24h.',
        sendEmail: true,
        reloadOnSuccess: false
    });
});
```

---

## 🎨 Personnalisation

### Modifier l'apparence des modales

Éditez `public/css/modals.css` :

```css
/* Changer la couleur de succès */
.success-icon {
    background-color: #4CAF50; /* Vert par défaut */
}

/* Changer la couleur d'erreur */
.error-icon {
    background-color: #f44336; /* Rouge par défaut */
}

/* Modifier l'animation */
@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
```

### Ajouter de nouveaux types de modales

Dans `public/js/emailjs-handler.js`, ajoutez :

```javascript
function showWarningModal(options = {}) {
    const defaults = {
        title: 'Attention',
        message: 'Une action est requise.',
        subMessage: ''
    };
    const config = { ...defaults, ...options };
    
    // Votre code personnalisé
}

// Exposer globalement
window.showWarningModal = showWarningModal;
```

---

## 🔧 Fonctions disponibles

### `showSuccessModal(options)`
Affiche une modale de succès.

**Options :**
- `title` (string) : Titre de la modale
- `message` (string) : Message principal
- `subMessage` (string) : Message secondaire
- `showLoading` (boolean) : Afficher le spinner
- `autoCloseDelay` (number) : Fermeture auto en ms (0 = jamais)

### `closeSuccessModal()`
Ferme la modale de succès.

### `showErrorModal(options)`
Affiche une modale d'erreur.

**Options :**
- `title` (string) : Titre
- `message` (string) : Message principal
- `subMessage` (string) : Message secondaire

### `closeErrorModal()`
Ferme la modale d'erreur.

### `showToast(message, type, duration)`
Affiche une notification toast.

**Paramètres :**
- `message` (string) : Message à afficher
- `type` (string) : 'success' | 'error' | 'warning' | 'info'
- `duration` (number) : Durée en ms (défaut: 3000)

### `sendEmail(emailData, options)`
Envoie un email via EmailJS.

**Options :**
- `showSuccessModal` (boolean) : Afficher modale succès
- `showErrorModal` (boolean) : Afficher modale erreur
- `reloadOnSuccess` (boolean) : Recharger la page
- `reloadDelay` (number) : Délai avant rechargement
- `onSuccess` (function) : Callback succès
- `onError` (function) : Callback erreur

### `handleFormSubmit(form, prepareEmailData, options)`
Gère la soumission complète d'un formulaire.

**Paramètres :**
- `form` (HTMLFormElement) : Élément formulaire
- `prepareEmailData` (function) : Fonction pour préparer les données email
- `options` (object) : Options de configuration

---

## 📝 Variables EmailJS disponibles

Dans vos templates EmailJS, utilisez ces variables :

- `{{to_email}}` : Email destinataire
- `{{to_name}}` : Nom destinataire
- `{{product_name}}` : Nom du produit (commandes)
- `{{product_price}}` : Prix du produit
- `{{customer_phone}}` : Téléphone client
- `{{message}}` : Message personnalisé

Vous pouvez ajouter d'autres variables selon vos besoins !

---

## ✅ Checklist de migration

Pour migrer une page existante vers le système global :

- [ ] Supprimer les imports EmailJS locaux
- [ ] Supprimer les modales en dur dans le HTML
- [ ] Supprimer les styles de modale en dur
- [ ] Remplacer par `showSuccessModal()` ou `handleFormSubmit()`
- [ ] Tester le formulaire
- [ ] Vérifier l'envoi d'email

---

## 🐛 Débogage

### La modale ne s'affiche pas
```javascript
// Vérifier que la modale existe
console.log(document.getElementById('globalSuccessModal'));
```

### L'email ne part pas
```javascript
// Vérifier la configuration
console.log(typeof emailjs !== 'undefined'); // Doit être true
```

### Erreur CORS
Ajoutez votre domaine dans les paramètres EmailJS (Settings > Security).

---

## 🎓 Bonnes pratiques

1. **Toujours utiliser le système global** - Ne pas dupliquer le code
2. **Personnaliser les messages** - Messages clairs et spécifiques
3. **Gérer les erreurs** - Toujours prévoir un fallback
4. **Tester régulièrement** - Vérifier l'envoi d'emails
5. **Respecter les limites** - Plan gratuit = 200 emails/mois

---

## 📞 Support

- **Documentation EmailJS** : https://www.emailjs.com/docs/
- **Fichiers du projet** :
  - CSS : `public/css/modals.css`
  - JS : `public/js/emailjs-handler.js`
  - Layout : `resources/views/layouts/app.blade.php`

---

**Version** : 1.0  
**Dernière mise à jour** : Octobre 2025

