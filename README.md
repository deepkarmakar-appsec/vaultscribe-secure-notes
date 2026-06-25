<div align="center">

# 🛡️ VaultScribe

### Secure Notes Platform • Application Security • DevSecOps • Cloud Security

*Production-Oriented Secure Notes Application built using Laravel, Azure, Docker, Security Engineering, Threat Modeling, and Defense-in-Depth Principles.*

<br>

<img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
<img src="https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white">
<img src="https://img.shields.io/badge/MySQL-8-4479A1?style=for-the-badge&logo=mysql&logoColor=white">
<img src="https://img.shields.io/badge/Docker-Enabled-2496ED?style=for-the-badge&logo=docker&logoColor=white">
<img src="https://img.shields.io/badge/Azure-Deployed-0078D4?style=for-the-badge&logo=microsoftazure&logoColor=white">
<img src="https://img.shields.io/badge/Security-First-success?style=for-the-badge">
<img src="https://img.shields.io/badge/DevSecOps-Automated-blue?style=for-the-badge">

<br><br>

🔐 Security-First Architecture
🚀 Automated DevSecOps Pipeline
📊 Monitoring & Detection Stack
☁️ Azure Cloud Deployment

</div>

---

# 📌 Overview

VaultScribe is a security-focused notes management platform designed to demonstrate real-world Application Security, DevSecOps, Cloud Security, Secure Coding, Infrastructure Hardening, Monitoring, and Defense-in-Depth practices.

The project integrates secure authentication, encrypted note storage, secure file uploads, role-based access control, audit logging, security monitoring, cloud deployment, and automated security testing into a production-style environment.

---

# 🎯 Project Goals

* Secure Authentication & Authorization
* Encrypted Data Storage
* Secure Session Management
* Secure File Upload Handling
* SSRF Protection
* Security Monitoring & Logging
* Infrastructure Hardening
* Cloud Deployment
* Automated Security Testing
* DevSecOps Automation
* Security Documentation
* Threat Modeling

---

# 🏗️ Architecture

```text
Users
 │
 ▼
Cloudflare
 │
 ▼
Cloudflare WAF
 │
 ▼
Nginx Reverse Proxy
 │
 ▼
Laravel Application
 │
 ├── Authentication
 ├── Authorization
 ├── Notes Module
 ├── Upload Module
 ├── AI Features
 ├── Admin Panel
 ├── Security Logs
 └── Audit Trail
 │
 ▼
MySQL Database
```

---

# 📸 Screenshots

## Authentication

