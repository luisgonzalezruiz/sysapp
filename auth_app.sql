/*
Navicat MySQL Data Transfer

Source Server         : MySql
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : auth_app

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-08-03 13:58:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `failed_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for `images`
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of images
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('10', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('11', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('12', '2016_06_01_000001_create_oauth_auth_codes_table', '1');
INSERT INTO `migrations` VALUES ('13', '2016_06_01_000002_create_oauth_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('14', '2016_06_01_000003_create_oauth_refresh_tokens_table', '1');
INSERT INTO `migrations` VALUES ('15', '2016_06_01_000004_create_oauth_clients_table', '1');
INSERT INTO `migrations` VALUES ('16', '2016_06_01_000005_create_oauth_personal_access_clients_table', '1');
INSERT INTO `migrations` VALUES ('17', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('18', '2021_02_04_193253_create_images_table', '1');
INSERT INTO `migrations` VALUES ('19', '2022_07_09_165420_create_tasks_table', '2');
INSERT INTO `migrations` VALUES ('20', '2022_07_10_233818_create_productos_table', '2');

-- ----------------------------
-- Table structure for `oauth_access_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_access_tokens
-- ----------------------------
INSERT INTO `oauth_access_tokens` VALUES ('051b619a87e8310359350cd49272ef910e7b78954babaa3774c49738810e6c6a7e1f017e82f6c8b3', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-12 16:22:49', '2022-07-12 16:22:49', '2023-07-12 16:22:49');
INSERT INTO `oauth_access_tokens` VALUES ('12462c028b9428a41ac5d97af1bd31fabb78a191b3e67991ff85555848b666e0ddad8f8c84ed7d1b', '1', '1', 'Personal Access Token', '[]', '1', '2022-07-07 17:30:31', '2022-07-07 17:30:31', '2023-07-07 17:30:31');
INSERT INTO `oauth_access_tokens` VALUES ('1380dead10b986893ebcdd524040989ffb2190afb3b6aefb60daea9fb79794a299010444c312e017', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-03 14:31:24', '2022-08-03 14:31:24', '2023-08-03 14:31:24');
INSERT INTO `oauth_access_tokens` VALUES ('16100b0f9cb73acd87cea36aec6688971176127d110d4289edc58117d74eb54825981e742fd268a9', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-20 17:59:25', '2022-07-20 17:59:25', '2023-07-20 17:59:25');
INSERT INTO `oauth_access_tokens` VALUES ('1bc5a19804426a5e133b0c4f854ee6c2bd008b80893b4028e7b83f6ea1ad491b98e59c5ff6dc56c0', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-02 20:58:18', '2022-08-02 20:58:18', '2023-08-02 20:58:18');
INSERT INTO `oauth_access_tokens` VALUES ('1eb3da91ca840739e0db912dc613be24521b353eb907b71b6826d9f7b29d4ff86e346db20156f926', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-03 14:26:47', '2022-08-03 14:26:47', '2023-08-03 14:26:47');
INSERT INTO `oauth_access_tokens` VALUES ('21e0464115bd2e767881c43c104c82f0a26e4562a3ad50195b5590984e1f961df328d2f3728c53ab', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-02 20:57:26', '2022-08-02 20:57:26', '2023-08-02 20:57:26');
INSERT INTO `oauth_access_tokens` VALUES ('2ce0e45875ec75f49a771e6e7a6615603a8fb9d0037188ce711297cdb9e963cd6c3bc6eea32d2adb', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-02 14:12:17', '2022-08-02 14:12:17', '2023-08-02 14:12:17');
INSERT INTO `oauth_access_tokens` VALUES ('377c53b94a5b63b88b14770d7fe4b01781f69ea6a06b30efca321376dd930eb052683385ea6400e8', '1', '1', null, '[]', '0', '2022-07-07 16:19:22', '2022-07-07 16:19:22', '2023-07-07 16:19:22');
INSERT INTO `oauth_access_tokens` VALUES ('4e436a0f5eb199913f5a407bd4b7aa8a6e8acd7b7d08fd718aedd6526c2f5bdc4b97737add6384c1', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-20 18:12:37', '2022-07-20 18:12:37', '2023-07-20 18:12:37');
INSERT INTO `oauth_access_tokens` VALUES ('5b218c9b4ddfc2d8c54f683b63564c3f3113b95bdb19a7d33add50a24adeacf5bdf772422fda0a6b', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-20 17:59:06', '2022-07-20 17:59:06', '2023-07-20 17:59:06');
INSERT INTO `oauth_access_tokens` VALUES ('65869185da064a853ac16b4ecd6afc735190563cfde8ce09f026e898b84ab7362c2b1dfc1d14e6ed', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-12 16:01:49', '2022-07-12 16:01:49', '2023-07-12 16:01:49');
INSERT INTO `oauth_access_tokens` VALUES ('6f073e2c2a7f7309d670a9f9d6a69d2689cc3449b36dc40ad633d18d97fb947d36c1f9c4aa8f0db1', '1', '1', null, '[]', '0', '2022-07-07 16:25:31', '2022-07-07 16:25:31', '2023-07-07 16:25:31');
INSERT INTO `oauth_access_tokens` VALUES ('6fb5f0beb02a575970d8696ac374c1b3bd231618eff7009635635f4ace4d2040033a543292dc31f5', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-02 14:33:23', '2022-08-02 14:33:23', '2023-08-02 14:33:23');
INSERT INTO `oauth_access_tokens` VALUES ('7a3099b0cca941e2edbab4d3fc247e1011161b9f0502ddb9942523ed3cb240737d0385ca778ec7ba', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-12 16:17:06', '2022-07-12 16:17:06', '2023-07-12 16:17:06');
INSERT INTO `oauth_access_tokens` VALUES ('7c2a174fdd8a2f32a931257133f7420a5e91965424000f769ba41eb67c74e8b6c7066364a86f8283', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-02 21:50:42', '2022-08-02 21:50:42', '2023-08-02 21:50:42');
INSERT INTO `oauth_access_tokens` VALUES ('7d31672274b3736ab6607571a5e659314cdb5f1202b29e72b3bb36d294116f5ad3b5c73b59868550', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-02 17:46:53', '2022-08-02 17:46:53', '2023-08-02 17:46:53');
INSERT INTO `oauth_access_tokens` VALUES ('7d5b27a45624d4c659a692371d54470753aa3277777df750c41495aba8d9e2d1785a5469cf38ba86', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-03 14:27:10', '2022-08-03 14:27:10', '2023-08-03 14:27:10');
INSERT INTO `oauth_access_tokens` VALUES ('7e983454dbbd607e13a67f4d3b537457a5f7c7c4d1220c8ca1d3104d3aebc179f12b752ea48c9196', '1', '1', 'Personal Access Token', '[]', '0', '2021-05-25 17:30:33', '2021-05-25 17:30:33', '2022-05-25 17:30:33');
INSERT INTO `oauth_access_tokens` VALUES ('85da6301ec951dc0002beee5ade23a7e6de11354c0dac77105962b0e33f5a57bce6eef457fef968c', '1', '1', 'Personal Access Token', '[]', '0', '2021-05-25 17:30:18', '2021-05-25 17:30:18', '2022-05-25 17:30:18');
INSERT INTO `oauth_access_tokens` VALUES ('87878eca9d6ef1d132d45b9dbd7e0dd4f80ab80dffc4f064111fd3c970261907d223c9582985b2e8', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-07 17:24:26', '2022-07-07 17:24:26', '2023-07-07 17:24:26');
INSERT INTO `oauth_access_tokens` VALUES ('9293b8de7648f74864772504caa86771ed5424539b4ab5413cd1ebe65449f00a6d0179de03adacea', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-07 17:28:08', '2022-07-07 17:28:08', '2023-07-07 17:28:08');
INSERT INTO `oauth_access_tokens` VALUES ('9939d9e074ffdc553c1b87450ff433d6b81a7a2a4d2e7699bf72e817b1818e59101243c22140494a', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-02 21:52:55', '2022-08-02 21:52:55', '2023-08-02 21:52:55');
INSERT INTO `oauth_access_tokens` VALUES ('9f1a34da5ce5d11e47cf89d3327666724cc6659ce4f8378cce6cbf805025c977526f75cf6571bb99', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-20 18:00:44', '2022-07-20 18:00:44', '2023-07-20 18:00:44');
INSERT INTO `oauth_access_tokens` VALUES ('af4d5d745b6c3b548b585b152aaba108977e024640e253fec91819e5d0446b90a436cbe97ffd4b11', '1', '1', null, '[]', '0', '2022-07-07 16:18:17', '2022-07-07 16:18:17', '2023-07-07 16:18:17');
INSERT INTO `oauth_access_tokens` VALUES ('b7b6c1946b30fc59dcb69398350cb7b1d8411e7596422f596e18a55182a34dbf3f98fcdd9ba41198', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-03 14:33:45', '2022-08-03 14:33:45', '2023-08-03 14:33:45');
INSERT INTO `oauth_access_tokens` VALUES ('c0619c8283fd8fa9f182c66dd601cbd6d312c8bf355db9c4e38c500a77d53530f54b05a1babd0f6e', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-02 18:19:24', '2022-08-02 18:19:24', '2023-08-02 18:19:24');
INSERT INTO `oauth_access_tokens` VALUES ('c3ba475d842bc086ffe0f7c3aad91e4a05858a0465b978f351f25093c5c35d8ad457e27a036c7c8a', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-12 16:22:19', '2022-07-12 16:22:19', '2023-07-12 16:22:19');
INSERT INTO `oauth_access_tokens` VALUES ('c91a3a9fba625a41d683064201c2304ef647da0016aeb9b514db4bc8214ad545d58cd5d2b0990c46', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-12 16:22:42', '2022-07-12 16:22:42', '2023-07-12 16:22:42');
INSERT INTO `oauth_access_tokens` VALUES ('ca024ab48f002aff8e84ccffdb6567197ad04c4f47a907c010e3c0f14570a1f8934f8a2c6f37bb1b', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-03 14:37:09', '2022-08-03 14:37:09', '2023-08-03 14:37:09');
INSERT INTO `oauth_access_tokens` VALUES ('cc8b5fac9edf9c7dfafc9569c925874926903f8c677928d2a28a79bcb3d8b916564d8d13c66addb6', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-18 18:16:53', '2022-07-18 18:16:53', '2023-07-18 18:16:53');
INSERT INTO `oauth_access_tokens` VALUES ('d1dacdd41d54630bcf4f299167a1ee86875befa49c3814cfcf12ad037b5624d811bdd40a6f6d98a5', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-02 20:33:21', '2022-08-02 20:33:21', '2023-08-02 20:33:21');
INSERT INTO `oauth_access_tokens` VALUES ('dc858d28a85e8278f6b386ccef4173ad24a55ce23c98d0f294983c2f4f66a9654174679fab4c560e', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-18 13:52:14', '2022-07-18 13:52:14', '2023-07-18 13:52:14');
INSERT INTO `oauth_access_tokens` VALUES ('dd0d416fc65f9fc6a3752ef41d20a23349f7244a0eb367fae442c824963ac7d1213af65cd20cd33c', '1', '1', 'Personal Access Token', '[]', '0', '2021-05-25 17:28:51', '2021-05-25 17:28:51', '2022-05-25 17:28:51');
INSERT INTO `oauth_access_tokens` VALUES ('ddb8c69f6f6b957c92d9f6d96be10eba46c02acc42b9f91437fa7bbd5b2389371fd35b540ffbaffb', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-20 18:13:49', '2022-07-20 18:13:49', '2023-07-20 18:13:49');
INSERT INTO `oauth_access_tokens` VALUES ('df4d00df064632edd03994efadf3fb389016d50cd3bad9d1a80ed3da9f7f7488509eefb7b64686bf', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-07 21:22:49', '2022-07-07 21:22:49', '2023-07-07 21:22:49');
INSERT INTO `oauth_access_tokens` VALUES ('e22051e301ab67725d8ea602fea9f4125b1302a01d7a2bf7d318a7b3a4f1fea88735ee0aaa8d42cd', '1', '1', 'Personal Access Token', '[]', '0', '2021-05-25 17:30:29', '2021-05-25 17:30:29', '2022-05-25 17:30:29');
INSERT INTO `oauth_access_tokens` VALUES ('e464b6777f353f5aaab8e5e42cd88b92ce02ad76fc9fd2259b3f0d7c3a3fbc2e4e3a12749f434486', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-12 16:14:02', '2022-07-12 16:14:02', '2023-07-12 16:14:02');
INSERT INTO `oauth_access_tokens` VALUES ('e4e8d6f103760bf8ff8f497fcff2cded8d87142db2b4252f4be6230ca6c88e70b28c798472df4d8f', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-02 20:55:44', '2022-08-02 20:55:44', '2023-08-02 20:55:44');
INSERT INTO `oauth_access_tokens` VALUES ('e6acbd3ce5857f99050d5b411bcabd9cd4f27819e2bb3f8c67f400f2521c1c45581856d99ff21b45', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-07 21:23:12', '2022-07-07 21:23:12', '2023-07-07 21:23:12');
INSERT INTO `oauth_access_tokens` VALUES ('ee6904c07fec2293787041c6498fbebe9fc5f12e67d72c760153f86bee87ff4092af8efb5d7727a2', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-11 15:30:51', '2022-07-11 15:30:51', '2023-07-11 15:30:51');
INSERT INTO `oauth_access_tokens` VALUES ('efb71c7d18c673a10450f3387a364a3d3acb2a018700ad47db785da7a6c49dabadcc81c5f74d3000', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-02 21:57:59', '2022-08-02 21:57:59', '2023-08-02 21:57:59');
INSERT INTO `oauth_access_tokens` VALUES ('f081afc1d401caeb11db4c30d6a88ad6f71bd210eca71c38f4fbdd76788f5ccf6c3af89d067b396e', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-20 17:59:15', '2022-07-20 17:59:15', '2023-07-20 17:59:15');
INSERT INTO `oauth_access_tokens` VALUES ('f3674ec29132593703f545a1ebf3bd94e06c3f3130d8144af504e6728800e881fa8c20008a59a58e', '1', '1', 'Personal Access Token', '[]', '0', '2022-07-20 18:03:08', '2022-07-20 18:03:08', '2023-07-20 18:03:08');
INSERT INTO `oauth_access_tokens` VALUES ('f7f9ddd35f1064723c17158db4fea23a936a44497dee31f8fe464dd145f455badb781166a615cbe2', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-03 15:07:16', '2022-08-03 15:07:16', '2023-08-03 15:07:16');
INSERT INTO `oauth_access_tokens` VALUES ('f9fffc20be1cf2d10eeee65bc502b589f174017bbd8edae228b72fea447d73f28eba723c7bbfb24b', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-03 14:19:45', '2022-08-03 14:19:45', '2023-08-03 14:19:45');
INSERT INTO `oauth_access_tokens` VALUES ('fb6cd70882d0c5f0e932ec17d204a292639e1620546cec65ffa446bc44f2043da95466497bc153c0', '1', '1', 'Personal Access Token', '[]', '0', '2022-08-03 14:59:05', '2022-08-03 14:59:05', '2023-08-03 14:59:05');
INSERT INTO `oauth_access_tokens` VALUES ('fd422e1702ec0989ef4611df56027f0ab1fe68e61bf32d27e1666dcc90a02a1de908cd862d66f822', '1', '1', 'Personal Access Token', '[]', '0', '2021-05-25 17:30:46', '2021-05-25 17:30:46', '2022-05-25 17:30:46');

-- ----------------------------
-- Table structure for `oauth_auth_codes`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_auth_codes
-- ----------------------------

-- ----------------------------
-- Table structure for `oauth_clients`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_clients
-- ----------------------------
INSERT INTO `oauth_clients` VALUES ('1', null, 'Laravel Personal Access Client', '4EoiE6v8mySHVCcvJzOZBai6YWoAQQod1UJeL1rE', null, 'http://localhost', '1', '0', '0', '2021-05-25 17:27:49', '2021-05-25 17:27:49');
INSERT INTO `oauth_clients` VALUES ('2', null, 'Laravel Password Grant Client', 'pUDQk6CpexE8kT6omryl5KO3RNTn5vrbuJOr2pSP', 'users', 'http://localhost', '0', '1', '0', '2021-05-25 17:27:49', '2021-05-25 17:27:49');

-- ----------------------------
-- Table structure for `oauth_personal_access_clients`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_personal_access_clients
-- ----------------------------
INSERT INTO `oauth_personal_access_clients` VALUES ('1', '1', '2021-05-25 17:27:49', '2021-05-25 17:27:49');

-- ----------------------------
-- Table structure for `oauth_refresh_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of oauth_refresh_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `productos`
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `producto_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`producto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES ('1', 'Leche', 'Leche entera', '1500.00', '2022-07-11 20:09:49', '2022-07-11 20:09:49');
INSERT INTO `productos` VALUES ('2', 'sdsdsd', 'sdsds', '15000.00', '2022-07-11 20:12:06', '2022-07-11 20:12:06');
INSERT INTO `productos` VALUES ('3', 'Cerveza', 'Cerveza 500cc', '15000.00', '2022-07-18 18:18:33', '2022-07-18 18:18:33');
INSERT INTO `productos` VALUES ('4', 'coca', 'coca', '30000.00', '2022-07-19 17:39:49', '2022-07-19 17:39:49');
INSERT INTO `productos` VALUES ('5', 'Leche entera', 'Leche entera', '2000.00', '2022-08-02 20:00:23', '2022-08-02 20:00:23');
INSERT INTO `productos` VALUES ('6', 'dsdsdsd', 'sdsdsd', '15.00', '2022-08-02 20:31:01', '2022-08-02 20:31:01');
INSERT INTO `productos` VALUES ('7', 'kjdskjdk', 'kjkdjfkdfk', '15000.00', '2022-08-02 20:35:00', '2022-08-02 20:35:00');
INSERT INTO `productos` VALUES ('8', 'ffff', 'vfgrtrt', '45.00', '2022-08-02 20:36:24', '2022-08-02 20:36:24');
INSERT INTO `productos` VALUES ('9', 'gdgdgd', 'dhcgdgdg', '452.00', '2022-08-02 20:39:22', '2022-08-02 20:39:22');

-- ----------------------------
-- Table structure for `tasks`
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tasks
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Luis', 'Gonzalez', 'luis@gmail.com', null, '$2y$10$PjFPg/8j6Tj/I0/WtgnVzefcny7O7/aLS18U7FvlIlHDUtZFacNCi', null, '2021-05-25 17:03:07', '2021-05-25 17:03:07');
INSERT INTO `users` VALUES ('2', 'pedro', 'gonzalez', 'pedro@gmail.com', null, '$2y$10$PjFPg/8j6Tj/I0/WtgnVzefcny7O7/aLS18U7FvlIlHDUtZFacNCi', null, '2022-07-07 13:43:10', '2022-07-07 13:43:10');
INSERT INTO `users` VALUES ('3', 'joaquin', 'Gonzalez', 'joaquin@gmail.com', null, '$2y$10$cJjalql0dBzx0Q4ZoIBQiu2IbpLfEZfoevYWKkQAa.qiLUbJbLGfe', null, '2022-07-11 15:35:10', '2022-07-11 15:35:10');
