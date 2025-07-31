# Networkteam.Neos.Util

## Versions

| Neos CMS | Plugin Version | branch name |
|----------|----------------|-------------|
| >= 2.0   | 1.x            | `1.x`       |
| >= 3.0   | 2.x            | `2.x`       |
| >= 4.0   | 5.x            | `5.x`       |
| >= 9.0   | 6.x            | `master`    |

## Fusion Objects

### Networkteam.Neos.Util:ImageUriAndDimensions:**

Params:
* asset (required)
* width
* height
* maximumWidth
* maximumHeight
* allowCropping
* $allowUpScaling

Returns Array with Image uri, width and height
(Keys: src, width, height)

### Networkteam.Neos.Util:ResourceUri (not working in v 2.x)

Params:
* path
* localize
* cacheBuster

Returns Cachebusted Resource Uri

## ViewHelper

### SanitizedIdViewHelper

Params:
* string

Returns ID from given string (does not maintain uniqueness)

### StrftimeViewHelper

Params:
* date
* format

Returns locally formatted DateTime

## Eel Helper

### Networkteam.Neos.Util.Caching.entityTags

Params:
* entities
* prefix

Returns array of prefixed caching entries for given entities

### Networkteam.Neos.Util.String.nl2br

Params:
* string (required)
* is_xhtml

Converts line breaks to ```<br />``` Tags
