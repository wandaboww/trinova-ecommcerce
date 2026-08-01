# ============================================================
# TRINOVA DIGITAL — Laravel Setup Script (Safely Merged)
# Jalankan file ini dengan klik kanan > "Run with PowerShell"
# atau ketik di PowerShell: .\setup.ps1
# ============================================================

$ErrorActionPreference = "Stop"

Write-Host "============================================" -ForegroundColor Cyan
Write-Host "  TRINOVA DIGITAL - Safe Laravel Setup" -ForegroundColor Cyan
Write-Host "============================================" -ForegroundColor Cyan
Write-Host ""

# Cek working directory
$projectPath = Split-Path -Parent $MyInvocation.MyCommand.Path
Set-Location $projectPath

Write-Host "[1/6] Mengecek tools yang tersedia..." -ForegroundColor Yellow

# Cek PHP
try {
    $phpVersion = php --version 2>&1
    Write-Host "  [OK] PHP ditemukan: $($phpVersion[0])" -ForegroundColor Green
} catch {
    Write-Host "  [ERROR] PHP tidak ditemukan! Pastikan PHP 8.2+ terinstall dan ada di PATH." -ForegroundColor Red
    Read-Host "Tekan Enter untuk keluar"
    exit 1
}

# Cek Composer (dengan Fallback ke AppData jika tidak ada di PATH)
$composerFound = $false
$localComposer = "$env:APPDATA\Composer\latest.phar"

if (Get-Command composer -ErrorAction SilentlyContinue) {
    $composerFound = $true
    Write-Host "  [OK] Composer ditemukan di PATH." -ForegroundColor Green
} elseif (Test-Path $localComposer) {
    $composerFound = $true
    Write-Host "  [OK] Composer ditemukan (Local Phar): $localComposer" -ForegroundColor Green
} else {
    Write-Host "  [ERROR] Composer tidak ditemukan! Pastikan Composer terinstall." -ForegroundColor Red
    Read-Host "Tekan Enter untuk keluar"
    exit 1
}

