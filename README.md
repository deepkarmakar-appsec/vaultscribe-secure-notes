# 🔐 VaultScribe — Security-Focused Secure Notes Platform

> A production-style Laravel application focused on Application Security, Authentication Hardening, Runtime Monitoring, Infrastructure Security, and DevSecOps automation.

---

## 🌐 Live Demo

🌍 [https://vaultscribe.in](https://vaultscribe.in)

---

# 📌 Overview

VaultScribe is a security-focused secure notes platform built using PHP and Laravel with emphasis on real-world defensive security engineering rather than basic CRUD functionality.

The project explores how modern applications can implement:

* Secure authentication flows
* Multi-layer account protection
* Sensitive data encryption
* Runtime security monitoring
* Centralized logging & observability
* Web application firewall protections
* Infrastructure hardening
* Containerized deployments
* DevSecOps automation pipelines

Instead of treating deployment as the final step, VaultScribe focuses on what happens **after deployment** — monitoring attacks, reducing attack surfaces, detecting suspicious activity, and improving operational visibility.

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

# 🚀 Core Features

## 🔐 Authentication & Account Protection

* Secure user registration
* Secure login system
* Forgot password functionality
* Email OTP verification
* Google Authenticator (TOTP) 2FA
* Session regeneration after login
* Secure logout session cleanup
* Brute-force mitigation using reCAPTCHA
* Login attempt monitoring
* Password reset protection
* OTP expiration & validation

---

## 🔑 Password Security

Implemented password security protections include:

* Argon2id password hashing
* Password peppering
* Weak/common password blacklist validation
* Uppercase requirement
* Lowercase requirement
* Numeric requirement
* Special character enforcement
* Minimum password length validation
* Secure password reset workflows

---

## 🔒 Data Protection

VaultScribe protects sensitive application data using Laravel encryption mechanisms.

### Protected data includes:

* Note titles
* Note descriptions
* 2FA secrets
* Authentication-sensitive values

Additional protections include:

* Hidden sensitive model attributes
* Secure session handling
* Expiring OTP verification system
* Hashed OTP storage

---

## 🧠 Runtime Security & Monitoring

VaultScribe includes runtime activity monitoring for improved attack visibility.

### Logged security events:

* Successful logins
* Failed login attempts
* CAPTCHA triggers
* Password reset failures
* Password reset success events
* Suspicious authentication activity
* Note creation
* Note updates
* Note deletion
* Logout activity

Each event records:

* User ID
* IP address
* User agent
* Action type

---

# 🛡️ Web Security Protections

VaultScribe implements protection against:

* SQL Injection (SQLi)
* Cross-Site Scripting (XSS)
* CSRF attacks
* Clickjacking
* MIME sniffing attacks
* Information disclosure

### Security controls implemented:

* Content Security Policy (CSP)
* HTTP Strict Transport Security (HSTS)
* X-Frame-Options
* X-Content-Type-Options
* Referrer-Policy
* Permissions-Policy
* Cross-Origin-Opener-Policy
* Cross-Origin-Resource-Policy
* Input validation
* Prepared statements
* Blade escaping
* CSRF middleware
* Sanitized production error messages

---

# 🧱 Access Control & Authorization

Security restrictions include:

* Authenticated route protection
* Session-based 2FA enforcement
* Protected dashboard access
* Ownership validation for notes
* Secure route segregation
* Unauthorized route blocking

A user can only access and manage their own notes.

---

# 🧱 Web Application Firewall (WAF)

## ModSecurity + OWASP CRS

VaultScribe integrates ModSecurity with Nginx using the OWASP Core Rule Set (CRS).

### Protection includes:

* SQL Injection detection
* XSS payload blocking
* Malicious request filtering
* Remote code execution payload detection
* Automated exploit blocking
* Request inspection & filtering

The monitoring stack captures real attack traffic and blocked exploit attempts.

---

# ☁️ Infrastructure & Deployment

Infrastructure stack includes:

* Microsoft Azure Virtual Machine
* Ubuntu 24.04 LTS
* Docker containerized deployment
* Nginx reverse proxy
* Cloudflare edge protection
* GitHub Actions CI/CD
* MySQL Docker container

---

# 🐳 Containerized Deployment

Docker is used for:

* Laravel application deployment
* MySQL database container
* Monitoring stack services
* Infrastructure isolation

### Containerized services:

* Laravel Application
* MySQL
* Grafana
* Loki
* Promtail

---

# 🔥 Firewall & SSH Hardening

## UFW Firewall

Configured for:

* HTTP/HTTPS filtering
* Restricted inbound access
* Firewall logging
* Controlled exposed services

---

## Azure NSG

Azure Network Security Groups configured for:

* Restricted network exposure
* Port-based filtering
* Cloud-level traffic control

---

## SSH Hardening

Server SSH protections include:

* Password authentication disabled
* SSH key-based authentication only
* Custom SSH port configuration
* Reduced brute-force attack surface

---

# 🚨 Intrusion Detection & Runtime Security

## Fail2Ban

Automatic banning for:

* SSH brute-force attempts
* Suspicious repeated requests
* Repeated malicious authentication attempts

---

## Falco

Runtime monitoring for:

* Suspicious container activity
* Linux runtime events
* Security anomaly detection
* Real-time threat monitoring

---

## RKHunter

Used for:

* Rootkit detection
* Integrity verification
* Host-level security scanning

---

## Lynis

Linux security auditing configured using scheduled cron jobs.

Used for:

* Automated security auditing
* Linux hardening checks
* Recurring security assessments

---

# 📊 Monitoring, Logging & Observability

Centralized monitoring stack includes:

* Grafana dashboards
* Loki log aggregation
* Promtail log shipping
* Laravel log monitoring
* Nginx request monitoring
* UFW firewall monitoring
* Fail2Ban monitoring
* Runtime security event monitoring

---

# 📈 Monitoring Dashboards

Grafana dashboards include:

* Attack Activity
* Security Alerts
* Email Alerts
* Fail2Ban Active Bans
* Laravel Logs
* Nginx Request Activity
* SSH Brute Force Attempts
* Top Attacking IPs
* UFW Firewall Logs
* Falco Runtime Events
* Lynis Security Audits
* RKHunter Security Events

---

# 📧 Alerting System

Integrated alerting includes:

* Email security alerts
* Runtime security alerts
* Authentication attack alerts
* Firewall event notifications
* Attack activity alerts

Telegram alerting was previously tested during development.

---

# 🔍 Real Attack Visibility

Monitoring stack captures real-world attack attempts including:

* `.git/HEAD` probing
* PHPUnit exploit attempts
* Remote code execution payloads
* Automated exploit scanning
* Bot reconnaissance traffic

This provides visibility into hostile internet traffic targeting the server.

---

# ⚙️ CI/CD & DevSecOps Pipeline

GitHub Actions pipeline includes:

* Automated Laravel testing
* MySQL CI environment
* Docker image build
* Trivy container scanning
* Snyk vulnerability scanning
* GitHub CodeQL analysis
* Gitleaks secret scanning
* SBOM generation
* Deployment health checks
* Rollback workflow support

---

# 🔄 Automation & Maintenance

Automated cron jobs are used for:

* Lynis audits
* Security checks
* Monitoring tasks
* Scheduled maintenance
* Log cleanup

---

# 📦 Log Management & Rotation

Linux log rotation configured for:

* Nginx access logs
* Nginx error logs
* Laravel logs
* UFW logs
* Fail2Ban logs
* Authentication logs

### Benefits:

* Reduced disk usage
* Stable monitoring pipelines
* Long-term log retention
* Continuous observability support

---

# 🛠️ Technology Stack

| Technology         | Usage                    |
| ------------------ | ------------------------ |
| PHP 8.3            | Backend                  |
| Laravel 12         | Framework                |
| MySQL 8            | Database                 |
| Docker             | Containerization         |
| Nginx              | Reverse Proxy            |
| GitHub Actions     | CI/CD                    |
| Trivy              | Container Scanning       |
| Microsoft Azure VM | Cloud Hosting            |
| Ubuntu 24.04       | Server OS                |
| Cloudflare         | Edge Security            |
| Grafana            | Monitoring Dashboard     |
| Loki               | Log Aggregation          |
| Promtail           | Log Collection           |
| Falco              | Runtime Security         |
| Fail2Ban           | Intrusion Prevention     |
| Lynis              | Security Auditing        |
| RKHunter           | Rootkit Detection        |
| ModSecurity        | Web Application Firewall |
| OWASP CRS          | WAF Rule Set             |
| UFW                | Linux Firewall           |
| Azure NSG          | Cloud Network Filtering  |
| Snyk               | Vulnerability Scanning   |
| CodeQL             | Static Security Analysis |
| Gitleaks           | Secret Detection         |

---

# 🧪 Security Philosophy

VaultScribe follows a **Defense-in-Depth** security model using multiple security layers including:

* Cloudflare edge filtering
* Azure NSG filtering
* UFW firewall rules
* Nginx hardening
* ModSecurity WAF
* OWASP CRS rules
* Fail2Ban intrusion prevention
* Falco runtime monitoring
* Secure Laravel middleware
* Centralized monitoring & alerting

---

# ⚙️ Local Development Setup

## 📋 Prerequisites

Make sure the following are installed:

* PHP 8.3+
* Composer
* MySQL 8+
* Node.js & NPM
* Docker & Docker Compose
* Git

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

---

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


![WAF 403](<img width="1904" height="1072" alt="attack block" src="https://github.com/user-attachments/assets/e631b6b1-5533-4a68-80e4-fab8108b2894" />)



### 🚨 Grafana Live Attack Feed


![Grafana Attack](YAHAN_IMAGE_LINK)



### 📧 Real-Time WAF Email Alert (XSS Blocked)


![Email Alert](YAHAN_IMAGE_LINK)



### 🔐 Google Authenticator 2FA Setup


![2FA Setup](YAHAN_IMAGE_LINK)



### 📝 Notes Dashboard


![Dashboard](YAHAN_IMAGE_LINK)



### ⚙️ CI/CD Pipeline (805+ Runs)


![GitHub Actions](YAHAN_IMAGE_LINK)

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

