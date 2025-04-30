# PROlific

Art management software by Hannah A. Patellis

The goal behind PROlific was to be able to view all my works in one place and keep an up-to-date SQL database that would be easy to work with in future projects.

## Upcoming features

- Ability to replace an image without deleting the piece entry and re-adding it
- Ability to add guest users and select which pieces they can view
- Better error handling

## Databases

- PROlific currently is designed to use a single MySQL database with three tables:
  - `pieces` where each row is an individual work of art
  - `registry` where each row is a "registry entry" for upcoming features like the guest gallery
  - `users` where each row is a username/password for logging into PROlific

Schemas for these tables are located in the `schemas` directory.

## Plugins Used

- [SimpleMDE - Markdown Editor (JS)](https://github.com/sparksuite/simplemde-markdown-editor)
  - Used for better input and viewing of notes, descriptions, and stories associated with each piece
- [Grid.js (JS)](https://github.com/grid-js/gridjs)
  - Used for dynamically building a table view of the gallery in JS, as well as for searching in the table view of the gallery

## env.json

A `env.json` file is expected in the `public` directory. The `env.json` file follows this template:

```
{
  "environment": "dev or prod",
  "hostname": "",
  "sql_cert": "/absolute/path/to/.crt",
  "sql_uri": "",
  "sql_port": "",
  "sql_user": "",
  "sql_password": "",
  "img_store_location": "/absolute/path/to/img_store/"
}
```

Notes:
- The `img_store_location` is where images uploaded will be placed. The filename is the only thing kept in the SQL database
- The `sql_cert` may not be applicable to your MySQL setup and could be removed, although the `public/resource/db.php` file will need to be edited
- Currently `hostname` and `environment` aren't really being used for anything other than different `img_store_location`s and even that is a little wonky at the moment

## Screenshots of the 2025 edition

![Login screen](docs/2025/2025-prolific-login.png "Login screen")
![Dashboard view](docs/2025/2025-prolific-dashboard.png "Dashboard view")
![Gallery view](docs/2025/2025-prolific-gallery.png "Gallery view")
![Details view](docs/2025/2025-prolific-details.png "Details view")
![Update an existing piece](docs/2025/2025-prolific-update.png "Update an existing piece")
![Add a new piece](docs/2025/2025-prolific-add.png "Add a new piece")

---

Developed by Alexandria 'Hannah' I. Patellis, starting in 2024

[hannahap.com](https://hannahap.com)