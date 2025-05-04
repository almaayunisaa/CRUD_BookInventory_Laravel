# 📚 Laravel Book & Author Inventory

Sistem CRUD manajemen buku dengan relasi ke penulis. Dibangun dengan Laravel, Bootstrap, DataTables, dan jQuery AJAX.

## ✨ Fitur
- CRUD Data Buku
- Relasi One to Many (Author → Books)
- AJAX Form (tanpa reload)
- DataTables dengan sorting & pencarian
- Validasi server-side

## 🛠️ Teknologi
- Laravel 10
- Bootstrap 5
- jQuery & AJAX
- Yajra Laravel DataTables

## 🚀 Instalasi

```bash
git clone https://github.com/almaayunisaa/CRUD_BookInventory_Laravel.git
cd prak_modul3
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve

## 🧱 Struktur Relasi
- Author → hasMany(Book)
- Book → belongsTo(Author)

## 🧪 Data Dummy

```bash
php artisan db:seed
