---
id: localizations
title: Localizations
---

The localizations API of Multiple Select.

<div id="codefund"></div>

The localizations syntax:

```js
$('#multiple').multipleSelect({
  formatMessage: function () {
    return 'Format message'
  }
})
```

Example: [The i18n](/examples#i18n.html)

## formatSelectAll

- **Parameter:** `undefined`

- **Default:** `'[Seleccionar todo]'`

## formatAllSelected

- **Parameter:** `undefined`

- **Default:** `'Todos los seleccionados'`

## formatCountSelected

- **Parameter:** `count, total`

- **Default:** `count + ' of ' + total + ' selected'`

## formatNoMatchesFound

- **Parameter:** `undefined`

- **Default:** `'No matches found'`
