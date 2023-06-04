# Standards Doc

These standards try to adhere to ADA standards

## Spacing

For spacing use bootstraps `p-3` or `m-3` or `{ms, me, mt, mb, ps, pe, pt, pb}-3`

## Sizes

Use interaction elements like inputs, textareas, and buttons for example will be `min-height: 45px;`

## Colors

Avoid green and reds together. Do your best to keep contrast

## Icons

Use them so button colors are not the only differential on danger or success action items like save and cancel

Save should have a disk icon btn-primary for example
Cancel should have a ban icon with btn-warn for example
Delete should be trash btn-danger for example

## Destructive actions like delete

Will always have a confirm modal, for now use the JS `confirm('Sure?')` function
