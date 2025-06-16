# Laravel Security Demo - Assignment 3: Hacktivist

## 🔐 Security Features Implemented

This Laravel application demonstrates comprehensive security measures including **IDOR (Insecure Direct Object Reference) prevention**, **access control**, and **session hijacking protection** using the **Principle of Least Privilege**.

---

## 🛡️ Security Features Overview

### 1. **IDOR Prevention**
- **Laravel Policies** enforce authorization on all resource access
- Users can **only access their own data** (tasks, profiles)
- **URL tampering is blocked** - attempting to access other users' resources results in 403 Forbidden

### 2. **Access Control & Principle of Least Privilege**
- **Role-based access control** through Laravel Policies
- Users have **minimal necessary permissions**
- **User-scoped data queries** prevent data leakage
- **Authorization checks** on every controller action

### 3. **Session Hijacking Prevention**
- **Secure session configuration**:
  - `HttpOnly` cookies (prevents XSS access)
  - `Secure` cookies (HTTPS only)
  - `SameSite=strict` (prevents CSRF)
- **Session regeneration** on authentication
- **CSRF protection** on all forms

### 4. **Additional Security Measures**
- **Strong password requirements** (12+ chars, mixed case, numbers, symbols)
- **Login rate limiting** (configurable)
- **Password hashing** with bcrypt/Argon2 (rainbow table protection)
- **Email verification** and **password reset** flows

---

## 🧪 Testing IDOR Protection

### **Method 1: Task Access Control**

1. **Register** two different users:
   - User A: `alice@example.com`
   - User B: `bob@example.com`

2. **Login as User A** and create a task:
   - Visit `/tasks/create`
   - Create a task (note the task ID in URL, e.g., `/tasks/1`)

3. **Login as User B** and try to access User A's task:
   - Try to visit `/tasks/1` (should get 403 Forbidden)
   - Try to visit `/tasks/1/edit` (should get 403 Forbidden)
   - Try to visit `/tasks/1/delete` (should get 403 Forbidden)

### **Method 2: User Profile Access Control**

1. **Login as User A** (e.g., User ID 1):
   - Visit `/users/1` (should work - own profile)

2. **Try to access User B's profile**:
   - Visit `/users/2` (should get 403 Forbidden)
   - Visit `/users/3` (should get 403 Forbidden)

3. **The application clearly shows**:
   - Current user ID on profile page
   - Suggested URL to test IDOR attack
   - Security notices explaining the protection

---

## 🔍 Where to Find Security Features

### **1. IDOR Protection Code**
- **Policies**: `app/Policies/TaskPolicy.php` & `app/Policies/UserPolicy.php`
- **Controllers**: `app/Http/Controllers/TaskController.php` & `app/Http/Controllers/UserController.php`
- **Authorization**: All controller methods use `$this->authorize()` calls

### **2. Session Security Configuration**
- **File**: `config/session.php`
- **Settings**: `secure=true`, `http_only=true`, `same_site=strict`

### **3. Access Control Demonstration**
- **User Profiles**: Visit `/users/{id}` to test IDOR protection
- **Task Management**: Visit `/tasks/{id}` to test task access control
- **Security Notices**: Each protected page shows security information

### **4. Password Security**
- **Configuration**: `app/Providers/AppServiceProvider.php`
- **Hashing**: `config/hashing.php` (bcrypt with 12 rounds)
- **Validation**: Enhanced password requirements in registration

---

## 🚀 Quick Start Guide

### **Installation**
```bash
# Clone the repository
git clone [repository-url]
cd laravel_app

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate
php artisan db:seed

# Build assets
npm run build

# Start the application
php artisan serve
```

### **Testing IDOR Protection**
1. **Register** at `/register`
2. **Create tasks** at `/tasks/create`
3. **Visit your profile** at `/users/{your-id}`
4. **Try IDOR attacks**:
   - Change task IDs in URLs
   - Change user IDs in URLs
   - Observe 403 Forbidden responses

---

## 🔐 Security Testing Checklist

### ✅ **IDOR Prevention Tests**
- [ ] Users cannot access other users' tasks
- [ ] Users cannot access other users' profiles
- [ ] URL tampering results in 403 Forbidden
- [ ] Authorization policies are enforced

### ✅ **Session Security Tests**
- [ ] Session cookies are HttpOnly
- [ ] Session cookies are Secure (HTTPS)
- [ ] SameSite attribute is set to strict
- [ ] Session regeneration on login

### ✅ **Access Control Tests**
- [ ] Unauthenticated users redirected to login
- [ ] Users can only see their own data
- [ ] Principle of Least Privilege enforced
- [ ] CSRF protection on forms

---

## 📋 Assignment Requirements Compliance

### ✅ **Required Features**
1. **✅ IDOR Prevention**: Implemented via Laravel Policies
2. **✅ Principle of Least Privilege**: Users have minimal necessary access
3. **✅ Session Hijacking Prevention**: Secure session configuration
4. **✅ Access Control**: Comprehensive authorization system
5. **✅ Hosted Application**: [Your deployment URL here]
6. **✅ GitHub Repository**: [Your repository URL here]

### ✅ **Demonstration Points**
- **IDOR attacks fail** with 403 Forbidden responses
- **Clear security notices** on protected pages
- **Easy testing instructions** for teachers
- **Comprehensive documentation** of security features

---

## 🌐 Live Demo

**Hosted Application**: [Your deployment URL here]

**Test Accounts**:
- Email: `test1@example.com` / Password: `SecurePassword123!`
- Email: `test2@example.com` / Password: `SecurePassword123!`

**Test IDOR Protection**:
1. Login as `test1@example.com`
2. Visit `/users/1` (should work)
3. Visit `/users/2` (should get 403 Forbidden)
4. Create a task and note the ID
5. Login as `test2@example.com`
6. Try to access test1's task (should get 403 Forbidden)

---

## 📝 Security Architecture

```
┌─────────────────┐    ┌──────────────────┐    ┌─────────────────┐
│   User Request  │───▶│  Authentication  │───▶│  Authorization  │
│   (URL Access)  │    │   Middleware     │    │    Policies     │
└─────────────────┘    └──────────────────┘    └─────────────────┘
                                                         │
                              ┌─────────────────────────┘
                              ▼
                    ┌─────────────────┐
                    │  Data Access    │
                    │  (User Scoped)  │
                    └─────────────────┘
```

This architecture ensures that:
1. **Authentication** verifies user identity
2. **Authorization** enforces access control
3. **Data access** is scoped to user ownership
4. **IDOR attacks** are prevented at the policy level

---

## 🎯 Key Security Principles Implemented

1. **Defense in Depth**: Multiple layers of security
2. **Principle of Least Privilege**: Minimal necessary access
3. **Fail Secure**: Deny access by default
4. **Complete Mediation**: Check every access attempt
5. **Separation of Privilege**: Authorization separate from authentication

---

**Assignment 3 Complete** ✅ - This application demonstrates comprehensive security measures suitable for a production environment, with clear IDOR prevention, robust access control, and session hijacking protection.

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
