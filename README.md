# block_pluginmoodle

Un blocco Moodle che mostra un pulsante. Cliccando il pulsante appare un popup con il messaggio **"Benvenuto nel mio primo Plugin"**. Cliccando fuori dalla finestra, il popup scompare.

## Struttura del plugin

```
block_pluginmoodle/
├── amd/
│   └── src/
│       └── popup.js          # JavaScript AMD per il popup
├── lang/
│   └── en/
│       └── block_pluginmoodle.php  # Stringhe di lingua
├── block_pluginmoodle.php    # Classe principale del blocco
├── version.php               # Versione e metadati del plugin
└── README.md
```

## Installazione

1. Copia la cartella `block_pluginmoodle` nella directory `blocks/` della tua installazione Moodle.
2. Accedi come amministratore e vai su **Amministrazione del sito → Notifiche** per completare l'installazione.
3. Aggiungi il blocco a qualsiasi pagina tramite la modalità di modifica.

## Utilizzo

- Attiva la **modalità di modifica** nella tua pagina Moodle.
- Clicca su **"Aggiungi un blocco"** e seleziona **"Plugin Moodle"**.
- Il blocco mostrerà un pulsante **"Clicca qui!"**.
- Cliccando il pulsante apparirà un popup con il messaggio di benvenuto.
- Clicca fuori dal popup per chiuderlo.

## Requisiti

- Moodle 4.0 o superiore
- PHP 7.4 o superiore

## Autore

**Maurizio Giuffredi** — 2026

## Licenza

GNU GPL v3 o successiva — vedi [LICENSE](https://www.gnu.org/licenses/gpl-3.0.html)
