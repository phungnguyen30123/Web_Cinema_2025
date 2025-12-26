# Script to refactor admin views - removes inline CSS and uses layout
# Usage: .\refactor_admin_views.ps1

$viewsPath = "application\views"
$backupPath = "application\views\backup"

# Create backup directory
if (!(Test-Path $backupPath)) {
    New-Item -ItemType Directory -Path $backupPath
}

# List of admin views to refactor
$adminViews = @(
    "taikhoan_view.php",
    "qlynhanvien_view.php", 
    "qlyphim_view.php"
)

foreach ($view in $adminViews) {
    $viewPath = Join-Path $viewsPath $view
    if (Test-Path $viewPath) {
        Write-Host "Backing up $view..."
        Copy-Item $viewPath (Join-Path $backupPath "$view.backup")
        Write-Host "Backup created for $view"
    }
}

Write-Host "Backup completed. Manual refactoring required for each view."