# Helper function untuk menjalankan Composer
function Run-Composer {
    param([string]$arguments)
    $localComposer = "$env:APPDATA\Composer\latest.phar"
    if (Get-Command composer -ErrorAction SilentlyContinue) {
        Invoke-Expression "composer $arguments"
    } elseif (Test-Path $localComposer) {
        Invoke-Expression "php `"$localComposer`" $arguments"
    }
}

# Cek Node.js
try {
    $nodeVersion = node --version 2>&1
    Write-Host "  [OK] Node.js ditemukan: $nodeVersion" -ForegroundColor Green
} catch {
    Write-Host "  [WARNING] Node.js tidak ditemukan. Silakan install Node.js nanti untuk Vite/Tailwind." -ForegroundColor Yellow
}

Write-Host ""
Write-Host "[2/6] Mem-backup kode custom Trinova..." -ForegroundColor Yellow

$backupDir = "$env:TEMP\trinova-backup"
if (Test-Path $backupDir) {
    Remove-Item $backupDir -Recurse -Force
}
New-Item -ItemType Directory -Path $backupDir | Out-Null

# List item custom yang perlu di-backup
$customItems = @(
    "app",
    "database",
    "resources",
    "routes",
    "composer.json",
    "package.json",
    "vite.config.js"
)

foreach ($item in $customItems) {
    if (Test-Path $item) {
        Copy-Item -Path $item -Destination $backupDir -Recurse -Force
        Write-Host "  [Backup]: $item" -ForegroundColor Gray
    }
}

Write-Host ""
Write-Host "[3/6] Mengunduh core framework Laravel dari GitHub..." -ForegroundColor Yellow
Write-Host "  (Proses unduh ZIP sangat cepat dibandingkan composer create-project)" -ForegroundColor Gray

# Bikin folder sementara untuk fresh Laravel
$laravelTemp = "$env:TEMP\laravel-fresh"
$zipFile = "$env:TEMP\laravel-master.zip"

if (Test-Path $laravelTemp) {
    Remove-Item $laravelTemp -Recurse -Force
}
if (Test-Path $zipFile) {
    Remove-Item $zipFile -Force
}

# Download fresh Laravel Skeleton ZIP from GitHub
$zipUrl = "https://github.com/laravel/laravel/archive/refs/heads/master.zip"
Write-Host "  Mengunduh: $zipUrl" -ForegroundColor Gray
Invoke-WebRequest -Uri $zipUrl -OutFile $zipFile

# Ekstrak ZIP
Write-Host "  Mengekstrak core files..." -ForegroundColor Gray
Expand-Archive -Path $zipFile -DestinationPath $laravelTemp

# Dapatkan nama folder hasil ekstrak (biasanya laravel-master)
$extractedDir = Join-Path $laravelTemp "laravel-master"
if (!(Test-Path $extractedDir)) {
    $extractedDir = (Get-ChildItem $laravelTemp | Select-Object -First 1).FullName
}

if (!(Test-Path "$extractedDir\artisan")) {
    Write-Host "  [ERROR] Gagal mengunduh dan mengekstrak core Laravel!" -ForegroundColor Red
    Read-Host "Tekan Enter untuk keluar"
    exit 1
}

Write-Host ""
Write-Host "[4/6] Menyalin core files Laravel ke project..." -ForegroundColor Yellow

# Salin semua file dari folder hasil ekstrak kecuali folder kustomisasi kita
$freshItems = Get-ChildItem $extractedDir -Force
foreach ($freshItem in $freshItems) {
    if ($customItems -contains $freshItem.Name) {
        continue
    }
    
    $dest = Join-Path $projectPath $freshItem.Name
    if (Test-Path $dest) {
        Remove-Item $dest -Recurse -Force
    }
    Copy-Item -Path $freshItem.FullName -Destination $dest -Recurse -Force
    Write-Host "  [Core]: $($freshItem.Name)" -ForegroundColor Gray
}

Write-Host ""
Write-Host "[5/6] Mengembalikan dan menggabungkan kode custom..." -ForegroundColor Yellow

# Pindahkan file backup kembali ke project
foreach ($item in $customItems) {
    $src = Join-Path $backupDir $item
    if (Test-Path $src) {
        $dest = Join-Path $projectPath $item
        if (Test-Path $dest) {
            Remove-Item $dest -Recurse -Force
        }
        Copy-Item -Path $src -Destination $dest -Recurse -Force
        Write-Host "  [Restore]: $item" -ForegroundColor Gray
    }
}

# Hapus folder backup dan temp
Remove-Item $backupDir -Recurse -Force -ErrorAction SilentlyContinue
Remove-Item $laravelTemp -Recurse -Force -ErrorAction SilentlyContinue
if (Test-Path $zipFile) {
    Remove-Item $zipFile -Force -ErrorAction SilentlyContinue
}

# Hapus file HTML prototype lama agar tidak mengganggu
$oldHtml = @("index.html", "audit.html", "program.html", "portfolio.html", "blog.html", "kontak.html", "assets")
foreach ($html in $oldHtml) {
    if (Test-Path $html) {
        Remove-Item $html -Recurse -Force -ErrorAction SilentlyContinue
        Write-Host "  [Hapus] File lama: $html" -ForegroundColor Gray
    }
}

Write-Host ""
Write-Host "[6/6] Menjalankan instalasi dependensi (Composer & NPM)..." -ForegroundColor Yellow

# Copy .env jika belum ada
if (!(Test-Path ".env")) {
    if (Test-Path ".env.example") {
        Copy-Item ".env.example" ".env"
        Write-Host "  [Info] Membuat file .env baru dari .env.example" -ForegroundColor Gray
    }
}

# Run composer install
Write-Host "  Menjalankan composer install..." -ForegroundColor Gray
Run-Composer "install --no-interaction"

# Generate key
Write-Host "  Menjalankan php artisan key:generate..." -ForegroundColor Gray
php artisan key:generate

# Run npm install
if (Get-Command npm -ErrorAction SilentlyContinue) {
    Write-Host "  Menjalankan npm install..." -ForegroundColor Gray
    npm install
}

Write-Host ""
Write-Host "============================================" -ForegroundColor Cyan
Write-Host "  SETUP BERHASIL!" -ForegroundColor Green
Write-Host "============================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Silakan jalankan perintah berikut untuk memulai server:" -ForegroundColor White
Write-Host "  1. Buat database di MySQL dengan nama: trinova_digital" -ForegroundColor Gray
Write-Host "  2. Jalankan: php artisan migrate" -ForegroundColor Gray
Write-Host "  3. Jalankan: php artisan serve" -ForegroundColor Gray
Write-Host "  4. Jalankan: npm run dev (di terminal terpisah)" -ForegroundColor Gray
Write-Host ""

Read-Host "Tekan Enter untuk selesai"
