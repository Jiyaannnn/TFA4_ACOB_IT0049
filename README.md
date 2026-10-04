# Ledgerline Refill TFA4

This is my CodeIgniter 4 POS activity for IT0049 Technical Formative Assessment 4, **Who's Allowed In? Sessions and Authentication**. I continued my TFA3 Ledgerline Refill project in a separate folder, preserving its pages, task manager, customer and staff forms, uploads, branding, and responsive design.

## What changed

- `users.password` holds a `password_hash()` result for each staff member.
- `/login` checks a username with `password_verify()` before starting a staff session. The session ID is regenerated after sign in.
- `AuthFilter` protects all customer and staff GET and POST routes, including new and edit forms.
- `POST /logout` destroys the session and returns to sign in.
- New staff accounts require a password of at least 12 characters; editing a staff member can optionally replace the password.
- Existing TFA3 form validation, CSRF protection, avatar uploads, tasks, and public pages remain available.

## Requirements

PHP 8.2+, Composer 2, MySQL 8+, and PHP extensions `intl`, `mysqli`, `mbstring`, `fileinfo`, and `gd` with JPEG support. The local checks for this submission used PHP 8.5.10, Composer 2.10.3, and CodeIgniter 4.7.4.

## Local setup

```bash
cd '/Users/jiyan/School Files/WebSys Tech/TFA4_ACOB_IT0049'
composer install
cp env .env
```

Set `.env` for your own MySQL account and local URL:

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'
database.default.hostname = 127.0.0.1
database.default.database = ledgerline_pos_tfa4
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
database.taskStore.database = ledgerline_refill_tfa4
```

Choose one database setup method:

1. Import the included TFA4 database exports:

   ```bash
   mysql -u root < database/ledgerline_pos_tfa4.sql
   mysql -u root < database/ledgerline_refill_tfa4.sql
   ```

   The export includes password hashes but no public default password. On this device, local staff credentials are stored in the Git ignored `.local-credentials` file. On another device, assign a private setup password to the imported staff rows before signing in:

   ```bash
   export TFA4_INITIAL_PASSWORD='your-private-password-at-least-12-characters'
   php spark db:seed SetStaffPasswordsSeeder
   unset TFA4_INITIAL_PASSWORD
   ```

   Change each staff password in its edit form after first login.

2. For new empty databases, create `ledgerline_pos_tfa4` and `ledgerline_refill_tfa4`, migrate both groups, then seed once. Set a private initial password in your shell first; never commit it:

   ```bash
   php spark migrate -g default
   php spark migrate -g taskStore
   export TFA4_INITIAL_PASSWORD='your-private-password-at-least-12-characters'
   php spark db:seed PosSeeder
   php spark db:seed TaskSystemSeeder
   unset TFA4_INITIAL_PASSWORD
   ```

   Change each staff password in its edit form after first login. The seed password is shared only during initial setup.

Start the app:

```bash
php spark serve --port 8080
```

Open http://localhost:8080/login. Use the same hostname as `app.baseURL` so CSRF cookies are sent correctly.

## Where to look

| File | Purpose |
| --- | --- |
| `app/Controllers/Auth.php` | Checks hashes, creates the session, and signs out |
| `app/Filters/AuthFilter.php` | Redirects visitors without a staff session |
| `app/Config/Routes.php` | Registers protected customer and staff routes |
| `app/Database/Migrations/2026-10-04-000001_AddUserPassword.php` | Adds the password column |
| `app/Database/Seeds/PosSeeder.php` | Creates sample staff hashes from a private environment value |
| `app/Controllers/Users.php` | Validates and hashes newly entered staff passwords |
| `docs/ACOB_IT0049_TFA4_SessionsAndAuthentication.docx` | Activity report and real screenshots |

## Testing and submission

I tested the local program at desktop and 390 pixel width. The report records the checks performed and includes captured screenshots. The submission for this activity is the GitHub repository and its raw project files, migrations, seeders, database exports, report, and evidence. A hosted URL is reserved for the final project, as specified for this submission.

Never commit `.env`, `.local-credentials`, `vendor/`, logs, sessions, or temporary uploads. The included `.gitignore` excludes them.
