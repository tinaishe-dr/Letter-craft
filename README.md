# Lettercraft

**AI-powered cover letters and international resume/CV tailoring from one saved master resume.**

Lettercraft is a self-hosted web application that helps job seekers turn their existing experience and a target job description into editable application documents. It includes an international resume/CV studio, an owner login, server-side API-key settings, and DOCX, PDF, TXT, and clipboard exports.

The application runs on PHP hosting, including XAMPP and compatible Apache shared hosting. The ready-to-upload build does not require Node.js, a database, or a ChatGPT plugin on the server.

## Features

- **Saved master resume:** import PDF, DOCX, or TXT, review the extracted text, and save it for future applications.
- **Tailored cover letters:** generate letters using your resume, job description, company, role, tone, and preferred length.
- **Resume/CV studio:** generate a resume, professional CV, or academic CV with destination and employer instructions.
- **Country and region selection:** search 249 ISO country/territory entries or choose a custom region.
- **Document controls:** select A4 or Letter paper and a page-length target.
- **Editable output:** review and revise generated documents before exporting.
- **Multiple exports:** download DOCX, PDF, or TXT, or copy plain text.
- **Owner settings:** save, replace, remove, and test an OpenAI API key; configure the model and change the owner password.
- **Private storage:** keep account settings, the master resume, and sessions in a protected server directory.

Tailored drafts are separate from the master resume. Export or copy them before reloading or signing out; they are not saved to the server.

## Technology

| Component | Implementation |
| --- | --- |
| Interface | React, TypeScript, Tailwind CSS |
| Build tooling | Vite |
| Backend | PHP with cURL |
| AI requests | OpenAI Responses API |
| Storage | Local JSON files and PHP sessions |
| Resume import | PDF.js and Mammoth |
| Document export | docx and jsPDF |

## Requirements

### Running the application

- PHP **8.1 or newer**, with cURL enabled.
- A writable private data directory and working PHP sessions.
- Outbound HTTPS access from the server to the OpenAI API.
- HTTPS for hosted installations; loopback localhost connections are allowed without it.
- An OpenAI API key with access to the model configured in Settings.
- Apache authorization rules enabled if private storage is inside the public web directory.

### Editing and rebuilding the frontend

- Node.js **22.13.0 or newer**, as declared in `source/package.json`.
- npm.

## Package layout

| Path | Purpose |
| --- | --- |
| `htdocs/lettercraft/` | Compiled website and PHP backend to deploy |
| `htdocs/lettercraft/api.php` | Authentication, storage, settings, and AI endpoints |
| `htdocs/lettercraft/config.example.php` | Configuration template safe to commit |
| `htdocs/lettercraft/country-profiles.json` | Backend country guidance |
| `source/` | Editable React/TypeScript frontend |
| `source/country-profiles.json` | Frontend copy of country guidance |
| `.gitignore` | Excludes configuration, private data, dependencies, and backups |

Create `config.php` during installation. Live configuration and private runtime data are intentionally excluded from the distribution.

## Local installation with XAMPP

1. Copy `htdocs/lettercraft` from the package into `C:\xampp\htdocs\`.
2. Copy `config.example.php` to `config.php` inside that folder.
3. Create a private directory outside the public web root, such as `C:\xampp\lettercraft-private`.
4. Edit `config.php`:

   ```php
   <?php
   return [
       'setup_code' => 'REPLACE_WITH_A_RANDOM_CODE_OF_AT_LEAST_20_CHARACTERS',
       'data_dir' => 'C:/xampp/lettercraft-private',
       'webroot_data_protection_verified' => false,
   ];
   ```

   Replace the example setup code with your own random value. The verification flag is only needed for storage inside the public web root.

5. Start Apache in XAMPP and open `http://localhost/lettercraft/`.
6. Complete owner setup using the setup code and an owner password of 12–72 bytes.
7. Open **Settings**, enter your API key and current password, save, and test the connection.
8. Import or paste your master resume, check the text, and save it.

The setup code authorizes initial account creation. Use the owner password for subsequent sign-ins.

## Shared hosting and InfinityFree

Upload the **contents** of `htdocs/lettercraft/` into your site's public directory. Keep `index.html`, `api.php`, and the assets together. Do not upload `source/`, backups, or repository metadata into the public directory.

Where your host permits it, use a private directory outside the public web root. If your host requires writable storage inside `htdocs`, use the following protected-folder setup.

### Protected storage inside `htdocs`

1. Copy `config.example.php` to `config.php` and set your random setup code.
2. Create `lettercraft-private` directly beside `api.php`.
3. Inside that folder, create `.htaccess` containing exactly:

   ```apache
   Require all denied
   ```

4. Create a harmless `access-check.txt` in the same folder.
5. Visit `https://YOUR-DOMAIN/lettercraft-private/access-check.txt`. Include the application's subdirectory if you installed it below the domain root.
6. Confirm the existing file returns **HTTP 403 Forbidden**. A 404, redirect, or generic error is not proof of protection. If necessary, inspect the status in your browser's Network panel.
7. Only after the check succeeds, configure:

   ```php
   <?php
   return [
       'setup_code' => 'REPLACE_WITH_YOUR_RANDOM_SETUP_CODE',
       'data_dir' => __DIR__ . '/lettercraft-private',
       'webroot_data_protection_verified' => true,
   ];
   ```

8. Open the application over HTTPS, complete owner setup, and configure the API connection.

Do not enable the verification flag if the test file is publicly readable. The backend checks the flag, directory location, and deny-rule contents, but these checks do not replace testing the deployed server's access controls.

## Upgrading an existing installation

