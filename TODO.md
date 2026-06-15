# TODO

## Goal
Fix Laravel 500 error caused by missing controller class: `App\Http\Controllers\API\CustomerController`.

## Plan
1. Verify route/controller namespace mismatch (routes import `App\Http\Controllers\API\CustomerController`, but file is currently at `app/Http/Controllers/CustomerController.php` with `namespace App\Http\Controllers\API;`).
2. Move controllers into `app/Http/Controllers/API/` so PSR-4 autoload resolves classes correctly.
3. Update any route imports or namespaces if needed (should already match after move).
4. Run `composer dump-autoload` and `php artisan optimize:clear`.
5. Confirm by calling `php artisan route:list` and re-testing the endpoint.

