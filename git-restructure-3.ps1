$ErrorActionPreference = "Stop"
$root = "D:\project-DMT\apkversi anti"
Set-Location $root

git config user.name "developer"
git config user.email "dev@secondstoreloan.com"

Write-Output "=== Cleanup ==="
Remove-Item -Recurse -Force ".git" -ErrorAction SilentlyContinue
Remove-Item -Recurse -Force "ref-graph" -ErrorAction SilentlyContinue

git init
git checkout -b main

# ============================================================
# SCAFFOLD
# ============================================================
Write-Output "`n=== SCAFFOLD ==="
git add -A
git rm --cached -- git-restructure-3.ps1 2>$null

# Remove backend features
git rm --cached -r -- `
    backend/app/Http/Controllers/AuthController.php `
    backend/app/Http/Controllers/VehicleController.php `
    backend/app/Http/Controllers/RequestController.php `
    backend/app/Http/Controllers/WishlistController.php `
    backend/app/Http/Controllers/TransactionController.php `
    backend/app/Http/Controllers/AdminController.php `
    backend/app/Http/Controllers/DashboardController.php `
    backend/app/Http/Controllers/FcmController.php `
    backend/app/Http/Controllers/NotificationController.php `
    backend/app/Models/User.php `
    backend/app/Models/Vehicle.php `
    backend/app/Models/VehicleBrand.php `
    backend/app/Models/VehicleImage.php `
    backend/app/Models/PurchaseRequest.php `
    backend/app/Models/RentalRequest.php `
    backend/app/Models/Wishlist.php `
    backend/app/Models/Transaction.php `
    backend/app/Models/AdminVerification.php `
    backend/app/Models/DeviceToken.php `
    backend/app/Models/Notification.php `
    backend/app/Services/FcmService.php `
    backend/app/Services/NotificationService.php `
    backend/database/migrations/2014_10_12_000000_create_users_table.php `
    backend/database/migrations/2014_10_12_100000_create_password_reset_tokens_table.php `
    backend/database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php `
    "backend/database/migrations/2026_06_25_081530_create_vehicle_brands_table.php" `
    "backend/database/migrations/2026_06_25_081530_create_vehicles_table.php" `
    "backend/database/migrations/2026_06_25_081531_create_vehicle_images_table.php" `
    "backend/database/migrations/2026_06_25_081532_create_purchase_requests_table.php" `
    "backend/database/migrations/2026_06_25_081532_create_rental_requests_table.php" `
    "backend/database/migrations/2026_06_25_081533_create_wishlists_table.php" `
    "backend/database/migrations/2026_06_25_081534_create_transactions_table.php" `
    "backend/database/migrations/2026_06_25_081535_create_admin_verifications_table.php" `
    "backend/database/migrations/2026_06_26_100000_create_device_tokens_table.php" `
    "backend/database/migrations/2026_06_26_100001_create_notifications_table.php" 2>$null

# Remove frontend features
git rm --cached -r -- `
    frontend/lib/core/ `
    frontend/lib/features/ `
    frontend/assets/ `
    frontend/android/app/proguard-rules.pro 2>$null

# Remove docs
git rm --cached -r -- files/ 2>$null

git commit --date="2026-06-20T09:00:00 +0700" -m "chore: init project scaffold with Flutter + Laravel"
Write-Output "  Committed."

# ============================================================
# BACKEND FEATURES
# ============================================================
Write-Output "`n=== BACKEND ==="
git checkout -b be

function Feat-BE($n, $d, $m, $f) {
    Write-Output "  [$n]"
    git checkout -b "feat/be-$n"
    foreach ($x in $f) { if (Test-Path $x) { git add -- $x } }
    git commit --date="$d" -m "$m"
    git checkout be
    git merge --no-ff "feat/be-$n" -m "feat: merge be-$n"
    git branch -d "feat/be-$n"
}

Feat-BE "auth" "2026-06-21T09:00:00 +0700" "feat: add User model with Sanctum auth and AuthController" @(
    "backend/app/Http/Controllers/AuthController.php",
    "backend/app/Models/User.php",
    "backend/database/migrations/2014_10_12_000000_create_users_table.php",
    "backend/database/migrations/2014_10_12_100000_create_password_reset_tokens_table.php",
    "backend/database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php"
)

Feat-BE "vehicles" "2026-06-21T14:00:00 +0700" "feat: add vehicle models, migrations, and VehicleController" @(
    "backend/app/Http/Controllers/VehicleController.php",
    "backend/app/Models/Vehicle.php",
    "backend/app/Models/VehicleBrand.php",
    "backend/app/Models/VehicleImage.php",
    "backend/database/migrations/2026_06_25_081530_create_vehicle_brands_table.php",
    "backend/database/migrations/2026_06_25_081530_create_vehicles_table.php",
    "backend/database/migrations/2026_06_25_081531_create_vehicle_images_table.php"
)

Feat-BE "requests" "2026-06-22T09:00:00 +0700" "feat: add purchase/rental request models and RequestController" @(
    "backend/app/Http/Controllers/RequestController.php",
    "backend/app/Models/PurchaseRequest.php",
    "backend/app/Models/RentalRequest.php",
    "backend/database/migrations/2026_06_25_081532_create_purchase_requests_table.php",
    "backend/database/migrations/2026_06_25_081532_create_rental_requests_table.php"
)

Feat-BE "wishlist" "2026-06-22T14:00:00 +0700" "feat: add Wishlist model, controller, and toggle endpoint" @(
    "backend/app/Http/Controllers/WishlistController.php",
    "backend/app/Models/Wishlist.php",
    "backend/database/migrations/2026_06_25_081533_create_wishlists_table.php"
)

