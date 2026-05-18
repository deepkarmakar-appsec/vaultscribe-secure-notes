# 🔐 VaultScribe — Security-Focused Secure Notes Platform

> Production-style Laravel application focused on Application Security, Infrastructure Hardening, Runtime Monitoring, and DevSecOps automation.

---

## 🌐 Live Demo

🌍 https://vaultscribe.in

---

## 🔥 Security Highlights

- ModSecurity + OWASP CRS WAF protection against SQLi, XSS, RCE, and path traversal attacks
- Real-time attack monitoring using Grafana, Loki, Promtail, and Falco
- Automated intrusion prevention using Fail2Ban
- Defense-in-depth architecture using Cloudflare, Azure NSG, UFW, and hardened Nginx
- CI/CD security pipeline with Trivy, Snyk, CodeQL, Gitleaks, and SBOM generation
- Centralized logging and alerting for authentication events and blocked attack traffic

---

# 📌 Overview

VaultScribe is a security-focused secure notes platform built using PHP and Laravel with emphasis on real-world defensive security engineering rather than basic CRUD functionality.

Instead of treating deployment as the final step, VaultScribe focuses on:

- Monitoring attack activity
- Reducing attack surfaces
- Detecting suspicious behavior
- Improving operational visibility
- Automating security workflows

---

# 🏗️ Infrastructure & Security Architecture

```text
┌────────────┐
│   Browser  │
└─────┬──────┘
      │
      ▼
┌────────────┐
│ Cloudflare │
│ DDoS / SSL │
└─────┬──────┘
      │
      ▼
┌────────────┐
│   Nginx    │
│ ModSecurity│
│ OWASP CRS  │
└─────┬──────┘
      │
      ▼
┌─────────────────────────────┐
│        Docker Stack         │
├─────────────────────────────┤
│ Laravel Application         │
│ MySQL Database              │
│ Server-side Encryption      │
└─────────────┬───────────────┘
              │
              ▼
┌─────────────────────────────┐
│      Monitoring Stack       │
├─────────────────────────────┤
│ Grafana                     │
│ Loki                        │
│ Promtail                    │
│ Fail2Ban                    │
│ Falco                       │
│ Lynis                       │
│ RKHunter                    │
│ Email Alerts                │
└─────────────────────────────┘
```

---

# 🚀 Core Security Features

## 🔐 Authentication & Account Protection

- Secure user registration & login
- Email OTP verification
- Google Authenticator (TOTP) 2FA
- Session regeneration after login
- Secure logout session cleanup
- reCAPTCHA brute-force mitigation
- Login attempt monitoring
- OTP expiration & validation
- Secure password reset workflows

---

## 🔑 Password Security

- Argon2id password hashing
- Password peppering
- Weak/common password blacklist validation
- Strong password policy enforcement
- Secure password reset protections

---

## 🔒 Data Protection

Sensitive note data and authentication-related secrets are encrypted server-side using Laravel encryption mechanisms.

Protected data includes:

- Note titles
- Note descriptions
- 2FA secrets
- Authentication-sensitive values

Additional protections include:

- Hidden sensitive model attributes
- Secure session handling
- Hashed OTP storage
- Expiring OTP verification system

---

# 🛡️ Security Controls

VaultScribe implements layered protections against:

- SQL Injection (SQLi)
- Cross-Site Scripting (XSS)
- CSRF attacks
- Clickjacking
- MIME sniffing
- Information disclosure

Security controls include:

- Content Security Policy (CSP)
- HTTP Strict Transport Security (HSTS)
- X-Frame-Options
- X-Content-Type-Options
- Referrer-Policy
- Permissions-Policy
- Prepared statements
- Blade escaping
- CSRF middleware
- Sanitized production error messages

---

# 🎯 Real-World Attack Visibility

VaultScribe captures and monitors live hostile traffic targeting the server including:

- SQL injection probes
- XSS payload attempts
- Path traversal attacks
- Bot reconnaissance traffic
- Automated exploit scanning
- `.git/HEAD` probing
- PHPUnit exploit attempts

Blocked attack traffic is visualized through Grafana dashboards and alerting pipelines for operational visibility.

---

# 🚨 Detection & Monitoring Stack

## Monitoring & Observability

Centralized monitoring stack includes:

- Grafana dashboards
- Loki log aggregation
- Promtail log shipping
- Laravel log monitoring
- Nginx request monitoring
- UFW firewall monitoring
- Fail2Ban monitoring
- Runtime security event monitoring

---

## Runtime Security & Intrusion Detection

### Fail2Ban

Automatic banning for:

- SSH brute-force attempts
- Repeated malicious authentication attempts
- Suspicious repeated requests

### Falco

Runtime monitoring for:

- Suspicious container activity
- Linux runtime events
- Security anomaly detection
- Real-time threat monitoring

### RKHunter

- Rootkit detection
- Integrity verification
- Host-level security scanning

### Lynis

Automated Linux security auditing for:

- Hardening checks
- Security assessments
- Scheduled audits

---

# 📧 Alerting System

Integrated alerting includes:

- Email security alerts
- Authentication attack alerts
- Firewall event notifications
- Runtime security alerts
- Attack activity alerts

Telegram alerting was previously tested during development.

---

# ☁️ Infrastructure & Deployment

Infrastructure stack includes:

- Microsoft Azure Virtual Machine
- Ubuntu 24.04 LTS
- Docker containerized deployment
- Nginx reverse proxy
- Cloudflare edge protection
- GitHub Actions CI/CD
- MySQL Docker container

