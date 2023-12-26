# Nom du Projet

Description courte du projet.

## Table des Matières

- [Installation](#installation)
- [Utilisation](#utilisation)
- [Licence](#licence)

## Installation

(*Décrivez ici les étapes d'installation du projet. Incluez des dépendances, des commandes, etc.*)

Tout d'abord, assurz-vous bien d'avoir `node.js` d'installé sur votre machine (au moins v20.6.1).

Afin d'installer le projet, ouvrez votre terminal à la racine du projet puis entrez cela :

```bash
npm install
```

Cela permet d'installer toutes les dépendances du projet.

## utilisation

### Lancer le projet

Afin de lancer le projet, il suffit d'entrez cette ligne de commande dans le terminal, à la racine du projet :

```bash
npm start
```

Celle-ci ouvre votre navigateur par défaut avec résultat du projet (donc de vous lancer un serveur sur votre `localhost:8080`).
Elle permet également de lancer un éxécutable SASS afin de compiler le code `.scss` situé dans le dossier `assets` en code `.css` se situant dans le dossier `public` et étant appelé par le fichier `index.html`, et ce automatiquement et permanant.

Afin de couper le server et l'éxécutable SASS, tapez `control`+`c` dans le terminal.

### Modifier le projet

- Pour modifier le projet, vous pouver tout d'abord commencer par compléter les données du fichier `package.json` relatif à votre projet. Pour cela compléter les `""` et modifier les `"template"`.
- Dans le dossier `public`, modifier le fichier `meta.json` relatif au projet en complétant les `""` vides.
- Toujours dans ce dossier, modifier les données présentes dans le `<head>` du fichier `index.html` contenant `"template"` ou/et les `""` vides.

Une fois cela fait, vous pouvez commencer à coder !

Pour cela, il vous suffit de modifier le fichier `index.hml` présent dans le dossier `public` ainsi que les fichiers fichiers présent dans le dossier `assets` en respectant l'arborescence des fichiers déjà créer.

NE PAS MODIFIER LE CODE DANS LES FICHIERS `style.css`, `style.css.map`!

## licence

`ISC`
