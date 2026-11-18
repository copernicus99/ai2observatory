# AI² Observatory

Static export of https://ai2observatory.com, served from the domain root.
Deploy the complete repository contents, including `.htaccess` and `wp-content`, to the Apache document root. Apache must allow `.htaccess` overrides and enable `mod_rewrite` for the legacy URL redirects.

Run `python scripts/check_site.py` to check themed-page links, scripts, stylesheet imports, and restored icon fonts.

The theme uses root-relative URLs so `/sky-chart/` and historical `/sky-chart//` URLs load the same assets. Apache redirects repeated slashes and known nested sibling-page URLs such as `/sky-chart/overview//` to the existing canonical pages. Unknown pages still return 404.

Vendor stylesheet sources and versions are documented in `wp-content/themes/aiobservatory/assets/css/VENDOR.md`.

Astrophotography and Robotic Scopes now have pages based on the existing Station 1, hardware and software descriptions. Construction-gallery links use exported originals where available, otherwise the matching exported thumbnail. Unavailable overview/weather illustrations have been removed rather than substituted with unrelated pictures.

The sky page uses HTTPS forecast previews with visible provider links and a fallback message on image errors. Legacy sky-map, Earth-view and ephemeris images are replaced with links to current astronomy tools. The weather page links to the KPAPENAR3 dashboard instead of the retired Flash widget and banner.

Known export gaps: the `/initial/` reservation form and newsletter rely on WordPress plugins/backend endpoints not included in this repository; changing URLs cannot restore those services. Third-party providers may change or become unavailable; check forecast/observation timestamps before use.
