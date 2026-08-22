Production checklist and quick fixes for Hostinger (hPanel) — CodeIgniter 4

This guide collects steps to make this repository ready for production hosting on Hostinger (hPanel/shared hosting). Follow the checklist and adjust values for your environment.

1) Set environment to production
- On the server, copy `.env` from the example env file or copy `.env.production` to `.env`.
  - Ensure CI_ENVIRONMENT = production
  - Set `app.baseURL` to `https://your-domain.com/` (use HTTPS).
  - Set `logger.threshold = 1` (errors only).
  - Remove or empty `app.indexPage` if using URL rewrite (recommended).

2) Document root
- Configure Hostinger's hPanel to point the site's Document Root to the `public/` folder of this project.
  - If document root is not set to public/, the app is exposed and performance/security is harmed.

3) Composer & dependencies
- On the server (SSH) or your build step, install dependencies for production:
  - composer install --no-dev --optimize-autoloader
- This reduces autoload overhead and removes dev packages.

4) PHP settings & OPcache
- Enable OPcache in hPanel (PHP Configuration) and set recommended values:
  - opcache.enable = On
  - opcache.memory_consumption = 128
  - opcache.max_accelerated_files = 10000
  - opcache.validate_timestamps = 0 (or 1 if you prefer auto-reload)
- Copy or edit `public/.user.ini` (this repo contains an example) and set an absolute error_log path.
- Turn off display_errors (display_errors = Off) and enable log_errors = On.

5) Caching and session storage
- For shared hosting: file cache/session may be ok but watch disk I/O.
- For better performance, use a memory store (Redis, Memcached) if available; Hostinger business/VPS may offer it.
- Alternatively, move session storage to database if you can:
  - Use `CodeIgniter\\Session\\Handlers\\DatabaseHandler` and create the sessions table.

6) Static assets and compression
- Ensure `.htaccess` in `public/` enables compression (mod_deflate or mod_brotli) and proper caching headers.
- Consider uploading assets (images, CSS, JS) via CDN or enable browser caching headers.

7) HTTPS and HSTS
- Enable HTTPS (Let's Encrypt via hPanel) and set `app.forceGlobalSecureRequests = true` in .env.
- Optionally enable HSTS headers for stronger HTTPS security.

8) Logs & monitoring
- Ensure `writable/logs/` exists and is writable. Monitor logs for slow queries and errors.
- Configure `logger.threshold` appropriately and rotate logs if required.

9) Permissions
- Ensure `writable/` and its subfolders are writable by the web server (usually 755/775 on shared hosting,
  adjust as host requires).

10) Deployment practice
- Avoid editing files on production directly. Instead build artifacts locally or in a CI, run `composer install --no-dev --optimize-autoloader`, then deploy the built files.
- If opcache.validate_timestamps = 0, remember to clear OPcache on deploy (or set to 1 during active development).

11) Performance troubleshooting for "halaman lambat / timeout"
- Common causes on Hostinger shared hosting:
  - No OPcache enabled (enable it in PHP settings)
  - Heavy or unoptimized DB queries — profile queries and add indexes
  - Sessions or cache using slow disk I/O — prefer memory store
  - External API calls blocking page loads — make them asynchronous or use caching
  - Serving large assets from the same server (use CDN)
- Steps to debug:
  - Enable logging (production: errors only) and check `writable/logs/` for slow request stacks
  - Use Query logging temporarily on a staging copy to find slow queries
  - Use browser DevTools to inspect network waterfall (which resource blocks the page)

If the site is still intermittently slow after following the checklist, provide recent server logs (from `writable/logs/` and PHP error logs) and details about which pages are slow so targeted fixes (query optimization, cache configuration, or switching session driver) can be suggested.

Notes:
- Do NOT commit `.env` to repository. Keep it out of source control.
- The example `.env.production` and `public/.user.ini` in this repo are templates — update and apply them on the server.
