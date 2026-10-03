# Lettercraft 2.1 update

- The CV tab now has its own company, role, and job-description inputs.
- Choose General resume / CV for a country to generate without a job description.
- Targeted CVs and cover letters still require at least 80 job-description characters.
- Disabled generation buttons explain missing required input.

## Install over version 2

1. Back up your current installation privately.
2. Upload the CONTENTS of htdocs/lettercraft into your existing app directory, replacing matching files and merging assets. Include the updated api.php and index.html.
3. KEEP your existing config.php and lettercraft-private directory. This package contains neither live configuration nor private data.
4. Press Ctrl+F5. Open Resume / CV studio and choose a purpose.

Source code and the updated README are included for your repository; upload only htdocs/lettercraft contents to your web server.

Validation: TypeScript check, production build, and 39 PHP backend checks passed. General mode accepts an empty job description and excludes employer context; targeted mode and cover letters still require a description. No live OpenAI requests or hosted browser checks were performed.
