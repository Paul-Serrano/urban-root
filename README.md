# Plateforme de commande *Service Vin*

*Service Vin* est un **organisateur de transport spécialiste dans les procédures de dédouanement liée au domaine viticole**.
Il accompagne ses **clients (importateur et exportateur)** tout le long du processus d'import/export.

## Problématique

*Service Vin* a besoin d'une **interface permettant à l'importateur de passer commande de vin auprès du domaine viticole de son choix**.

## Conditions

*Service Vin* souhaite que la **première version** du projet soit fonctionnelle pour **mi-juillet**.

## L'équipe de réalisation

L'équipe de réalisation est composée de :

- *Rémi* : Product Owner
- *Arnaud* : Back-End Developer
- *Paul* : Back-End Developer
- *Rémy* : Full-Stack Developer

## Fonctionnalités

### V1

Les fonctionnalités attendues pour la première version du projet sont les suivantes.

#### Générales

- Génération de **devis/facture**
- Gestion de documents rattachés à la commande avec fusion de fichiers PDF
- Automatisation du processus de livraison auprès de **FedEx**
- Gestion du paiement via **Stripe** (virement/prélèvement bancaire)
- Système de notifications
- Système d'emailing
- Système d'authentification avec définition de rôles (employé/administrateur)

#### Exportateur

- Création de commande
- Réalisation de devis
- Suivi de la livraison

#### Service Vin

- Notification en cas de devis envoyé en validation par l'exportateur
- Validation ou refus (explicité) du devis en attente
- Réalisation de facture
- Impression des étiquettes de transport générées par FedEx
- Suivi de la livraison

## Spécificités

En cas d'expédition pour les États-Unis ou le Canada, il faudra prévoir l'ajout de deux documents spécifiques : le **cola** et la **prior notice**.
Ces documents seront joints à la commande envoyée à FedEx.
Tant que ces documents ne sont pas fournis, la commande est en état de pause.

## Rôles

- Super administrateur : développeur ou administrateur particulier
- Administrateur : employé de Service Vin
- Exportateur : employé de l'entreprise qui exporte ses produits
- Documentaliste : ajout de documents *cola* et *prior notice*