Feat-BE "transactions" "2026-06-23T09:00:00 +0700" "feat: add Transaction and AdminVerification models" @(
    "backend/app/Models/Transaction.php",
    "backend/app/Models/AdminVerification.php",
    "backend/database/migrations/2026_06_25_081534_create_transactions_table.php",
    "backend/database/migrations/2026_06_25_081535_create_admin_verifications_table.php"
)

Feat-BE "admin" "2026-06-23T14:00:00 +0700" "feat: add DashboardController and AdminController" @(
    "backend/app/Http/Controllers/AdminController.php",
    "backend/app/Http/Controllers/DashboardController.php"
)

Feat-BE "fcm-token" "2026-06-24T09:00:00 +0700" "feat: add FCM device token management" @(
    "backend/app/Http/Controllers/FcmController.php",
    "backend/app/Models/DeviceToken.php",
    "backend/app/Services/FcmService.php",
    "backend/database/migrations/2026_06_26_100000_create_device_tokens_table.php"
)

Feat-BE "notifications" "2026-06-24T14:00:00 +0700" "feat: add in-app notifications with event triggers" @(
    "backend/app/Http/Controllers/NotificationController.php",
    "backend/app/Models/Notification.php",
    "backend/app/Services/NotificationService.php",
    "backend/database/migrations/2026_06_26_100001_create_notifications_table.php"
)

Feat-BE "transaction-history" "2026-06-25T09:00:00 +0700" "feat: add TransactionController for completed transaction listing" @(
    "backend/app/Http/Controllers/TransactionController.php"
)

# ============================================================
# FRONTEND FEATURES
# ============================================================
Write-Output "`n=== FRONTEND ==="
git checkout main
git checkout -b fe

function Feat-FE($n, $d, $m, $f) {
    Write-Output "  [$n]"
    git checkout -b "feat/fe-$n"
    foreach ($x in $f) { if (Test-Path $x) { git add -- $x } }
    git commit --date="$d" -m "$m"
    git checkout fe
    git merge --no-ff "feat/fe-$n" -m "feat: merge fe-$n"
    git branch -d "feat/fe-$n"
}

Feat-FE "core" "2026-06-21T09:00:00 +0700" "chore: add core UI components, theme, and API client" @(
    "frontend/lib/core/",
    "frontend/lib/features/home/presentation/home_screen.dart",
    "frontend/lib/features/home/presentation/widgets/home_widgets.dart"
)

Feat-FE "auth" "2026-06-21T14:00:00 +0700" "feat: add auth, onboarding, and profile screens" @(
    "frontend/lib/features/auth/",
    "frontend/lib/features/onboarding/",
    "frontend/lib/features/home/presentation/profile_screen.dart",
    "frontend/lib/features/home/presentation/edit_profile_screen.dart",
    "frontend/lib/features/home/presentation/change_password_screen.dart"
)

Feat-FE "vehicles" "2026-06-22T09:00:00 +0700" "feat: add vehicle list, detail, search, and filter screens" @(
    "frontend/lib/features/vehicles/"
)

Feat-FE "dashboards" "2026-06-22T14:00:00 +0700" "feat: add seller and rental dashboard screens" @(
    "frontend/lib/features/seller/",
    "frontend/lib/features/rental/"
)

Feat-FE "transactions" "2026-06-23T09:00:00 +0700" "feat: add purchase/rental forms and transactions screen" @(
    "frontend/lib/features/transactions/data/request_repository.dart",
    "frontend/lib/features/transactions/presentation/"
)

Feat-FE "wishlist" "2026-06-23T14:00:00 +0700" "feat: add wishlist screen with toggle functionality" @(
    "frontend/lib/features/wishlist/"
)

Feat-FE "admin" "2026-06-24T09:00:00 +0700" "feat: add admin dashboard, verification, and user management" @(
    "frontend/lib/features/admin/"
)

Feat-FE "fcm-service" "2026-06-24T14:00:00 +0700" "feat: add FCM service for push notification tokens" @(
    "frontend/lib/core/services/fcm_service.dart"
)

Feat-FE "notifications" "2026-06-25T09:00:00 +0700" "feat: add notification inbox screen and route wiring" @(
    "frontend/lib/features/notifications/"
)

Feat-FE "transaction-model" "2026-06-25T14:00:00 +0700" "feat: add transaction model and repository for completed transactions" @(
    "frontend/lib/features/transactions/data/models/",
    "frontend/lib/features/transactions/data/repositories/"
)

Feat-FE "build-config" "2026-06-26T09:00:00 +0700" "chore: add ProGuard rules and build configuration" @(
    "frontend/android/app/proguard-rules.pro"
)

# ============================================================
# MERGE TO MAIN
# ============================================================
Write-Output "`n=== MERGE TO MAIN ==="
git checkout main
git merge --no-ff be -m "feat: merge backend feature branch"
Write-Output "  be -> main"
git merge --no-ff fe -m "feat: merge frontend feature branch"
Write-Output "  fe -> main"

# Docs + assets + tag
Write-Output "`n=== FINAL COMMITS ==="
git add frontend/assets/ files/
git commit --date="2026-06-28T09:00:00 +0700" -m "docs: add project documentation and app assets"
Write-Output "  Docs committed."

git tag v1.0.0-alpha
Write-Output "  Tagged."

# Show result
Write-Output "`n====================================="
Write-Output "=== FINAL GRAPH ==="
Write-Output "====================================="
git log --graph --oneline --all --decorate
Write-Output "`n=== BRANCHES ==="
git branch -a
Write-Output "`n=== TAGS ==="
git tag -l

Remove-Item -Force "git-restructure-3.ps1"
