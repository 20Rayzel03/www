# 📖 JQPOLLAG.DE – Persönliche Webseite & Homelab-Blog

Dies ist die persönliche Webseite von Julius Pollag mit Bio, Kontaktbereich, Blog, Login-/Registrierungsfunktion und einem kleinen Adminbereich.

Die Seite läuft als klassische PHP-Webseite mit MariaDB-Anbindung und wird im Homelab auf einem Raspberry Pi bzw. Linux-Host betrieben.  
Der öffentliche Einstiegspunkt ist der Ordner `main/`.

---

## 🚀 Aktueller Projektaufbau

```text
/var/www
├── README.md
└── main/
    ├── index.php
    ├── home.php
    ├── bio.php
    ├── blog.php
    ├── blog_post.php
    ├── kontakt.php
    ├── login.php
    ├── register.php
    ├── dashboard.php
    ├── profile.php
    ├── blog_admin.php
    ├── tasks.php
    ├── anfragen.php
    ├── impressum.php
    ├── datenschutz.php
    ├── assets/
    │   ├── header.php
    │   ├── footer.php
    │   ├── footer-login.php
    │   ├── sozial.php
    │   ├── auth.php
    │   ├── css/
    │   └── img/blog/
    ├── favicon.ico
    ├── favicon.png
    ├── favicon-16x16.png
    ├── favicon-32x32.png
    ├── apple-touch-icon.png
    └── site-icon.png
```

---

## ⚛️ Seitenbereiche

### Startseite

Dateien:

- `main/index.php`
- `main/home.php`

Die Startseite enthält:

- moderne Hero-/Intro-Sektion
- Teaser zur Bio-Seite
- Übersicht aktueller Blogbeiträge
- Navigation zu Blog, Bio, Kontakt, Login und weiteren Seiten

---

### Bio

Datei:

- `main/bio.php`

Die Bio-Seite enthält persönliche Informationen, Werdegang, Interessen, Hobbys und Links zu sozialen Medien.

---

### Blog

Dateien:

- `main/blog.php`
- `main/blog_post.php`
- `main/assets/img/blog/`

Der Blog zeigt veröffentlichte Beiträge mit eigenen SVG-Titelbildern.  
Einzelne Beiträge sind über `blog_post.php` erreichbar.

Die Blogbilder liegen unter:

```text
main/assets/img/blog/
```

---

### Kontakt

Datei:

- `main/kontakt.php`

Enthält ein Kontaktformular für Anfragen/Nachrichten.

---

### Login & Registrierung

Dateien:

- `main/login.php`
- `main/register.php`
- `main/assets/auth.php`
- `main/assets/footer-login.php`

Funktionen:

- Benutzerregistrierung
- Login
- Session-basierte Anmeldung
- gemeinsamer Auth-Helper über `assets/auth.php`

---

### Dashboard & Profil

Dateien:

- `main/dashboard.php`
- `main/profile.php`

Nach dem Login gelangt der Benutzer ins Dashboard.  
Dort gibt es unter anderem Zugriff auf Profil-/Accountfunktionen und – je nach Rolle – Adminbereiche.

---

### Adminbereich

Dateien:

- `main/blog_admin.php`
- `main/tasks.php`
- `main/anfragen.php`

Adminfunktionen:

- Blogbeiträge verwalten
- Anfragen einsehen
- Aufgaben-/Kanban-ähnlicher Bereich für interne Verwaltung

Adminseiten sind über die Auth-/Adminprüfung geschützt.

---

### Rechtliches

Dateien:

- `main/impressum.php`
- `main/datenschutz.php`

Enthält Impressum und Datenschutzerklärung.

---

## 🎨 Design & Assets

CSS-Dateien liegen unter:

```text
main/assets/css/
```

Wichtige Stylesheets:

- `style.css`
- `head-foot.css`
- `home.css`
- `bio.css`
- `blog.css`
- `kontakt.css`
- `rechtliches.css`

Favicons und App-Icons liegen direkt unter `main/`.

---

## 🛠️ Installation / Deployment

### Repository klonen

Empfohlener Pfad auf dem Webserver:

```bash
cd /var
git clone git@github.com:20Rayzel03/www.git www
cd /var/www
```

Alternativ per HTTPS:

```bash
cd /var
git clone https://github.com/20Rayzel03/www.git www
cd /var/www
```

---

## 🌐 Webserver-Konfiguration

Der Webserver sollte auf folgenden Document Root zeigen:

```text
/var/www/main
```

Beispiel für nginx:

```nginx
server {
    listen 80;
    server_name _;

    root /var/www/main;
    index index.php home.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php-fpm.sock;
    }
}
```

Je nach Distribution kann der PHP-FPM-Socket anders heißen, zum Beispiel:

```text
/run/php/php8.2-fpm.sock
/run/php/php8.3-fpm.sock
/run/php/php8.4-fpm.sock
```

---

## 🧩 Voraussetzungen

Benötigt werden typischerweise:

- nginx oder Apache
- PHP-FPM
- PHP MySQL/MariaDB Erweiterung
- MariaDB/MySQL
- Git

Beispiel Debian/Raspberry Pi OS:

```bash
sudo apt update
sudo apt install nginx php-fpm php-mysql mariadb-server git
```

---

## 🗄️ Datenbank

Die Webseite nutzt MariaDB/MySQL für dynamische Bereiche wie:

- Benutzer/Login
- Blogbeiträge
- Kontaktanfragen
- Admin-/Aufgabenfunktionen

Datenbank-Zugangsdaten gehören **nicht öffentlich ins Repository**.  
Lokale Konfigurationen mit Passwörtern sollten nur auf dem Server liegen und nicht committed werden.

---

## ✅ Prüfung nach Änderungen

PHP-Syntax prüfen:

```bash
cd /var/www

for f in $(git ls-files 'main/*.php' 'main/assets/*.php'); do
  php -l "$f" || exit 1
done
```

nginx prüfen:

```bash
sudo nginx -t
sudo systemctl reload nginx
```

Lokaler HTTP-Test:

```bash
curl -I http://127.0.0.1/
curl -I http://127.0.0.1/home.php
curl -I http://127.0.0.1/blog.php
curl -I http://127.0.0.1/login.php
```

---

## 🔐 GitHub Deployment per SSH

Auf dem Server wird idealerweise ein Deploy Key verwendet:

```bash
git remote set-url origin git@github.com:20Rayzel03/www.git
```

Push:

```bash
cd /var/www
git push origin main
```

---

## 📌 Hinweise

Nicht committen:

- `.bak` Dateien
- Backup-Ordner
- Datenbank-Dumps mit echten Benutzerdaten
- Zugangsdaten
- temporäre Testdateien

Beispiele für lokale Backups, die nicht ins Repo gehören:

```text
main.*.bak.*
*.bak*
```
