@echo off
echo Memulai Laravel Dev Server...
start cmd /k "php artisan serve"

echo Memulai Vite Dev Server...
start cmd /k "npm run dev"

echo Kedua server sedang berjalan. Buka http://localhost:8000 di browser Anda.
pause
