### 🎓 School Management Backend (Laravel 12)

Minimal multi-tenant school system built with Laravel 12 using a single database architecture.
Supports schools, users, subjects, and a student cart system with proper authorization and validation.

## 📦 Requirements

PHP 8.2+

Composer

MySQL / MariaDB

Laravel 12

Laravel Sanctum

## ⚙️ Setup Instructions
git clone [<repository-url>](https://github.com/AbeerAlsham/school_multi_tenancny_task)
cd task_school
composer install

## Environment
cp .env.example .env
php artisan key:generate

Update .env with your database credentials.

# Database
php artisan migrate --seed


Seeder creates a super admin:

email: admin@admin.com
password: password

# Run Server
php artisan serve


All protected endpoints require authentication using **Laravel Sanctum**.

---

## 🔐 Authentication

| Method | Endpoint  | Description                       |
| ------ | --------- | --------------------------------- |
| POST   | `/login`  | Authenticate user and issue token |
| POST   | `/logout` | Revoke current token              |

---

## 🎒 Cart (Student)

| Method | Endpoint                   | Description                   |
| ------ | -------------------------- | ----------------------------- |
| GET    | `/cart`                    | Retrieve current student cart |
| POST   | `/cart/items/add`          | Add items to cart             |
| PUT    | `/cart/update/{cart_item}` | Update cart item quantity     |
| DELETE | `/cart/remove/{item}`      | Remove item from cart         |

---

## 🏫 Schools

| Method | Endpoint        | Description         |
| ------ | --------------- | ------------------- |
| GET    | `/schools`      | List all schools    |
| POST   | `/schools`      | Create new school   |
| GET    | `/schools/{id}` | Show school details |
| PUT    | `/schools/{id}` | Update school       |
| DELETE | `/schools/{id}` | Delete school       |

---

## 👨‍🎓 Students

**Permission required:** `manage-student`

| Method | Endpoint                     | Description              |
| ------ | ---------------------------- | ------------------------ |
| POST   | `/students`                  | Create student           |
| GET    | `/schools/{school}/students` | List students per school |

---

## 📘 Subjects

**Permission required:** `manage-subject`

| Method | Endpoint                                        | Description               |
| ------ | ----------------------------------------------- | ------------------------- |
| GET    | `/subjects`                                     | List subjects             |
| POST   | `/subjects`                                     | Create subject            |
| GET    | `/subjects/{id}`                                | Show subject              |
| POST   | `/schools/{school}/subjects/{id}/assign-school` | Assign subject to school  |
| POST   | `/subjects/{id}/users/{teacher}/assign-teacher` | Assign teacher to subject |

---

## 👩‍🏫 Teachers

**Permission required:** `manage-teacher`

| Method | Endpoint                                      | Description                |
| ------ | --------------------------------------------- | -------------------------- |
| POST   | `/teachers`                                   | Create teacher             |
| POST   | `/schools/{school}/teachers/{teacher}/assign` | Assign teacher to school   |
| DELETE | `/schools/{school}/teachers/{teacher}/remove` | Remove teacher from school |

---

## 🔒 Authorization Summary

| Permission       | Description     |
| ---------------- | --------------- |
| `manage-student` | Manage students |
| `manage-subject` | Manage subjects |
| `manage-teacher` | Manage teachers |

---

## ⭐ Optional Features Implemented

- Service Layer

- Global Scopes

- Clean API structure

## 🧠 Notes

* Single database multi-tenancy using `school_id`
* Authorization enforced via Gates and Policies
* Student cart operations restricted to student users only
* All endpoints return appropriate HTTP status codes
