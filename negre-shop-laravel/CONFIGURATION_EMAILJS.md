# Configuration EmailJS

## Guide de configuration pour l'envoi d'emails de confirmation de commande

### 1. Créer un compte EmailJS

1. Allez sur [https://www.emailjs.com/](https://www.emailjs.com/)
2. Créez un compte gratuit (100 emails/mois)
3. Confirmez votre email

### 2. Configurer le service d'email

1. Dans le tableau de bord, allez dans **"Email Services"**
2. Cliquez sur **"Add New Service"**
3. Choisissez votre fournisseur d'email (Gmail, Outlook, etc.)
4. Suivez les instructions pour connecter votre compte email
5. Notez le **Service ID** (ex: `service_o0hgy2e`)

### 3. Créer un template d'email

1. Allez dans **"Email Templates"**
2. Cliquez sur **"Create New Template"**
3. Configurez votre template avec les variables suivantes :

**Exemple de template :**

**Sujet :** Confirmation de commande - {{product_name}}

**Corps du message :**
```
Bonjour {{to_name}},

Nous avons bien reçu votre commande pour l'œuvre "{{product_name}}" au prix de {{product_price}}.

Détails de votre commande :
- Œuvre : {{product_name}}
- Prix : {{product_price}}
- Téléphone : {{customer_phone}}
- Message : {{message}}

Nous vous contacterons très prochainement pour finaliser votre commande.

Cordialement,
L'équipe Frederic N'DA
```

4. Notez le **Template ID** (ex: `template_xyz789`)

### 4. Récupérer votre clé publique

1. Allez dans **"Account"** > **"General"**
2. Trouvez votre **Public Key** (ex: `abcdefghijk123456`)

### 5. Configurer votre application

Dans le fichier `resources/views/peinture.blade.php`, remplacez les valeurs suivantes :

**Ligne 617 :**
```javascript
emailjs.init("YOUR_PUBLIC_KEY"); // Remplacez par votre Public Key
```

**Ligne 729 :**
```javascript
emailjs.send('YOUR_SERVICE_ID', 'YOUR_TEMPLATE_ID', templateParams)
```

Remplacez :
- `YOUR_PUBLIC_KEY` par votre clé publique
- `YOUR_SERVICE_ID` par votre Service ID
- `YOUR_TEMPLATE_ID` par votre Template ID

### 6. Variables disponibles dans le template

Les variables suivantes sont automatiquement envoyées à EmailJS :

- `{{to_email}}` : Email du client
- `{{to_name}}` : Nom du client
- `{{product_name}}` : Nom de l'œuvre commandée
- `{{product_price}}` : Prix de l'œuvre
- `{{customer_phone}}` : Téléphone du client
- `{{message}}` : Message de la commande

### 7. Test

1. Effectuez une commande de test sur votre site
2. Vérifiez que :
   - La commande est enregistrée dans la base de données
   - La modale de succès s'affiche
   - L'email est reçu par le client
   - La page se recharge après quelques secondes

### 8. Exemple de configuration complète

```javascript
// Initialisation
emailjs.init("abcdefghijk123456");

// Envoi d'email
emailjs.send('service_abc123', 'template_xyz789', {
    to_email: 'client@example.com',
    to_name: 'Jean Dupont',
    product_name: 'Œuvre artistique',
    product_price: '50 000 FCFA',
    customer_phone: '+225 01 02 03 04 05',
    message: 'Je souhaite commander cette œuvre'
});
```

### 9. Limitations du plan gratuit

- 200 emails par mois
- Support par email uniquement
- Délai d'envoi de quelques secondes

Pour plus d'emails, passez au plan payant (à partir de $15/mois pour 1000 emails).

### 10. Dépannage

**L'email ne part pas :**
- Vérifiez que les IDs sont corrects
- Vérifiez la console du navigateur pour les erreurs
- Assurez-vous que votre service email est bien configuré et actif

**L'email arrive en spam :**
- Configurez SPF et DKIM pour votre domaine
- Utilisez un service email professionnel (Gmail Pro, SendGrid, etc.)

**Erreur CORS :**
- Vérifiez que votre domaine est autorisé dans les paramètres EmailJS
- Ajoutez votre domaine dans "Settings" > "Security"

---

## Support

Pour plus d'informations, consultez la [documentation officielle EmailJS](https://www.emailjs.com/docs/).

