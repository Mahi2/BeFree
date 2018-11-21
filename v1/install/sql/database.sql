DROP TABLE IF EXISTS `<DB_PREFIX>adblocker-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>badbot-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>bans`;
DROP TABLE IF EXISTS `<DB_PREFIX>bans-country`;
DROP TABLE IF EXISTS `<DB_PREFIX>bans-other`;
DROP TABLE IF EXISTS `<DB_PREFIX>content-protection`;
DROP TABLE IF EXISTS `<DB_PREFIX>dnsbl-databases`;
DROP TABLE IF EXISTS `<DB_PREFIX>ip-whitelist`;
DROP TABLE IF EXISTS `<DB_PREFIX>live-traffic`;
DROP TABLE IF EXISTS `<DB_PREFIX>logins`;
DROP TABLE IF EXISTS `<DB_PREFIX>logs`;
DROP TABLE IF EXISTS `<DB_PREFIX>malwarescanner-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>massrequests-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>monitoring`;
DROP TABLE IF EXISTS `<DB_PREFIX>pages-layolt`;
DROP TABLE IF EXISTS `<DB_PREFIX>proxy-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>spam-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>sqli-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>tor-settings`;
DROP TABLE IF EXISTS `<DB_PREFIX>users`;

-- --------------------------------------------------------

CREATE TABLE `<DB_PREFIX>adblocker-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `detection` tinyint(1) NOT NULL DEFAULT '0',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pages/adblocker-detected.php'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>adblocker-settings` (`id`, `detection`, `redirect`) VALUES
(1, 0, '<PROJECTSECURITY_PATH>/pages/adblocker-detected.php');

-- --------------------------------------------------------

CREATE TABLE `<DB_PREFIX>badbot-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `protection` tinyint(1) NOT NULL DEFAULT '1',
  `protection2` tinyint(1) NOT NULL DEFAULT '1',
  `protection3` tinyint(1) NOT NULL DEFAULT '1',
  `logging` tinyint(1) NOT NULL DEFAULT '1',
  `autoban` tinyint(1) NOT NULL DEFAULT '0',
  `mail` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>badbot-settings` (`id`, `protection`, `protection2`, `protection3`, `logging`, `autoban`, `mail`) VALUES