![Login](https://github.com/user-attachments/assets/a14418c7-0931-4d30-886e-2b172d63f723)
---

## User Dashboard

![Dashboard](https://github.com/user-attachments/assets/fb676f92-f3e2-4c21-9a90-92b3e264ce69)
---

## Admin Panel

![Admin Dashboard](https://github.com/user-attachments/assets/81339ad4-db17-40f3-a62c-cd0a766346ef)
---
## Security Monitoring

![Grafana](https://github.com/user-attachments/assets/a4cd2cb2-9821-463d-a139-62cfe297f827)
---
### Additional Screenshots

```text
screenshots/
├── login.png
├── register.png
├── otp-verification.png
├── forgot-password.png
├── reset-password.png
├── dashboard.png
├── upload.png
├── 2fa-setup.png
├── 2fa-challenge.png
├── admin-dashboard.png
├── admin-users.png
├── admin-user-details.png
├── admin-notes.png
├── admin-logs.png
├── admin-settings.png
└── grafana.png
```

---

# ⚔️ Attack Coverage

* SQL Injection
* Cross-Site Scripting (XSS)
* Cross-Site Request Forgery (CSRF)
* Insecure Direct Object Reference (IDOR)
* Broken Access Control
* Privilege Escalation
* Session Hijacking
* Malicious File Upload
* Information Disclosure
* Server-Side Request Forgery (SSRF)

# 🔐 Authentication & Identity Security

## Authentication

* User Registration
* User Login
* Logout
* Email OTP Verification
* OTP Verification Page
* OTP Expiration
* OTP Attempt Validation
* Forgot Password
* Password Reset
* Password Reset Token

## Password Security

* Argon2id Password Hashing
* Pepper Hardening
* Password Complexity Validation
* Weak Password Detection

## Multi-Factor Authentication

* Google Authenticator Integration
* TOTP 2FA
* QR Code Setup
* Manual Secret Key Setup
* Enable 2FA
* Disable 2FA
* 2FA Challenge Screen
* 6-Digit OTP Validation
* Auth + 2FA Protected Routes

## Bot Protection

* Google reCAPTCHA
* Login CAPTCHA Protection
* Password Reset CAPTCHA

---

# 🛡️ Session Security

* Session Regeneration
* File-Based Session Storage
* Session Expiration Control
* HttpOnly Cookies
* SameSite Cookies
* Secure Cookie Support

---

# 🔑 Authorization & Access Control

* Role Based Access Control (RBAC)
* Admin Role
* User Role
* Admin Middleware
* Authentication Middleware
* 2FA Middleware
* Ownership Validation
* Protected Dashboard Access
* Protected Upload Access

---

# 📝 Notes Management

* Create Notes
* Edit Notes
* Update Notes
* Delete Notes
* Trash Notes
* Restore Notes
* Restore All Notes
* Permanent Delete
* Permanent Delete All
* Dashboard Notes View

---

# 🔒 Data Protection

## Encryption

* AES Encrypted Notes
* Encrypted 2FA Secrets

## Secure Data Handling

* Hidden Sensitive Fields
* Soft Delete Support

---

# 📁 Secure File Upload System

## Upload Features

* Secure File Upload Module
* Authenticated Upload Access
* Private Avatar Serving
* Private Storage

## Validation Controls

* MIME Validation
* Extension Validation
* File Size Validation
* Image Validation

## Upload Security

* Image Re-Encoding
* UUID File Naming
* Upload Rate Limiting (10/minute)
* ClamAV Scanning

---

# 🌐 SSRF Protection

* URL Validation
* Protocol Validation
* Internal IP Blocking
* Private Network Blocking
* Metadata Endpoint Blocking
* DNS Validation
* SSRF Event Logging

---

# 🤖 AI Features

* AI Summary Generation
* Gemini 2.5 Flash Integration

---

# 🛡️ Security Headers

* Content Security Policy (CSP)
* HTTP Strict Transport Security (HSTS)
* X-Frame-Options
* X-Content-Type-Options
* Referrer Policy
* Permissions Policy
* COOP
* CORP

---

# 🚦 Anti-Abuse Controls

* Login Rate Limiting (5/minute)
* Upload Rate Limiting (10/minute)
* CAPTCHA Protection
* Password Reset CAPTCHA

---

# 📊 Monitoring & Audit Logging

## Infrastructure Monitoring

* Laravel Application Logs
* Nginx Access Logs
* Nginx Error Logs
* SSH Authentication Logs
* UFW Firewall Logs
* Fail2Ban Events
* Falco Runtime Events
* Loki Log Aggregation
* Grafana Dashboards

## Application Activity Logs

* User Registration Events
* Login Success / Failure
* Logout Events
* Password Reset Events
* OTP Verification Events
* MFA Enable / Disable Events
* Note Create / Update / Delete Events
* File Upload Events
* User Activity Tracking

## Security Events

* Unauthorized Access Attempts
* RBAC Permission Denied Events
* Ownership Validation Failures
* SSRF Event Logging
* Rate Limit Events
* Session Security Events
* IP Address Logging
* Audit Trail

---

# 👑 Admin Panel

## Administration

* Admin Dashboard
* User Management
* User Details Page
* User Activity View
* User Note View
* 2FA Status Monitoring

## Security Controls

* Security Logs Dashboard
* Security Alert Threshold Setting
* Security Log Controls
* Production Mode Setting
* Development Mode Setting

---

# ☁️ Infrastructure & Deployment

## Cloud Infrastructure

* Azure Virtual Machine
* Cloudflare
* Cloudflare WAF

## Application Stack

* Laravel 12
* PHP 8.3
* MySQL 8
* Nginx Reverse Proxy

## Docker Containers

* Laravel Application Container
* MySQL Database Container

## Host Security

* ModSecurity + OWASP CRS
* UFW Firewall
* Fail2Ban
* ClamAV
* Lynis
* RKHunter
* Chkrootkit
* Log Rotation
* Cron Jobs

---

# 📈 Monitoring Stack

| Tool     | Purpose                     |
| -------- | --------------------------- |
| Grafana  | Dashboards & Visualization  |
| Loki     | Log Aggregation             |
| Promtail | Log Collection              |
| Falco    | Runtime Security Monitoring |

---

# 🚀 DevSecOps Pipeline

## CI/CD

* GitHub Actions
* Automated Build
* Automated Testing
* Automated Azure Deployment
* Rollback Workflow

## Security Testing

* Laravel Pint
* Semgrep SAST
* Snyk SCA
* Trivy Scan
* OWASP ZAP DAST
* Gitleaks Secret Scanning

## Supply Chain Security

* SBOM Generation

---

# 📚 Documentation

```text
docs/
├── architecture.md
├── threat-model.md
├── security-controls.md
├── deployment.md
├── devsecops-pipeline.md
└── secure-vs-vulnerable.md
```

---

# 🔬 Security Research Reports

```text
reports/
├── sqli.md
└── xss.md
└── brokenaccesscontroll.md
└── idor.md
├── ssrf.md
└── massassingment.md
```

---

# 🖥️ Application Pages

## User Pages

* Login Page
* Register Page
* OTP Verification Page
* Forgot Password Page
* Reset Password Page
* Dashboard Page
* File Upload Page
* 2FA Setup Page
* 2FA Challenge Page

## Admin Pages

* Admin Dashboard
* Admin Users Page
* Admin User Details Page
* Admin Notes Page
* Admin Logs Page
* Admin Settings Page

---

# ⭐ Security Areas Demonstrated

* Authentication Security
* Session Security
* Authorization
* Access Control
* Encryption
* Secure File Uploads
* SSRF Protection
* Logging & Monitoring
* Infrastructure Hardening
* Cloud Security
* DevSecOps
* Threat Modeling
* Security Documentation

---

# 🌐 Live Deployment

* URL: https://vaultscribe.in
* Cloudflare Protected
* Azure Hosted
* HTTPS Enabled

# 👨‍💻 Author

## Deep Karmakar

Application Security • DevSecOps • Cloud Security

> Security is not a feature. Security is an engineering discipline.

### Connect

* GitHub: https://github.com/deepkarmakar-appsec
* LinkedIn: https://linkedin.com/in/deepkarmakar-appsec

---

<div align="center">

### ⭐ If you found this project useful, consider giving it a star.

</div>
