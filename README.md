```bash
    docker compose up -d --build
    Aapke project **VaultScribe** ki saari details ko summarize aur organize karke maine ek production-grade, highly professional **README.md** file taiyar kar di hai. Isme proper headings, clean badges, tables, aur code blocks ka use kiya gaya hai taaki aapka GitHub repository ekdum top-notch dikhe.

Aap niche diye gaye pure block ko copy karke apni `README.md` file mein paste kar sakte hain:
```markdown
# 🔐 VaultScribe — Security-Focused Secure Notes Platform

[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![Docker](https://img.shields.io/badge/Docker-Enabled-2496ED?style=for-the-badge&logo=docker)](https://www.docker.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

VaultScribe ek production-style Laravel application hai jo basic CRUD functionalities se hatkar **Application Security, Authentication Hardening, Runtime Monitoring, Infrastructure Security, aur DevSecOps automation** par focus karti hai. Ise internet par hostile traffic aur automated exploit vectors ke khilaf defensive engineering ko test aur implement karne ke liye design kiya gaya hai.

🌐 **Live Demo:** [https://vaultscribe.in](https://vaultscribe.in)

---

## 🏗️ Infrastructure & Security Architecture

VaultScribe **Defense-in-Depth** security model ko follow karta hai jahan request edge se lekar application runtime aur container level tak multiple security layers se guzarti hai:

```text
┌─────────────────────────────────────────────────────────┐
│                       Web Browser                       │
└────────────────────────────┬────────────────────────────┘
                             │
                             ▼
┌─────────────────────────────────────────────────────────┐
│                     Cloudflare Edge                     │
│               (DDoS Protection / SSL WAF)               │
└────────────────────────────┬────────────────────────────┘
                             │
                             ▼
┌─────────────────────────────────────────────────────────┐
│                      Nginx Server                       │
│             (ModSecurity WAF + OWASP CRS)               │
└────────────────────────────┬────────────────────────────┘
                             │
                             ▼
┌─────────────────────────────────────────────────────────┐
│                 Isolated Docker Stack                   │
├─────────────────────────────────────────────────────────┤
│  • Laravel 12 Application (Server-side Encryption)      │
│  • MySQL 8 Database (Hardened Credentials)              │
└────────────────────────────┬────────────────────────────┘
                             │ (Logs & Metrics Shipping)
                             ▼
┌─────────────────────────────────────────────────────────┐
│                Centralized Monitoring Stack             │
├─────────────────────────────────────────────────────────┤
│  • Log Aggregation: Promtail ➔ Loki                     │
│  • Visualization: Grafana Dashboards                    │
│  • Intrusion Prevention: Fail2Ban                       │
│  • Container Runtime Security: Falco                    │
│  • Host Hardening Checks: Lynis & RKHunter              │
└─────────────────────────────────────────────────────────┘

```

---

## 🚀 Core Features

### 🔐 Authentication & Account Protection

* **Multi-Factor Authentication:** Google Authenticator (TOTP) 2FA integration aur Email OTP verification.
* **Brute-Force Mitigation:** Automated login attempt monitoring aur reCAPTCHA integration.
* **Session Security:** Session regeneration immediately after login aur secure session cleanup on logout.
* **Password Protections:** Advanced password reset flows, expiration validations, aur strict OTP validation.

### 🔑 Password Security & Hashing

* **Argon2id Hashing:** Industry-standard password hashing algorithm ka use.
* **Password Peppering:** Database breach hone par bhi plain text passwords ko protect karne ke liye static secret (pepper) application level par enforced hai.
* **Strict Password Policy:** Uppercase, lowercase, numeric, aur special characters ki mandatory requirements ke sath weak/common password blacklist validation.

### 🔒 Data Protection & Cryptography

* **Multi-Layer Encryption:** Application layer par Laravel encryption utilities ka use karke User Note titles, descriptions, aur 2FA secrets ko database mein encrypted store kiya jata hai.
* **Data Masking:** Hidden sensitive model attributes taaki application logs ya API responses mein core secrets leak na ho.

### 🧠 Runtime Security & Observability

* **Audit Logging:** Har critical security event (Successful/Failed Logins, CAPTCHA triggers, Note creations, updates, deletions) ko user ID, IP address, aur User Agent ke sath custom channels par log kiya jata hai.
* **Real Attack Visibility:** ModSecurity aur Nginx ke throug automated bot scanning, `.git/HEAD` probing, aur RCE payload execution attempts ki real-time tracking.

### 🛡️ Web Security Controls

* **Exploit Mitigation:** Custom middleware implementation for Content Security Policy (CSP), HTTP Strict Transport Security (HSTS), X-Frame-Options (Anti-Clickjacking), aur X-Content-Type-Options.
* **Data Sanitization:** Strict input validation, PDO prepared statements for SQLi prevention, aur Laravel Blade XSS escaping engines.

---

## ☁️ Infrastructure & Server Hardening

* **Host Platform:** Microsoft Azure Virtual Machine running Ubuntu 24.04 LTS.
* **Network Firewalls:** Dual layer packet filtering using Azure Network Security Groups (NSG) and Linux UFW.
* **SSH Hardening:** Standard SSH port changed, password authentication disabled, exclusively SSH key-based access permitted.
* **Intrusion Detection (IDS/IPS):**
* **Fail2Ban:** Misbehaving IPs checking and auto-banning for SSH and web abuse.
* **Falco:** System call logs monitoring inside containers for privilege escalation or abnormal activities.
* **Lynis & RKHunter:** Automatic cron-scheduled rootkit checking and kernel hardening health audits.



---

## ⚙️ CI/CD & DevSecOps Automation

VaultScribe repository har code push/pull request par ek deep static aur dynamic analysis pipeline execute karta hai via **GitHub Actions**:

```text
[Code Push] ➔ [Laravel Tests] ➔ [Snyk/Trivy Scans] ➔ [CodeQL SAST] ➔ [Gitleaks] ➔ [Deploy to Azure]

```

* **Static Application Security Testing (SAST):** GitHub CodeQL integration for taint analysis.
* **Secret Scanning:** Gitleaks pre-commit/pipeline testing to catch exposed API tokens.
* **Container Security:** Trivy container vulnerability checks on the base images.
* **Dependency Auditing:** Snyk testing for out-of-date PHP/Node packages with known vulnerabilities.
* **Software Bill of Materials:** Automated SBOM generation for software supply-chain tracking.

---

## 🛠️ Technology Stack

| Component | Technology | Usage |
| --- | --- | --- |
| **Backend** | PHP 8.3 & Laravel 12 | Core MVC application architecture |
| **Database** | MySQL 8 | Relational data persistence layer |
| **Web Server** | Nginx | Reverse proxying & TLS termination |
| **WAF** | ModSecurity + OWASP CRS | Real-time payload inspection & filter |
| **Containerization** | Docker & Docker Compose | Service isolation and orchestration |
| **Cloud Provider** | Microsoft Azure VM | Infrastructure host deployment |
| **CI/CD** | GitHub Actions | Automated build, test & security scan |
| **Log Management** | Promtail & Loki | Log collection and high-speed aggregation |
| **Metrics Engine** | Grafana | Security insight dashboards visualization |
| **Intrusion Prevention** | Fail2Ban & Falco | Server & Container runtime threat detection |
| **Host Auditing** | Lynis & RKHunter | Linux security benchmark scans |
| **Scanners** | Snyk, CodeQL, Gitleaks, Trivy | DevSecOps security scanning matrix |

---

## ⚙️ Local Development Setup

### 📋 Prerequisites

Ensure you have the following installed on your machine:

* PHP 8.3+
* Composer
* Node.js & NPM
* Docker & Docker Compose
* MySQL 8 (If running natively without Docker)

### 📥 Installation Steps

1. **Clone the Repository:**
```bash
git clone https://github.com/your-username/vaultscribe.git
cd vaultscribe

```


2. **Install Composer Dependencies:**
```bash
composer install

```


3. **Environment Configuration:**
```bash
cp .env.example .env

```


*(Note: Configure your database, encryption pepper, and security keys inside `.env`)*
4. **Generate Application Cryptographic Key:**
```bash
php artisan key:generate

```


5. **Run Migrations & Seeders:**
```bash
php artisan migrate --seed

```


6. **Install and Build Frontend Assets:**
```bash
npm install
npm run build

```



### ▶️ Running the Application

* **Using Native Laravel Server:**
```bash
php artisan serve

```


* **Using Docker Architecture:**
```bash
docker compose up -d --build

```



---

## 📸 Dashboards & Screenshots

> *Tip: Replace these placeholders with actual screenshots from your project root folder.*

#### User Dashboard & Encryption Layer

#### Grafana Attack Visibility Matrix

#### Falco Security Runtime Alerts

---

## 🤝 Contributing

Pull requests, feature expansions, and security vulnerability reports are welcome. If you find an edge case or want to extend the WAF/Security definitions, please open an issue or fork the repo.

## 📄 License

This project is open-source software licensed under the **[MIT License](https://www.google.com/search?q=LICENSE)**.

## 👨‍💻 Author

**Deep Karmakar**

* Application Security • Cloud Security • DevSecOps
* [GitHub Profile](https://www.google.com/search?q=https://github.com/your-username)
* [LinkedIn Profile](https://linkedin.com/in/your-profile)

---

> 📌 **Disclaimer:** VaultScribe is a learning-focused defensive engineering project built primarily for research, education, and portfolio showcase. Use it responsibly.

```

```
