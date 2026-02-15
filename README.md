# VahanAssist - Vehicle Assistance Platform

Welcome to the official repository for VahanAssist. This project consists of an **Angular 17 Frontend** and a **CodeIgniter 3 Backend API**.

---

## 🛠 Prerequisites

Before setting up the project, ensure you have the following installed:
- **Node.js** (v18 or v20 recommended)
- **PHP** (v7.4 or v8.2+)
- **MySQL/MariaDB**
- **Composer** (for PHP dependencies)
- **Angular CLI** (`npm install -g @angular/cli`)

---

## 🚀 Installation & Setup

Follow these steps to get the environment running on your local machine:

### 1. Clone the Repository
```bash
git clone <repository-url>
cd VahanAssist
```

### 2. Frontend Setup (Angular)
```bash
npm install
cp src/environments/environment.ts.example src/environments/environment.ts
```

### 3. Backend Setup (CodeIgniter)
```bash
cd admin
# If composer is used:
composer install
# Setup config files
cp application/config/database.php.example application/config/database.php
cp application/config/config.php.example application/config/config.php
```

### 4. Environment Variables
Copy the root `.env.example` to `.env` and fill in your local database and API keys.
```bash
cp ../.env.example ../.env
```

### 5. Database Setup
1. Create a MySQL database named `vahan_db`.
2. Import the latest SQL dump provided in the `database/` folder (or use `vahaan_export.sql` if provided).

---

## 💻 Development Workflow

### Start Frontend
```bash
ng serve
```
Access at: `http://localhost:4200`

### Start Backend
Ensure your Apache/Nginx server is pointing to the `admin/` directory or use XAMPP/WAMP.

---

## 🏢 Organizational Rules & Best Practices

To maintain high code quality and security, all members must follow these rules:

### 1. Branching Strategy
- **NEVER** push directly to `main`.
- Create feature branches: `feature/your-feature-name`
- Create bugfix branches: `bugfix/issue-description`
- Always pull the latest `main` before starting a new branch.

### 2. Commit Messages
Follow conventional commits:
- `feat: added state dropdown to signup`
- `fix: resolved city selection issue`
- `docs: updated readme with installation steps`

### 3. Security (CRITICAL)
- **DO NOT** commit real passwords, API keys, or database credentials.
- Ensure all sensitive files are listed in `.gitignore`.
- If you accidentally commit a secret, notify the lead developer immediately to rotate the keys.

### 4. Code Reviews
- All code must be submitted via a **Pull Request (PR)**.
- At least one approval from a teammate is required before merging.
- Ensure all linting errors are resolved (`ng lint` if configured).

### 5. Deployment
- Only the deployment lead is authorized to push to the `production` branch.
- Standard builds must be run using `npm run build` with the `--configuration production` flag.

---

## 📄 License
Internal use only for [Organization Name].
