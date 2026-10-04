# TFA4 Presentation Guide

1. Open `http://localhost:8084/customers` in a signed out browser. Explain that the `AuthFilter` redirects guests to `/login` before the controller runs.
2. Enter an incorrect password. Point out the generic error and that no staff session was created.
3. Sign in with your local credential from the Git ignored `.local-credentials` file. Do not display or read the password aloud. Explain that `password_verify()` checks the saved hash and the app regenerates the session ID.
4. Show the customer and staff directories, plus each new and edit form. Explain that both GET and POST routes are protected and the original TFA3 validation and upload features still work.
5. In the staff form, show that a new account requires a 12 character password and an edit can leave the password empty. Explain that `password_hash()` runs before saving.
6. Show the `users.password` column structure or a redacted hash prefix only. Do not show the local credential file.
7. Sign out and revisit `/users/1/edit`. Explain that the session is destroyed, so the filter redirects again.
8. Mention that the TFA4 project and its two databases are separate from TFA3. Submit the GitHub repository link and the included report; no hosted URL is required for this activity.

A session is server-side state associated with a browser. A filter is CodeIgniter code that checks a request before the page controller runs. A hash is a one-way representation of a password used for verification rather than plaintext storage.
