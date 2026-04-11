# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

**Compile SCSS (watch mode)** — run from `./utils/`:
```bash
bash ./utils/sass.sh
```
Watches `app/assets/scss/style.scss` → `app/assets/css/style.css`.

**Rebuild Propel ORM models** — run after editing `app/resources/orm/schema.xml`:
```bash
bash ./utils/model_build.sh
```
Regenerates classes in `app/resources/orm/Art/`. Do not manually edit generated files there.

**Run locally:**
```bash
php -S localhost:8000 -t ./app
```
Requires `app/env.json` (see `env.template.json` for structure).

**Install PHP dependencies:**
```bash
cd app && composer install
```

No automated tests or linter configured.

## Architecture

Traditional server-side PHP app. No client-side routing or build pipeline beyond SCSS.

**Request flow:**
- `app/index.php` — entry point, redirects based on `$_SESSION['active']`
- `app/go/` — pages (server-rendered PHP/HTML)
- `app/api/` — form submission endpoints (process POST, redirect with `?status=` or `?error=`)
- `app/actions/` — heavier handlers (e.g., image upload + resize for new/edit piece)
- `app/partials/` — shared header/footer templates (`gen-*` for public, `dash-*` for authenticated)

**Database layer:**
- MySQL with Propel ORM v2. Schema source of truth: `app/resources/orm/schema.xml`
- Four tables: `pieces`, `users`, `cfa` (certified fine art print tracking), `registry` (key-value config)
- ORM usage pattern: `(new Art\PiecesQuery())->find()` — fluent query builder

**Frontend:**
- Bootstrap 5.3.6 (customized via SCSS variables in `app/assets/scss/foundations/`)
- List.js: PHP injects data as inline JSON (`const db = <?php echo json_encode($pieces); ?>`), List.js renders/filters it
- lightGallery: used on piece stage for full-screen lazy-loaded image viewing
- SimpleMDE: markdown editor for `description`, `story`, `notes` fields

**Authentication:**
- `app/api/login.php` verifies password with `password_verify()`, sets `$_SESSION['active']`, `isAdmin`, `selectionOnly`
- Every `app/go/` page guards with session check at the top; admin pages additionally check `isAdmin`

**Images:**
- Only the filename is stored in the DB; full path constructed from `img_store_url` + filename
- Upload/resize logic in `app/actions/piece_new.php` — JPEG only, resized to max 1024×1024, named with `uniqid()`
- `img_store_path` (local filesystem) and `img_store_url` (URL prefix for `<img>` tags) are set in `env.json`

**AI training fields:**
- `pieces` table has `ai_training_form`, `ai_training_colored`, `ai_training_final` (markdown text fields) and `training_exports`, `training_descriptions` — used by `app/go/training/` for dataset export