1. Download a private backup of your current site, `config.php`, and data directory.
2. Upload the new contents of `htdocs/lettercraft/` into the existing application folder, replacing matching application files and merging assets.
3. **Keep your existing `config.php` and `lettercraft-private` folder**, including its `.htaccess`. Do not replace the live configuration with the example file.
4. Hard-refresh the browser with **Ctrl+F5**.
5. Verify sign-in, your saved resume, API settings, generation, and exports.

Keeping the existing configuration and private data preserves your owner account, API settings, and master resume.

## Using Lettercraft

### Generate a cover letter

1. Import or paste your resume and save the reviewed text as your master resume.
2. Open **Cover letter & job brief** and enter the target job description.
3. Add the company and role, then select tone and length.
4. Generate and review the letter for accuracy and relevance.
5. Edit the text and export DOCX, PDF, or TXT, or copy it.

### Tailor a resume or CV

1. Save your master resume and open **Resume / CV studio**.
2. Choose **Tailor to a specific job** and enter the job description directly in this tab (at least 80 characters), or choose **General resume / CV for a country** without a job description. CV job fields are separate from the cover-letter fields.
3. Choose the destination country or region and document type.
4. Select paper size and a page target; add employer-specific instructions.
5. Generate, check every claim, and edit the result.
6. Export or copy the finished document before leaving the page.

The same API key and model settings serve both generation features.

## International guidance and ATS formatting

The current release includes researched profiles for **11 countries**: the United States, Canada, United Kingdom, Australia, New Zealand, Germany, France, Netherlands, Ireland, Sweden, and South Africa. Supporting links are available in the app and `country-profiles.json`.

Other destinations use clearly labelled general international defaults. Country selection does not mean every destination has independently researched rules. Employer, industry, and academic requirements may differ within the same country.

- Generated documents currently use **English**.
- Layouts use a single column, standard headings, normal fonts, and selectable text.
- Page targets guide content length; they do not enforce a fixed page count.
- DOCX and PDF pagination may differ. Review the exported file before submitting.
- Photos and sensitive personal details are omitted by design.
- Academic CVs draw research, teaching, and publication evidence only from the master resume.
- This application does not generate official Europass documents, Japanese rirekisho forms, certified translations, or employer-specific application forms.
- PDF fonts support common Latin characters; non-Latin scripts may require font changes and additional review.

ATS-friendly formatting does not guarantee an ATS score, interview, or acceptance. AI output may contain errors despite instructions to use only supported resume evidence.

## Privacy and security

The browser communicates with the PHP backend, which makes AI requests using the server-stored API key. Generation sends relevant resume and job-description content to OpenAI. The backend sets `store: false` on Responses API requests; this is not a general claim about all provider retention policies.

Owner passwords are hashed. API keys and resume content are stored in server-side JSON files and are **not encrypted at rest by this application**. Protect the data directory, hosting account, and backups accordingly.

This is a single-owner application. Do not treat it as a multi-user service with separate accounts and isolated user workspaces.

## GitHub and `.gitignore`

Keep the provided `.gitignore` at the repository root. It excludes live PHP configuration, environment files, private data, sessions, uploads, exports, dependencies, logs, and backup archives. The configuration example and compiled public assets remain trackable.

Before committing, review:

```bash
git status --short
git ls-files
```

`.gitignore` does not remove already-tracked files. If live configuration or private data is tracked at the package paths, remove it from Git's index while retaining the local files:

```bash
git rm --cached -- htdocs/lettercraft/config.php
git rm -r --cached -- htdocs/lettercraft/lettercraft-private
```

Adjust those paths to match your repository. If a key has already been published, revoke and replace it; adding an ignore rule does not remove secrets from previous commits.

## Development

From the package root:

```bash
cd source
npm install
npx tsc --noEmit
npm run build
```

The build writes public assets into `htdocs/lettercraft/`. Its configuration preserves other files in that output directory, so keep live configuration and runtime data out of development distributions and review packaged files before sharing.

Serve the resulting application through PHP/Apache to test backend features. A frontend-only server cannot run `api.php`.

When editing country guidance, update both `source/country-profiles.json` and `htdocs/lettercraft/country-profiles.json`, then rebuild. Keep source links and coverage labels accurate.

## Troubleshooting

| Problem | What to check |
| --- | --- |
| Cannot create the private data folder | Check `data_dir`, host write restrictions, and PHP directory permissions. |
| Private-folder protection error | Restore the exact `.htaccess` rule and verify HTTP 403 before enabling the flag. |
| Site cannot be reached or domain does not resolve | Check domain setup and DNS; the request has not reached the app. |
| HTTPS or SSL error | Check the hosting certificate and domain configuration. |
| PHP source downloads or appears as text | Confirm the host executes PHP; do not enter credentials until fixed. |
| API key rejected | Replace the key in Settings and test again. |
| Model unavailable | Check the configured model ID and the API project's access. |
| Usage or rate-limit error | Check API usage, billing, and limits, then retry as appropriate. |
| AI request times out | Check outbound HTTPS access and hosting request limits. |
| Imported resume is incomplete | Review the extracted text; paste corrected text if necessary. Scanned PDFs may require external OCR. |
| Old interface after upgrading | Hard-refresh the browser and confirm the new assets were uploaded. |
| Draft disappeared | Generated drafts are temporary; export or copy before reloading or signing out. |

## Contributing

When reporting a bug, include the affected feature, reproduction steps, browser, PHP version, and a redacted error message. Never include API keys, passwords, private resumes, or live configuration in issues or pull requests.

For code changes, run the type check and production build, then verify the affected workflow through the PHP backend. Changes to exports should be checked in actual exported documents.

## License

No project-wide license is declared in this README. Add a `LICENSE` file before offering the project under specific reuse terms. Preserve the bundled third-party license notices, including font and UI asset notices.
