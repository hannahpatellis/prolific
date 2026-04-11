# Prolific

Art management software by Hannah A. Patellis

The goal behind Prolific was to be able to view all my works in one place and keep an up-to-date SQL database that would be easy to work with in future projects.

## Planned features

- Ability to replace an existing piece's image without deleting the piece entry and re-adding it
- Ability to select which pieces specific users can view
- Ability to delete users from the administration page
- Ability to edit users from the administration page
- Better error handling across the application
- Authentication that will persist, separate from PHP sessions
- Complete sorting and filtering on the gallery grid

## Databases

- Prolific currently is designed to use a single MySQL database with four tables:
  - `pieces` where each row is an individual work of art
  - `registry` where each row is a "registry entry" for upcoming features like the guest gallery
  - `users` where each row is a username/password for logging into Prolific
  - `cfa` where each row is a singular piece of physical certified fine art

Schemas for these tables are located in the `./schemas` directory.

## Plugins Used

- [SimpleMDE - Markdown Editor (JS)](https://github.com/sparksuite/simplemde-markdown-editor)
  - Used for better input and viewing of notes, descriptions, and stories associated with each piece
- [List.js (JS)](https://listjs.com)
  - Used for dynamically adding entries to the gallery grid, as well as for searching/filtering/sorting the gallery grid
- [lightGallery (JS)](https://www.lightgalleryjs.com)
  - Used on the pieces stage to allow for better "gallery"-like viewing, including full-screen and lazy-loading


## Packages Used

- [Propel ORM v.2 (PHP)](https://propelorm.org)
  - MySQL database ORM

## env.json

A `env.json` file is expected in the `./app` directory. The `./app/env.json` file follows this template:

```
{
  "environment": "dev or prod",
  "hostname": "",
  "sql_cert": "/absolute/path/to/.crt",
  "sql_uri": "",
  "sql_port": "",
  "sql_user": "",
  "sql_password": "",
  "sql_db": "",
  "img_store_url": "A URL for the location of images (used in an <img> tag), either a relative path to the directory or an https:// location",
  "img_store_path": "Local path for the location of uploaded images"
}
```

Notes:
- The `img_store_path` is where images uploaded will be placed. The filename is the only thing kept in the SQL database
- The `sql_cert` may not be applicable to your MySQL setup and could be removed, although the `./app/resources/db.php` file will need to be edited
- Currently `hostname` and `environment` aren't really being used for anything

## Utilities included

Two shell scrips are included in the `./utils` directory:
- `model_build.sh` will rebuild the ORM model files after you modify `./app/resources/orm/schema.xml`
- `sass.sh` will load up a watchful SASS compiler

## Note on AI usage

Prolific was developed entirely by hand until April 11, 2026 when I began to use Claude Code to assist in writing new features. I consider this to be an aid, just like Stack Overflow or other Google-fu resourcing. I do not intend for Claude Code to maintain this app entirely going forward. The goal here is to be able to rapidly  add more complex features to this passion-project. If you would like to discuss my use of AI/Claude Code or share feelings about AI usage (positive or negative!) please reach out to me! As I embark on a journey into learning more about this landscape-altering technology, I am very interested to hear all the hot takes. I love this project, I love art, and AI doesn't change or replace that. Ever.

## Screenshots from January 2026

More screenshots, including historical screenshots, can be found in the `docs` directory

![Login screen](docs/2026/Login.png "Login screen")
![Dashboard view](docs/2026/Dashboard.png "Dashboard view")
![Gallery view](docs/2026/Gallery-Grid.png "Gallery view")
![Details view](docs/2026/Piece-View.png "Details view")
![Update an existing piece](docs/2026/CFA-List.png "Certified fine art list view")
![Add a new piece](docs/2026/Piece-New.png "Add a new piece to the database")

---

Developed by Alexandria 'Hannah' I. Patellis, starting in 2024

[hannahap.com](https://hannahap.com)
