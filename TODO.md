# Syrian Investment Ideas Bank — Cleanup Phase TODO

- [x] Inspect existing project structure and conventions (done in inspection report)
- [x] Delete obsolete Baladna domain code (models, enums, policies, services)
- [x] Delete obsolete controllers, requests, resources, middleware
- [x] Delete obsolete factories, seeders, migrations, tests
- [x] Remove auth/role features and Sanctum-protected routes
- [x] Rewrite `routes/api.php` to public `/api/v1` scope
- [x] Clean `bootstrap/app.php` (remove role middleware, keep API JSON handling)
- [x] Clean `AppServiceProvider` (remove Gate policies)
- [x] Update project identity (composer description, .env APP_NAME, README)
- [x] Fix `DatabaseSeeder` and generic users migration
- [x] Remove obsolete Postman/API documentation files
- [x] Run validation (optimize:clear, about, route:list, test, pint)
- [x] Search for and remove obsolete terminology
- [x] Review git status/diff, commit, and push
