# Lettercraft 2 — international resume / CV studio

## Upgrade your working InfinityFree site

1. Download a backup of the existing site and private data to your computer.
2. Upload the CONTENTS of `htdocs/lettercraft/` into the same directory that
   currently contains your site's `api.php` and `index.html`. Replace matching
   files and merge the assets directory. Do not create another nested htdocs.
3. KEEP your existing `config.php` and `lettercraft-private` directory, including
   its `.htaccess`. This package deliberately includes neither live config nor
   private data, so merging these files preserves your login, key and resume.
4. Hard refresh the site (Ctrl+F5). Enter the target job under **Cover letter &
   job brief**, then open **Resume / CV studio**. Choose country, document type,
   page target and paper size, add employer instructions, and generate.
5. Review/edit the result and export DOCX, PDF or TXT, or copy plain text.
   Export before reloading/signing out. Tailored drafts are not saved to the
   server and never overwrite your master resume.

No Node.js or database is required on InfinityFree; PHP 8.1+ and cURL remain
required. Existing model/API settings apply to both generation features.

## Coverage and limits

250 choices: 249 ISO country/territory entries plus a custom region option.
11 researched profiles: US, Canada, UK, Australia, New Zealand, Germany,
France, Netherlands, Ireland, Sweden and South Africa. Source links are visible
in the app and stored in `country-profiles.json`; reviewed 3 October 2026.
Other destinations explicitly use general international defaults, not verified
country rules. No universal national CV standard is claimed. Employer and
sector requirements can differ within a country.

All generated documents use English. The layouts use standard single-column
ATS structure, selectable text, section headings, and normal fonts. This is not
an official Europass, Japanese rirekisho, government form or certified
translation generator. Check application language and required attachments.
Photos and sensitive personal details are omitted by this app's design, even
where a local guide mentions them. Academic CV mode selects research/teaching/
publication evidence only if present in the master resume.

A4 / Letter are export choices, not legal requirements. Page targets guide
content length, not an enforced cap; PDFs show their actual page count after
export. Word and PDF pagination can differ. PDF font supports common Latin
characters; non-Latin names/scripts may need an appropriate font and review.
No ATS score or acceptance guarantee is claimed. Review AI output for factual
accuracy, missing experience and unsupported claims before submitting.

## GitHub

Put this package at your repository root, including `.gitignore`. It excludes
config.php, environment secrets, private data, sessions, uploads, exports,
node_modules, logs and backup archives. `config.example.php` is safe to commit.
Source and compiled public assets remain trackable for convenient deployment.

A .gitignore does not remove files already tracked. Run `git ls-files` and
review the list before committing. If your live config is tracked at the
package path, untrack it with:

    git rm --cached -- htdocs/lettercraft/config.php

Use the actual path in your repository. Similarly untrack any private data
folder with `git rm -r --cached -- ACTUAL_PRIVATE_FOLDER_PATH`. These commands
remove files from Git's index, not your working copy. If a real API key was
previously pushed, revoke/replace it; ignoring it does not erase Git history.

## Development

In `source`, run `npm install` then `npm run build`. Built public assets go to
`htdocs/lettercraft`. The backend is `htdocs/lettercraft/api.php`. Keep both
copies of `country-profiles.json` in sync after changing guidance, then build.
Use `npx tsc --noEmit` for the source type check. Do not publish the source
folder, README, local backups, or repository metadata into htdocs.

## Fresh installation only

Copy config.example.php to config.php, set a random setup code of 20+ characters,
and create lettercraft-private beside api.php. Inside it create `.htaccess`
containing exactly `Require all denied` and a harmless access-check.txt. Verify
that the URL to that existing file returns HTTP 403 before setting
webroot_data_protection_verified to true. Then complete owner setup using HTTPS.
Existing installations should keep their already-working configuration.