---

# 🔥 Firewall & SSH Hardening

## UFW Firewall

- HTTP/HTTPS filtering
- Restricted inbound access
- Firewall logging
- Controlled exposed services

## Azure NSG

- Restricted network exposure
- Port-based filtering
- Cloud-level traffic control

## SSH Hardening

- Password authentication disabled
- SSH key-based authentication only
- Custom SSH port configuration
- Reduced brute-force attack surface

---

# ⚙️ CI/CD & DevSecOps Pipeline

GitHub Actions pipeline includes:

- Automated Laravel testing
- MySQL CI environment
- Docker image build
- Trivy container scanning
- Snyk vulnerability scanning
- GitHub CodeQL analysis
- Gitleaks secret scanning
- SBOM generation
- Deployment health checks
- Rollback workflow support

---

# 📦 Log Management & Rotation

Linux log rotation configured for:

- Nginx access logs
- Nginx error logs
- Laravel logs
- UFW logs
- Fail2Ban logs
- Authentication logs

Benefits include:

- Reduced disk usage
- Stable monitoring pipelines
- Long-term log retention
- Continuous observability support

---

# 🛠️ Technology Stack

| Technology | Usage |
|---|---|
| PHP 8.3 | Backend |
| Laravel 12 | Framework |
| MySQL 8 | Database |
| Docker | Containerization |
| Nginx | Reverse Proxy |
| GitHub Actions | CI/CD |
| Trivy | Container Scanning |
| Microsoft Azure VM | Cloud Hosting |
| Ubuntu 24.04 | Server OS |
| Cloudflare | Edge Security |
| Grafana | Monitoring Dashboard |
| Loki | Log Aggregation |
| Promtail | Log Collection |
| Falco | Runtime Security |
| Fail2Ban | Intrusion Prevention |
| Lynis | Security Auditing |
| RKHunter | Rootkit Detection |
| ModSecurity | Web Application Firewall |
| OWASP CRS | WAF Rule Set |
| UFW | Linux Firewall |
| Azure NSG | Cloud Network Filtering |
| Snyk | Vulnerability Scanning |
| CodeQL | Static Security Analysis |
| Gitleaks | Secret Detection |

---

# 🧪 Security Philosophy

VaultScribe follows a Defense-in-Depth security model using multiple security layers including:

- Cloudflare edge filtering
- Azure NSG filtering
- UFW firewall rules
- Nginx hardening
- ModSecurity WAF
- OWASP CRS rules
- Fail2Ban intrusion prevention
- Falco runtime monitoring
- Secure Laravel middleware
- Centralized monitoring & alerting

---

# ⚙️ Local Development Setup

## 📋 Prerequisites

Make sure the following are installed:

- PHP 8.3+
- Composer
- MySQL 8+
- Node.js & NPM
- Docker & Docker Compose
- Git

---

# 📥 Installation

```bash
# Clone repository
git clone https://github.com/deepkarmakar-appsec/vaultscribe-secure-notes.git

# Enter project directory
cd vaultscribe-secure-notes

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate
```

---

# ▶️ Running the Application

## Laravel Development Server

```bash
php artisan serve
```

## Docker Deployment

```bash
docker compose up -d --build
```

---

# 🧪 Development Workflow

1. Local development using Laravel Herd
2. Local testing & validation
3. Push changes to GitHub
4. CI/CD pipeline execution
5. Docker image build
6. Security scanning
7. Deployment to Azure VM
8. Monitoring & runtime analysis

---

# 📸 Screenshots

### 🛡️ WAF Blocking Path Traversal (/etc/passwd)

<img width="1904" height="1072" alt="WAF Blocking Path Traversal" src="https://github.com/user-attachments/assets/e631b6b1-5533-4a68-80e4-fab8108b2894" />

### 🚨 Grafana Live Attack Feed

<img width="1916" height="1070" alt="Grafana Live Attack Feed" src="https://github.com/user-attachments/assets/16f957fd-7af3-4730-a7d8-d3923694f84c" />

### 📧 Real-Time WAF Email Alert (XSS Blocked)

<img width="1080" height="2082" alt="Real-Time WAF Email Alert" src="https://github.com/user-attachments/assets/8ec1ebf1-ee4d-4da5-8312-33f64c15d6a2" />

### 🔐 Google Authenticator 2FA Setup

<img width="1857" height="913" alt="Google Authenticator 2FA Setup" src="https://github.com/user-attachments/assets/633e32bb-e013-49bb-91b4-31e170704b60" />

### 📝 Notes Dashboard

<img width="1902" height="905" alt="Notes Dashboard" src="https://github.com/user-attachments/assets/0505178a-da73-4bae-9f56-e00348ddf619" />

### ⚙️ CI/CD Pipeline

<img width="1763" height="1992" alt="CI/CD Pipeline" src="https://github.com/user-attachments/assets/ac6d5bcc-e219-4587-9e40-d1edf483e5e3" />

---

# 🤝 Contributing

Pull requests and security improvements are welcome.

If you discover vulnerabilities or want to improve the security architecture, contributions are appreciated.

---

# 📄 License

Licensed under the MIT License.

---

# 👨‍💻 Author

**Deep Karmakar**  
Application Security • Cloud Security • DevSecOps

---

# 📌 Disclaimer

VaultScribe is a learning-focused security engineering project built for educational and portfolio purposes to explore secure application design and defensive security practices.
