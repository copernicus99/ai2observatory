# AI² Observatory

Static export of https://ai2observatory.com, served from the domain root.
Deploy the complete repository contents, including `.htaccess` and `wp-content`, to the Apache document root. Apache must allow `.htaccess` overrides and enable `mod_rewrite` for the legacy URL redirects.

Run `python scripts/check_site.py` to check themed-page links, scripts, stylesheet imports, and restored icon fonts.

The theme uses root-relative URLs so `/sky-chart/` and historical `/sky-chart//` URLs load the same assets. Apache redirects repeated slashes and known nested sibling-page URLs such as `/sky-chart/overview//` to the existing canonical pages. Unknown pages still return 404.

Vendor stylesheet sources and versions are documented in `wp-content/themes/aiobservatory/assets/css/VENDOR.md`.

Known export gaps: some original photos, decorative assets, and third-party widgets are unavailable. The `/initial/` reservation form and newsletter rely on WordPress plugins/backend endpoints not included in this repository; changing URLs cannot restore those services. The homepage's Astrophotography and Robotic Scopes descriptions remain visible, but their links were removed because neither destination page exists in the export or on the live site.