(1, 1, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>bans` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `time` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `autoban` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>bans-country` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `country` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Banned countries table';

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>bans-other` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `type` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>content-protection` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `function` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `alert` tinyint(1) NOT NULL DEFAULT '1',
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>content-protection` (`id`, `function`, `enabled`, `alert`, `message`) VALUES
(1, 'rightclick', 0, 1, 'Context Menu not allowed'),
(2, 'rightclick_images', 0, 1, 'Context Menu on Images not allowed'),
(3, 'cut', 0, 1, 'Cut not allowed'),
(4, 'copy', 0, 1, 'Copy not allowed'),
(5, 'paste', 0, 1, 'Paste not allowed'),
(6, 'drag', 0, 0, ''),
(7, 'drop', 0, 0, ''),
(8, 'printscreen', 0, 1, 'It is not allowed to use the Print Screen button'),
(9, 'print', 0, 1, 'It is not allowed to Print'),
(10, 'view_source', 0, 1, 'It is not allowed to view the source code of the site'),
(11, 'iframe_out', 0, 0, ''),
(12, 'selecting', 0, 0, '');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>dnsbl-databases` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `database` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>dnsbl-databases` (`id`, `database`) VALUES
(1, 'sbl.spamhaus.org'),
(2, 'xbl.spamhaus.org');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>ip-whitelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE `<DB_PREFIX>live-traffic` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `useragent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `browser` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `browser_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `os` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `os_code` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `device_type` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `country_code` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'XX',
  `request_uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `referer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bot` tinyint(1) NOT NULL DEFAULT '0',
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `time` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `uniquev` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE `<DB_PREFIX>logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `time` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `successful` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `time` char(5) COLLATE utf8_unicode_ci NOT NULL,
  `page` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `query` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `browser` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown',
  `browser_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `os` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown',
  `os_code` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown',
  `country_code` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'XX',
  `region` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown',
  `city` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown',
  `latitude` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `longitude` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `isp` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unknown',
  `useragent` text COLLATE utf8_unicode_ci NOT NULL,
  `referer_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>malwarescanner-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `file-extensions` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'php|php3|php4|php5|phps|htm|html|htaccess|js',
  `ignored-dirs` text COLLATE utf8_unicode_ci NOT NULL,
  `scan-dir` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '../'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>malwarescanner-settings` (`id`, `file-extensions`, `ignored-dirs`, `scan-dir`) VALUES
(1, 'php|phtml|php3|php4|php5|phps|htaccess|txt|gif', '.|..|.DS_Store|.svn|.git', '../');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>massrequests-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `protection` tinyint(1) NOT NULL DEFAULT '1',
  `logging` tinyint(1) NOT NULL DEFAULT '1',
  `autoban` tinyint(1) NOT NULL DEFAULT '0',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pages/mass-requests.php',
  `mail` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>massrequests-settings` (`id`, `protection`, `logging`, `autoban`, `redirect`, `mail`) VALUES
(1, 0, 1, 0, '<PROJECTSECURITY_PATH>/pages/mass-requests.php', 0);

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>monitoring` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>pages-layolt` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `page` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>pages-layolt` (`id`, `page`, `text`) VALUES
(1, 'Banned', 'You are banned and you cannot continue to the website'),
(2, 'Blocked', 'Malicious request was detected'),
(3, 'Mass_Requests', 'Attention, you performed too many connections'),
(4, 'Proxy', 'Access to the website via Proxy is not allowed (Disable Browser Data Compression if you have it enabled)'),
(5, 'Spam', 'You are in the Blacklist of Spammers and you cannot continue to the website'),
(6, 'Tor', 'We detected that you are using Tor'),
(7, 'Banned_Country', 'Sorry, but your country is banned and you cannot continue to the website'),
(8, 'Blocked_Browser', 'Access to the website through your Browser is not allowed, please use another Internet Browser'),
(9, 'Blocked_OS', 'Access to the website through your Operating System is not allowed'),
(10, 'Blocked_ISP', 'Your Internet Service Provider is blacklisted and you cannot continue to the website'),
(11, 'Blocked_RFR', 'Your referrer url is blocked and you cannot continue to the website'),
(12, 'Bad_Bot', 'You were identified as a Bad Bot and you cannot continue to the website'),
(13, 'Fake_Bot', 'You were identified as a Fake Bot and you cannot continue to the website'),
(14, 'Tor', 'We detected that you are using Tor'),
(15, 'AdBlocker', 'AdBlocker detected. Please support this website by disabling your AdBlocker');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>proxy-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `protection` tinyint(1) NOT NULL DEFAULT '0',
  `protection2` tinyint(1) NOT NULL DEFAULT '0',
  `protection3` tinyint(1) NOT NULL DEFAULT '0',
  `logging` tinyint(1) NOT NULL DEFAULT '1',
  `autoban` tinyint(1) NOT NULL DEFAULT '0',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '<PROJECTSECURITY_PATH>/pages/proxy.php',
  `mail` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>proxy-settings` (`id`, `protection`, `protection2`, `protection3`, `logging`, `autoban`, `redirect`, `mail`) VALUES
(1, 0, 0, 0, 1, 0, '<PROJECTSECURITY_PATH>/pages/proxy.php', 0);

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `realtime_protection` tinyint(1) NOT NULL DEFAULT '1',
  `mail_notifications` tinyint(1) NOT NULL DEFAULT '1',
  `ip_detection` int(1) NOT NULL DEFAULT '0',
  `countryban_blacklist` tinyint(1) NOT NULL DEFAULT '1',
  `live_traffic` tinyint(1) NOT NULL DEFAULT '0',
  `jquery_include` tinyint(1) NOT NULL DEFAULT '0',
  `error_reporting` int(11) NOT NULL DEFAULT '5',
  `display_errors` int(11) NOT NULL DEFAULT '0',
  `fixed_layout` tinyint(1) NOT NULL DEFAULT '0',
  `boxed_layout` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='All Project SECURITY settings will be stored here.';


INSERT INTO `<DB_PREFIX>settings` (`id`, `email`, `mail_notifications`, `realtime_protection`, `ip_detection`, `countryban_blacklist`, `live_traffic`, `jquery_include`, `error_reporting`, `display_errors`, `fixed_layout`, `boxed_layout`) VALUES
(1, 'admin@mail.com', 1, 1, 0, 1, 0, 0, 5, 0, 0, 0);

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>spam-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `protection` tinyint(1) NOT NULL DEFAULT '0',
  `logging` tinyint(1) NOT NULL DEFAULT '1',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '<PROJECTSECURITY_PATH>/pages/spammer.php',
  `autoban` tinyint(1) NOT NULL DEFAULT '0',
  `mail` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>spam-settings` (`id`, `protection`, `logging`, `redirect`, `autoban`, `mail`) VALUES
(1, 0, 1, '<PROJECTSECURITY_PATH>/pages/spammer.php', 0, 0);

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>sqli-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `protection` tinyint(1) NOT NULL DEFAULT '1',
  `protection2` tinyint(1) NOT NULL DEFAULT '1',
  `protection3` tinyint(1) NOT NULL DEFAULT '1',
  `protection4` tinyint(1) NOT NULL DEFAULT '1',
  `protection5` tinyint(1) NOT NULL DEFAULT '0',
  `protection6` tinyint(1) NOT NULL DEFAULT '1',
  `protection7` tinyint(1) NOT NULL DEFAULT '0',
  `protection8` tinyint(1) NOT NULL DEFAULT '0',
  `logging` tinyint(1) NOT NULL DEFAULT '1',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '<PROJECTSECURITY_PATH>/pages/blocked.php',
  `autoban` tinyint(1) NOT NULL DEFAULT '0',
  `mail` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>sqli-settings` (`id`, `protection`, `protection2`, `protection3`, `protection4`, `protection5`, `protection6`, `protection7`, `protection8`, `logging`, `redirect`, `autoban`, `mail`) VALUES
(1, 1, 1, 1, 1, 0, 1, 0, 0, 1, '<PROJECTSECURITY_PATH>/pages/blocked.php', 0, 0);

-- --------------------------------------------------------

CREATE TABLE `<DB_PREFIX>tor-settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `protection` tinyint(1) NOT NULL DEFAULT '1',
  `logging` tinyint(1) NOT NULL DEFAULT '1',
  `redirect` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pages/tor-detected.php',
  `autoban` tinyint(1) NOT NULL DEFAULT '0',
  `mail` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `<DB_PREFIX>tor-settings` (`id`, `protection`, `logging`, `redirect`, `autoban`, `mail`) VALUES
(1, 1, 1, '<PROJECTSECURITY_PATH>/pages/tor-detected.php', 0, 0);

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `<DB_PREFIX>users` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
