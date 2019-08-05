# BeFree
Website Security, Antivirus &amp; Firewall
BeFree is a powerful application that can secure your website against hackers, attacks and other incidents of abuse.
It can protect your site against SQLi Attacks,
Mass Request (Flood), XSS Vulnerabilities, Proxy Visitors, Spammers, Malicious Files (Shells) and many other threats.

It uses intelligent algorithms (similar to those used by large industries) to detect all known and unknown attacks using recognition patterns.

# Features
* SQLi Protection
    Protection against SQLi injections and XSS (Cross-Site Scripting) vulnerabilities.
* Mass Requests Protection
    Protection against mass requests that are made to overload your website.
* Spam Protection
    Protection against spammers and spamming robots that aim to spam your website.
* Proxy Protection
    Protection against visitors by proxy or so-called persons hiding behind proxies.
* Malware Scanner
    Antivirus Scanner that will scan your website for malicious files and will notify you if any are detected.
* Input Sanitization
    Protection module that automatically disinfects all incoming and outgoing requests and responses.
* DNSBL Integration
    Integration with some of the best spam databases (DNSBL) to protect your website from bad visitors.
* Tor Detection
    Detects and blocks visitors who use the Tor browser to hide their identity and to do malicious or suspicious things.
* AdBlocker Detection
    Detects and blocks visitors who use AdBlockers to hide ads on the website.
* Intelligent Pattern Recognition
    Detects attacks and exploits 0'Day
* Industrial-Strength Algorithms
    Detects attacks by known hackers.
* Ban System
    Helps you block and redirect visitors / users (IP addresses), countries, operating systems, browsers, Internet Service Providers (ISPs) and referrers.
* Bad Bots and Crawlers Protection
    Blocks many Bad Bots and Crawlers that will waste bandwidth on your website.
* Fake Bots Protection
    Checking search engine spiders that visit your website, whether real or fake spiders.
* Headers Check
    The response headers of each visitor will be checked and if there are suspicious objects, their access to the site will be denied.
* Real-Time Scanning of All Requests
    GET, POST and other types of data.
* Auto Ban
    Function that automatically blocks attackers and threats such as Bad Bots, Crawlers and others.
* Threat Logs
    Each threat and attack is recorded in the database so you can see them later. (No duplicates)
* Detailed Logs
    The logs contain a lot of information about the threat/attack such as browser, operating system, country, state, city, user agent, location on the map and other useful information.
* IP Lookup
    You can investigate the IP address and check if it is present in the script database.
* E-Mail Notifications
    You will receive an email notification when an attack or threat is detected.
* Website Monitoring
    Track the status of all your websites.
* Dashboard with Stats
    On the dashboard, you can check the statistics for the protection of your website.
* Useful Tools
    On the dashboard, you can check the statistics for the protection of your website.
* Errors Monitoring
    Useful tool that shows all the recorded errors of your website.
* .htaccess Editor
    Edit your.htaccess file directly from the administration panel, no need to open it in an external editor.
* IP Whitelist
    A list of IP addresses that will be ignored by the application and will not be blocked.
* Live Traffic
    Watch your visitors in real time as they interact with your website.
* Visit Analytics
    Track and analyze how people use your website.
* PHP Configuration Checker
    Check the current PHP configuration for security holes.
* Site Information
    Page with a huge amount of information and statistics on your website.
* Very optimized
    The script is very light and will not slow down the loading time of your website.
* Fully reactive
    Looks good on many devices and screen resolutions.
* Easy to install
    The script is integrated into the installation wizard that will help you install the application.
* Easy to use
    Include two lines of code in any main.php file to protect the entire website.
and many others...

# Requirements
* PHP
* MySQL
* Apache

# Installation & Integration

* 1) Create a subfolder on your FTP host or file manager (You can name it as you want)
* 2) Upload the files in the folder *"sources"* in the folder you just created on your ftp server
* 3) Create a MySQL database (Your hosting provider can assist you)
* 4) Go to your browser and navigate to your folder path (For example: *yourdomain.com/yourfolder* )
* 5) The installation wizard will open automatically and just follow the instructions
* 6) Copy the integration code that will appear at the end of the installation
* 7) Paste the integration code in the main files of your project (Example : -*database config (connection) .php; function .php; header .php;*
* 8) Put the integration code copied in a main.php file of your website
(Examples : database configuration file *(connection).php ; functions.php file ; header.php file*; header.php file ; core.php file that is included in all other.php files).

Example of integration code :

```
include_once "befree_folder/config.php" ;
include_once "befree_folder/befree.php";
```
(Change "projectsecurity_folder" with the path on which you installed the product)

To protect multiple websites, you must install BeFree on all websites.

then copy the URL of the path to the Befree project and add it to the website monitoring page at the main Befree installation.

# Sources and credits
Resources used:
* [FontAwesome.com](https://fontawesome.com/) - Font Awesome Icons
* [GetBootstrap.com](https://getbootstrap.com/) - Bootstrap Framework
* [DataTables.com](https://datatables.net/) - Data Tables
* [Jquery.com](https://jquery.com/) - JQuery
* [Github.com/almasaeed2010/AdminLte](https://github.com/almasaeed2010/AdminLTE) - Admin LTE
* [Github.io/Select2](https://select2.github.io/) - Select2
* [Github.com/openlayers/openlayers](https://github.com/openlayers/openlayers) -  Open Layers
* [Chartjs.org](https://www.chartjs.org/) - ChartJS
* [Flagsprites.com](https://www.flag-sprites.com/) - Flag sprites
* [NoUIslider.com](https://refreshless.com/nouislider) - noUIslider
* [Abpetkov.github.io](https://abpetkov.github.io/switchery) - Switchery

# Author

* **Mahid_hm** *Code your freedom* [about me](https://about.me/mahid_hm)
* **bernard-ng** **Create is my passion* [about me](https://bernad-ng.github.com)

## License
This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
