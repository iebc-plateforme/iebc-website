## Project snapshot

This repository is a Laravel (v12) SB Admin 2 preset. It's an MVC app with server-rendered Blade views and a Laravel Mix frontend build. Key directories:

- `app/Http/Controllers/` — controller actions returning Blade views (see `HomeController`, `ProfileController`).
- `app/Models/` — Eloquent models (User has mutators/casts).
- `resources/views/` — Blade templates used by routes in `routes/web.php`.
- `routes/web.php` — primary web routes; uses `Auth::routes()` and direct controller references.
- `webpack.mix.js` and `package.json` — frontend asset pipeline (npm + laravel-mix).
- `composer.json` — PHP dependencies and artisan scripts.

## What to know up front

- Auth is provided by `laravel/ui` + Laravel's standard auth scaffolding. Many controllers use `$this->middleware('auth')`.
- Controllers commonly return views (not APIs). If adding JSON endpoints, follow existing controller patterns and register routes in `routes/api.php`.
- Models use Eloquent conventions; `User` defines a `setPasswordAttribute` mutator (bcrypt) and a `getFullNameAttribute` accessor.
- Passwords are automatically bcrypt-hashed via the `User::setPasswordAttribute` mutator; when updating passwords in controllers, assign plain text to `$user->password` (mutator handles hashing).
- The project expects `.env` to contain DB credentials; `composer` scripts will create `.env` from `.env.example` if missing.

## Common workflows & commands

- Backend install/setup:
  - `composer install`
  - `cp .env.example .env && php artisan key:generate`
  - Set DB credentials in `.env` (default DB name: `iebc`).
- Frontend build:
  - `npm install`
  - `npm run dev` (development)
  - `npm run production` (build assets for production)
- Run tests: `vendor/bin/phpunit` (project uses PHPUnit 11). See `phpunit.xml` for configuration.
- Local server: `php artisan serve` or use your local Apache (XAMPP) setup — project root is intended for use inside XAMPP.

## Project-specific conventions

- Controllers are thin: validate request, mutate Eloquent models, then return a Blade view or redirect with flash messages (see `ProfileController@update`). Follow that pattern for new UI endpoints.
- Validation rules are inline in controller methods using `$request->validate([...])`.
- Routes use string controller references (e.g. `HomeController@index`). When adding routes, keep them in `routes/web.php` unless building an API.
- Blade views live under `resources/views/` and follow typical Laravel view naming (e.g. `view('profile')` refers to `resources/views/profile.blade.php`).

## Integration points & external dependencies

- Database: MySQL (see `.env` default `DB_CONNECTION=mysql`, `DB_DATABASE=iebc`). Migrations exist under `database/migrations` (several created in Oct 2025).
- Mail: `MAIL_MAILER=log` by default; uses Symfony mailers available in `composer.json` if configured.
- Packages of note: `devmarketer/easynav` (navigation helper), `laravel/ui` (auth scaffolding), `laravel-mix` for assets.

## Examples (copy-paste friendly)

- Add a web route that requires auth and returns a view:

  Route::get('/reports', 'ReportController@index')->middleware('auth')->name('reports.index');

- Update a user's password in a controller (mutator hashes automatically):

  $user = Auth::user();
  $user->password = $request->input('new_password');
  $user->save();

## Files to inspect when making changes

- `routes/web.php` — route registration and auth setup.
- `app/Http/Controllers/*` — controller patterns and middleware usage.
- `app/Models/User.php` — password mutator & full-name accessor.
- `webpack.mix.js` / `package.json` — frontend build behavior.
- `phpunit.xml` — test runner settings.

## Editing & PR guidance for AI agents

- Preserve existing controller method signatures and route names when changing behavior.
- When adding new migrations, follow the existing timestamp naming pattern in `database/migrations` and include `up()`/`down()` methods.
- Don't change `.env` secrets; describe required `.env` keys in PR notes instead.

If anything looks missing or you'd like the agent to prioritize refactors, tell me which area to expand (tests, API endpoints, or frontend assets) and I'll iterate.
