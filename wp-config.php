<?php
/**
 * WordPress için taban ayar dosyası.
 *
 * Bu dosya şu ayarları içerir: MySQL ayarları, tablo öneki,
 * gizli anahtaralr ve ABSPATH. Daha fazla bilgi için 
 * {@link https://codex.wordpress.org/Editing_wp-config.php wp-config.php düzenleme}
 * yardım sayfasına göz atabilirsiniz. MySQL ayarlarınızı servis sağlayıcınızdan edinebilirsiniz.
 *
 * Bu dosya kurulum sırasında wp-config.php dosyasının oluşturulabilmesi için
 * kullanılır. İsterseniz bu dosyayı kopyalayıp, ismini "wp-config.php" olarak değiştirip,
 * değerleri girerek de kullanabilirsiniz.
 *
 * @package WordPress
 */

// ** MySQL ayarları - Bu bilgileri sunucunuzdan alabilirsiniz ** //
/** WordPress için kullanılacak veritabanının adı */
define('DB_NAME', 'sablon');

/** MySQL veritabanı kullanıcısı */
define('DB_USER', 'root');

/** MySQL veritabanı parolası */
define('DB_PASSWORD', '');

/** MySQL sunucusu */
define('DB_HOST', 'localhost');

/** Yaratılacak tablolar için veritabanı karakter seti. */
define('DB_CHARSET', 'utf8mb4');

/** Veritabanı karşılaştırma tipi. Herhangi bir şüpheniz varsa bu değeri değiştirmeyin. */
define('DB_COLLATE', '');

/**#@+
 * Eşsiz doğrulama anahtarları.
 *
 * Her anahtar farklı bir karakter kümesi olmalı!
 * {@link http://api.wordpress.org/secret-key/1.1/salt WordPress.org secret-key service} servisini kullanarak yaratabilirsiniz.
 * Çerezleri geçersiz kılmak için istediğiniz zaman bu değerleri değiştirebilirsiniz. Bu tüm kullanıcıların tekrar giriş yapmasını gerektirecektir.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^A$^d>bh?]x;5t4>HXex19ZL;},g# -6Pui%:6jLtVJ47O?5j$rL|dv0bN1m2Ylv');
define('SECURE_AUTH_KEY',  'YX)7rW{E0{kQ<9z*PyE@OwJB?6t5l52Rut`{pXS^o47(maFm5&i]SUb&O{a]%:_3');
define('LOGGED_IN_KEY',    'zT96ayg{LoY]7`o@aL.e2nOn/w8Hmz5D 6kTk_D0@*Lo,@@}yG9x<]:^}aD$YEIC');
define('NONCE_KEY',        ',Hg(<A-sbQ)Oz+kt(e=2+X*m0f/<A@RY3^v4O6mx|)yo,W.8_b`5q9Nr:{y[!(-Y');
define('AUTH_SALT',        'S;,|qP$gE.d,7m*thi39z;]/v;tJ;jtbsfAN-&eU5Wh=]ApY4#LMV7!.c>4*l^ik');
define('SECURE_AUTH_SALT', 'tLm#Drud Da)?u5=F Z}CgrtTg1Ac]H7 m?Gu)a0xnM>Rl<t:);zO4(d;[IqRKW<');
define('LOGGED_IN_SALT',   '.`VIuyRO-0Tp0+^CN`9+U,>@vL7C]*-Xy~|iXzhCO*>SCU]91)v6Tk+rEb-,!-a%');
define('NONCE_SALT',       'hW{9i`(t_I$SAR7C!pJ-xx*iHvMTTE@ov-b,Yyfl{ WrbHPIO23:VvX_e]~ 3_ub');
/**#@-*/

/**
 * WordPress veritabanı tablo ön eki.
 *
 * Tüm kurulumlara ayrı bir önek vererek bir veritabanına birden fazla kurulum yapabilirsiniz.
 * Sadece rakamlar, harfler ve alt çizgi lütfen.
 */
$table_prefix  = 'wp9x_';

/**
 * Geliştiriciler için: WordPress hata ayıklama modu.
 *
 * Bu değeri "true" yaparak geliştirme sırasında hataların ekrana basılmasını sağlayabilirsiniz.
 * Tema ve eklenti geliştiricilerinin geliştirme aşamasında WP_DEBUG
 * kullanmalarını önemle tavsiye ederiz.
 */
define('WP_DEBUG', true);

/* Hepsi bu kadar. Mutlu bloglamalar! */

/** WordPress dizini için mutlak yol. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** WordPress değişkenlerini ve yollarını kurar. */
require_once(ABSPATH . 'wp-settings.php');
