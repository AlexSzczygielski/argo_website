# SKR Argo AGH Website
[argo.agh.edu.pl](https://argo.agh.edu.pl)

> 🚨 To repozytorium wykorzystuje CI/CD (automatyczne wysłanie kodu na serwer - aktualizacja strony) po `git push` na branch `main`. Ta funkcjonalność wymaga certyfikatu `.ovpn`, który wygasa co roku, więc co roku wymaga aktualizacji. Certyfikat przechowywany jest w [Github Secrets](https://github.com/AlexSzczygielski/argo_website/settings/secrets/actions) tego repozytorium. Instrukcja aktualizacji certyfikatu znajduje się w punkcie [🔧 CI/CD](#-cicd).

> [Jak dodać nowy post? (click!)](ADD_BLOG_POST.md)

### Project Status
[![Deploy](https://github.com/AlexSzczygielski/argo_website/actions/workflows/deploy_website.yaml/badge.svg)](https://github.com/AlexSzczygielski/argo_website/actions/workflows/deploy_website.yaml)
[![Last commit](https://img.shields.io/github/last-commit/AlexSzczygielski/argo_website)](https://github.com/AlexSzczygielski/argo_website/commits)
[![Repo size](https://img.shields.io/github/repo-size/AlexSzczygielski/argo_website)](https://github.com/AlexSzczygielski/argo_website)
[![Website](https://img.shields.io/website?url=https://argo.agh.edu.pl)](https://argo.agh.edu.pl)

A responsive, PHP-based website for **Studencki Klub Regatowy AGH (Argo)** — a student reagtta club promoting competitive sailing and water sports. This project uses modern frontend and backend technologies to deliver a smooth, interactive user experience.

**✍️ Should the original creator no longer be affiliated with the university, please retain his attribution as the first author of this page. Thank You!**
---

## Table of Contents

- [🔧 CI/CD](#-cicd)  
- [🛠 Setup and Deployment](#-setup-and-deployment)  
- [🚀 Technologies Used](#-technologies-used)  
- [📝 Project Structure](#-project-structure)  
- [🔎 Key Components](#-key-components)  
- [🎨 Styling and Responsiveness](#-styling-and-responsiveness)  
- [Dynamic Navigation Bar](#dynamic-navigation-bar)  
- [Smooth Scrolling](#smooth-scrolling)  
- [🔢Versioning](#-versioning)   

---

## 🔧 CI/CD
Website deployment is automated with Github Actions [deploy_website.yaml](.github/workflows/deploy_website.yaml).
The workflow:
- connects to the AGH internal network via VPN
- securely uploads files using rsync over SSH key authentication
- deploys content to the `public_html` directory

### CI/CD Maintenance
1. **VPN Certificate — stored as `OVPN_CONFIG` in [Github Secrets](https://github.com/AlexSzczygielski/argo_website/settings/secrets/actions). Must be renewed annually by obtaining a new certificate from [panel.agh.edu.pl](https://panel.agh.edu.pl) and pasting its contents into the secret (`cat certificate_name.ovpn`).**
2. **SSH Deploy Key — stored as `ARGO_DEPLOY_KEY_PRIVATE` in [Github Secrets](https://github.com/AlexSzczygielski/argo_website/settings/secrets/actions). The corresponding public key is installed in `~/.ssh/authorized_keys` on the VPS. If deployment fails with an auth error, regenerate the key pair and reinstall following the steps in [🛠 Setup and Deployment](#-setup-and-deployment).**

### CI/CD Workflow Overview
```mermaid
graph TD
    A[Push to main / Manual trigger]:::github --> B[GitHub Actions Workflow]:::pipeline
    
    B --> C[Checkout repository]:::pipeline
    C --> D[Install OpenVPN]:::pipeline
    D --> E[Load VPN config from secrets]:::pipeline
    E --> F[Connect to VPN]:::vpn
    
    F --> G{VPN connected?}:::decision
    G -- No --> X[Fail job]:::error
    G -- Yes --> H[Install rsync]:::pipeline
    
    H --> I[Load SSH deploy key]:::deploy
    I --> J[Run rsync deploy]:::deploy
    J --> K[/Upload files to server/]:::deploy
    
    K --> L{{web.agh.edu.pl}}:::server
    L --> M[/public_html/]:::server
    
    M --> N[Website updated 🎉]:::success

    classDef github fill:#24292e,color:#fff;
    classDef pipeline fill:#2ea44f,color:#fff;
    classDef vpn fill:#6f42c1,color:#fff;
    classDef deploy fill:#0366d6,color:#fff;
    classDef server fill:#d73a49,color:#fff;
    classDef decision fill:#f9c513,color:#000;
    classDef error fill:#d73a49,color:#fff;
    classDef success fill:#28a745,color:#fff;
```

### GH Actions Overview
```mermaid
graph LR
    A[GitHub Repo]:::github --> B[GitHub Actions Runner]:::pipeline
    
    B --> C[Secrets]:::secret
    C --> D1[OVPN_CONFIG]:::secret
    C --> D2[ARGO_DEPLOY_KEY_PRIVATE]:::secret
    
    B --> E[OpenVPN Connection]:::vpn
    E --> F[AGH Internal Network]:::network
    
    F --> G[SSH key + rsync]:::deploy
    G --> H{{web.agh.edu.pl}}:::server
    H --> I[/public_html/]:::server

    classDef github fill:#24292e,color:#fff;
    classDef pipeline fill:#2ea44f,color:#fff;
    classDef vpn fill:#6f42c1,color:#fff;
    classDef deploy fill:#0366d6,color:#fff;
    classDef server fill:#d73a49,color:#fff;
    classDef secret fill:#f66a0a,color:#fff;
    classDef network fill:#1b1f23,color:#fff;
```

---

## 🛠 Setup and Deployment
0. Currently website is auto deployed using CI/CD - please refer to [🔧 CI/CD](#-cicd) section.
1. Open [VPN connection with AGH servers](https://cri.agh.edu.pl/pomoc-it/instrukcje/konfiguracja-polaczenia-vpn).
2. Log into Argo AGH server through SFTP:
```bash
   sftp argo@web.agh.edu.pl
```
   Contact [administrator](https://cri.agh.edu.pl/pomoc-it) or one of the founders (Aleksander Szczygielski) for password access.

   **To set up SSH key authentication** (recommended):
```bash
   # 1. Generate a key pair locally
   ssh-keygen -t ed25519 -C "your-description" -f ~/.ssh/argo_deploy

   # 2. Upload the public key to the server
   cp ~/.ssh/argo_deploy.pub /tmp/authorized_keys
   sftp argo@web.agh.edu.pl
   sftp> put /tmp/authorized_keys .ssh/authorized_keys
   sftp> chmod 600 .ssh/authorized_keys

   # 3. Test the connection (VPN required)
   ssh -i ~/.ssh/argo_deploy argo@web.agh.edu.pl
```

3. Currently web.agh.edu.pl does not grant shell access, so files must be uploaded using `sftp` or `rsync`.
7. *AGH servers automatically redirect to public_html/index.php so be sure that landing page is contained in this path*.
8. Verify Bootstrap, jQuery, and FontAwesome dependencies are accessible in `plugins/` folder or update links accordingly.
11. ‼️ *If styling does not work, give it some time before trying to make fixes, usually it starts to work on its own after a few hours*

## 🚀 Technologies Used

- **PHP** (for server-side templating and dynamic page content)  
- **Bootstrap 5.3** (CSS framework for layout, grid, and components like navbar, carousel)  
- **jQuery 3.7** (DOM manipulation and smooth scrolling animation)  
- **FontAwesome 6** (vector icons for social media links and UI elements)  
- **Google Fonts** (Cinzel, Montserrat, Muli, Inter, Lora) for typography  
- **Custom CSS** for brand styling and transparency effects  

---

## 📝 Project Structure

- `index.php` — Landing page with Jumbotron, About section, and Events carousel  
- `blog/` — Blog posts, should contain only html sections to include in `blog.php`
- `layout/`  
  - `navbar.php` — Dynamic navbar component, loaded on every page  
  - `header.php` — Meta tags, CSS & JS includes, and versioning  
  - `footer.php` — Footer with contact and social icons  
- `css/style.css` — Custom styles, including navbar transparency and scroll effects  
- `plugins/` — Third-party libraries (Bootstrap, jQuery, FontAwesome)  
- `storage/images/` — Static images used throughout the site  

---

## 🔎 Key Components

### Navbar (`layout/navbar.php`)

- Fixed-top, responsive navbar built with Bootstrap 5  
- Adds `navbar-transparent` class dynamically when on the landing page (`index.php`) to show transparent background  
- Changes background on scroll (`scrolled` class toggled with jQuery)  
- Contains smooth scrolling anchor links with offset to prevent overlap from fixed navbar  

### Jumbotron and Sections (`index.php`)

- Large welcome banner using Bootstrap utilities and custom classes  
- Sections with unique IDs for anchor navigation (`#about-anchor`, `#blog-anchor`, etc.)  
- Event carousel showcasing recent and upcoming regatta news using Bootstrap carousel component  

### Footer (`layout/footer.php`)

- Company branding and motto  
- Social media links using FontAwesome icons  
- Responsive layout  

---

## 🎨 Styling and Responsiveness

- Based on Bootstrap’s grid system for responsiveness across devices  
- Custom CSS overrides for branding colors, fonts, and interactive effects  
- Navbar transparency handled via `.navbar-transparent` class on the navbar element itself (see CSS selector `.navbar.navbar-transparent`)  
- Navbar changes background color when scrolled beyond 50px via JavaScript/jQuery  

---

## Dynamic Navigation Bar

- PHP logic removes query parameters to determine active page  
- Applies `.navbar-transparent` class conditionally on landing page only  
- Ensures consistent user experience with colored navbar on internal pages and transparent on the homepage  

---

## Smooth Scrolling

- Implemented using jQuery’s `animate()` to scroll to anchor targets  
- Scroll offset equals navbar height for precise alignment  
- Updates URL hash on animation completion for browser history  

---

## 🔢 Versioning

- Static assets and CSS/JS files include a version query parameter (`?ver=2025.02.04.2`) to enable cache busting  
- `$app_version` variable set in header file for consistent versioning  

---

## 👉 Contributing

- Fork the repo and create feature branches for your changes.  
- Follow existing coding style, especially for PHP templates and CSS.  
- Document new features or changes in your README.  
- Submit pull requests with clear descriptions.
- Keep the style of commenting - especially comment each HTML section and CSS components.  

---

If you have any questions or need help setting up the project, feel free to open an issue!

---

**Created by Aleksander Szczygielski for SKR Argo AGH**  
*Inspired by Ancient Mariners. Driven to Win.*
