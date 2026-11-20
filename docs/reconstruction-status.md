# Backup reconstruction status

## Recovered and reconstructed

- Gallery: Helix, M31, Jupiter and M13 original images, already restored in PR #5. Object descriptions are editorial labels, not recovered exposure metadata.
- Robotic scope: original RC20.PNG photo already restored. Detailed project prose not found.
- Research: existing Station 1 descriptions reused, already restored. Exact original Research page not recovered.
- Weather: original y.gif station image already restored.
- Home: homepage loading overlay no longer waits for video, already fixed.
- Reserve: original exported initial/index.html contains New Member and Existing Member options, membership application text and observatory-time reservation text. Its embedded Ninja Forms configuration was corrupted by export URL rewriting; the saved target pages were not found. Reconstructed the two paths as email inquiry links using the address published on the homepage. Preferred-date/target/instrument suggestions are new copy, not recovered rules. No online scheduling or submission backend is claimed.
- Employment: added an inquiry page and repaired the homepage button. No original job descriptions were recovered; no vacancies have been invented.
- Historical emp.html, reserve and New routes redirect to their current destinations.

## Evidence reviewed

- TEMP/ai2observatory/ai2observatory: 2,031 files. Uploaded photos and theme images match prior TEMP/wp-content assets by Git blob identity.
- Both screencast MP4s sampled at 10-second intervals across their full duration. They show setup, widget editing, navigation, home/services/contact layouts and construction pages. Employment is visible in the menu; sampled frames do not show job descriptions or a reservation form. This was a visual review, not audio transcription or exhaustive frame-by-frame recovery.
- page.php uses the_content(); menu and widget templates request WordPress database content.
- The sole SQL file defines the newsletter subscription table; it contains no page records.
- Original broken reservation export preserved in TEMP/reconstruction-evidence/initial-export.html.

## Still needed for exact recovery

Original job listings/application requirements; reservation workflow, availability and membership rules; exact research/robotic page prose; astrophotography capture dates, exposures, equipment and processing notes. The published contact address is reused, but mailbox delivery was not tested.

## Deployment

Merge the PR and deploy the live files. Continue excluding TEMP/ from deployment. No database, legacy PHP execution or WordPress installation is required. These changes do not deploy automatically to the VPS.
