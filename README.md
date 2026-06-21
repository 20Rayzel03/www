# 📖 Mein Blog / meine persönliche Webseite

Das ist mein persönliches Webseiten- und Blog-Projekt.  
Die Seite ist als moderne, responsive Webseite aufgebaut und läuft bei mir im Homelab auf einem Raspberry Pi bzw. Linux-Server.

Ich nutze die Seite, um mich kurz vorzustellen, Blogbeiträge zu veröffentlichen und kleinere interne Funktionen wie Login, Adminbereich und Aufgabenverwaltung zu testen bzw. weiterzuentwickeln.

Die Webseite ist klassisch mit PHP, CSS und MariaDB/MySQL aufgebaut.  
Der eigentliche öffentliche Webbereich liegt im Ordner `main/`.

---

## 🚀 Projektaufbau

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

## 🏠 Startseite

Die Startseite besteht aus:

- einer modernen Einstiegs-/Hero-Sektion
- einem kurzen Überblick über die Webseite
- einem Teaser zu meiner Bio
- einer Übersicht aktueller Blogbeiträge
- Navigation zu Blog, Bio, Kontakt, Login und weiteren Seiten

Wichtige Dateien:

```text
main/index.php
main/home.php
```

---

## 👤 Bio

Auf der Bio-Seite stelle ich mich kurz vor.  
Dort geht es unter anderem um meinen Werdegang, meine Interessen, Hobbys und Projekte.

Datei:

```text
main/bio.php
```

---

## 📝 Blog

Im Blog veröffentliche ich Beiträge zu Themen, die mich interessieren oder die ich in meinem Homelab umgesetzt habe.

Dazu gehören zum Beispiel Themen rund um:

- Linux
- Homelab
- Serverdienste
- Nextcloud
- Bitwarden
- Reverse Proxy
- VPN
- SSH
- Raspberry Pi
- TrueNAS / Proxmox

Wichtige Dateien:

```text
main/blog.php
main/blog_post.php
main/assets/img/blog/
```

Die Bilder für die Blogbeiträge liegen unter:

```text
main/assets/img/blog/
```

---

## ✉️ Kontakt

Über die Kontaktseite können Nachrichten bzw. Anfragen abgeschickt werden.

Datei:

```text
main/kontakt.php
```

---

## 🔐 Login und Registrierung

Die Webseite besitzt eine einfache Login- und Registrierungsfunktion.

Wichtige Dateien:

```text
main/login.php
main/register.php
main/assets/auth.php
main/assets/footer-login.php
```

Nach dem Login landet man im Dashboard.

---

## 📊 Dashboard und Profil

Nach der Anmeldung gibt es ein Dashboard mit weiteren Funktionen.  
Dazu gehört unter anderem eine Profilseite und je nach Benutzerrolle auch Zugriff auf Adminbereiche.

Wichtige Dateien:

```text
main/dashboard.php
main/profile.php
```

---

## 🛠️ Adminbereich

Der Adminbereich ist für interne Verwaltungsfunktionen gedacht.

Aktuell gibt es unter anderem:

- Verwaltung von Blogbeiträgen
- Übersicht von Anfragen
- einen einfachen Aufgaben-/Kanban-Bereich

Wichtige Dateien:

```text
main/blog_admin.php
main/anfragen.php
main/tasks.php
```

Die Adminseiten sind über die Login-/Adminprüfung geschützt.

---

## ⚖️ Rechtliches

Für die rechtlichen Seiten gibt es eigene Dateien:

```text
main/impressum.php
main/datenschutz.php
```

---

## 🎨 Design und Dateien

Die CSS-Dateien liegen hier:

```text
main/assets/css/
```

Wichtige Stylesheets:

```text
main/assets/css/style.css
main/assets/css/head-foot.css
main/assets/css/home.css
main/assets/css/bio.css
main/assets/css/blog.css
main/assets/css/kontakt.css
main/assets/css/rechtliches.css
```

Favicons und App-Icons liegen direkt im Ordner `main/`.

---

## 🛠️ Installation / Deployment

Ich verwende als Webroot normalerweise:

```text
/var/www/main
```

Das Repository liegt dabei unter:

```text
/var/www
```

Repository klonen:

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

## 🌐 Beispiel für nginx

Der Webserver sollte auf den Ordner `main/` zeigen.

Beispiel:

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

Der PHP-FPM-Socket kann je nach System anders heißen, zum Beispiel:

```text
/run/php/php8.2-fpm.sock
/run/php/php8.3-fpm.sock
/run/php/php8.4-fpm.sock
```

---

## 🧩 Voraussetzungen

Für den Betrieb werden typischerweise benötigt:

- nginx oder Apache
- PHP-FPM
- PHP-MySQL-Erweiterung
- MariaDB/MySQL
- Git

Beispiel für Debian oder Raspberry Pi OS:

```bash
sudo apt update
sudo apt install nginx php-fpm php-mysql mariadb-server git
```

---

## 🗄️ Datenbank

Die Webseite nutzt MariaDB/MySQL für dynamische Funktionen wie:

- Benutzer/Login
- Blogbeiträge
- Kontaktanfragen
- Adminfunktionen
- Aufgabenverwaltung

Zugangsdaten und echte Datenbank-Dumps gehören nicht öffentlich ins Repository.  
Lokale Konfigurationsdateien mit Passwörtern bleiben nur auf dem Server.

---

## ✅ Prüfung nach Änderungen

PHP-Dateien prüfen:

```bash
cd /var/www

for f in $(git ls-files 'main/*.php' 'main/assets/*.php'); do
  php -l "$f" || exit 1
done
```

nginx prüfen und neu laden:

```bash
sudo nginx -t
sudo systemctl reload nginx
```

Lokaler Test:

```bash
curl -I http://127.0.0.1/
curl -I http://127.0.0.1/home.php
curl -I http://127.0.0.1/blog.php
curl -I http://127.0.0.1/login.php
```

---

## 🔐 GitHub Deployment per SSH

Auf dem Server nutze ich am besten einen SSH Deploy Key.

Remote auf SSH setzen:

```bash
git remote set-url origin git@github.com:20Rayzel03/www.git
```

Änderungen pushen:

```bash
cd /var/www
git push origin main
```

---

## 📌 Hinweise für mich

Nicht committen:

- `.bak` Dateien
- Backup-Ordner
- Datenbank-Dumps mit echten Daten
- Zugangsdaten
- temporäre Testdateien
- lokale Editor-/IDE-Dateien

Beispiele:

```text
main.*.bak.*
*.bak*
.vscode/
```
