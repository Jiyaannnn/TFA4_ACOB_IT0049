# TFA4 Screenshot Checklist

These are real captures from the running local CodeIgniter application. Capture at the same desktop width for Figures 1–7 and 9–16; Figure 8 uses 390 pixels. Keep account passwords and local credential files out of every screenshot.

| Figure | Page or file | What must be visible | Caption | Short explanation |
| --- | --- | --- | --- | --- |
| 1 | `/login` | Ledgerline branding, username and password fields, Sign in | My Ledgerline Refill staff sign in page. | The public form starts the authentication workflow. |
| 2 | `/login` after an incorrect password | Generic error and retained username, with password empty | My invalid login shows a safe error without revealing which field was wrong. | The failed attempt does not create a staff session. |
| 3 | `/customers` while signed in | Welcome message, five customers, Sign out | My customer directory is available after sign in. | A verified staff session passes the filter. |
| 4 | `/customers/new` after invalid email | Entered name and email validation message | My customer form retains input after validation fails. | The TFA3 form behavior still works under protection. |
| 5 | `/users/new` after duplicate username | Duplicate username error and entered full name | My staff form rejects an existing username. | Existing validation remains intact. |
| 6 | `/users` while signed in | Five staff records and avatar/placeholder | My staff directory remains available to signed in users. | The protected listing keeps the original design. |
| 7 | `/users/1/edit` | Prefilled staff fields, optional password and upload | My staff edit form can change a password or profile picture. | A blank password leaves the current hash unchanged. |
| 8 | `/users/1/edit` at 390 pixels | Full single column form and header without horizontal overflow | My staff edit form fits a 390 pixel screen. | Responsive layout remains usable. |
| 9 | `/customers/1/edit` | Prefilled customer record | My customer edit form remains protected and editable. | Existing records were preserved in the TFA4 database. |
| 10 | `/login` after logout and retrying `/users/1/edit` | Sign in page | My logout prevents access to a protected edit page. | The session was destroyed. |
| 11 | `/customers/new` | Blank customer form | My protected customer creation form. | Signed in staff can add a customer. |
| 12 | `/users/new` | Password field and staff creation form | My new staff form requires a password. | New passwords are hashed before storage. |
| 13 | `/users` after a test avatar upload | Staff listing with avatar | My valid JPEG avatar appears after upload. | The existing upload workflow still works. |
| 14 | `/` while signed out | Public header, Staff sign in, and one staff access card | My signed out home page hides protected record links. | The page offers one clear way to sign in. |
| 15 | `/login` after opening `/customers` directly | “Sign in to view customer accounts” message and login form | My direct customer link explains why sign in is needed. | The filter still blocks a guest and remembers the requested page. |
| 16 | `/` while signed in | Customer and Staff header links and both record shortcuts | My record links appear after staff sign in. | The authenticated navigation makes protected destinations available. |

Evidence files are in `docs/evidence/figure-01-login.png` through `figure-16-signed-in-home.png`. The temporary test customer and staff records were removed after testing, so Figures 11–13 document the test sequence rather than the final database contents.
