<?php
/**
 * WordPress için başlangıç ayar dosyası.
 *
 * Bu dosya kurulum sırasında wp-config.php dosyasının oluşturulabilmesi için
 * kullanılır. İsterseniz bu dosyayı kopyalayıp, ismini "wp-config.php" olarak değiştirip,
 * değerleri girerek de kullanabilirsiniz.
 *
 * Bu dosya şu ayarları içerir:
 * 
 * * Veritabanı ayarları
 * * Gizli anahtarlar
 * * Veritabanı tablo ön eki
 * * ABSPATH
 * 
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Veritabanı ayarları - Bu bilgileri servis sağlayıcınızdan alabilirsiniz ** //
/** WordPress için kullanılacak veritabanının adı */
define( 'DB_NAME', 'cyangate' );

/** Veritabanı kullanıcısı */
define( 'DB_USER', 'root' );

/** Veritabanı parolası */
define( 'DB_PASSWORD', 'kara1453*' );

/** Veritabanı sunucusu */
define( 'DB_HOST', 'localhost' );

/** Yaratılacak tablolar için veritabanı karakter seti. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Veritabanı karşılaştırma tipi. Herhangi bir şüpheniz varsa bu değeri değiştirmeyin. */
define( 'DB_COLLATE', '' );

/**#@+
 * Eşsiz doğrulama anahtarları ve tuzlar.
 *
 * Her anahtar farklı bir karakter kümesi olmalı!
 * {@link http://api.wordpress.org/secret-key/1.1/salt WordPress.org secret-key service} servisini kullanarak yaratabilirsiniz.
 * 
 * Çerezleri geçersiz kılmak için istediğiniz zaman bu değerleri değiştirebilirsiniz.
 * Bu tüm kullanıcıların tekrar giriş yapmasını gerektirecektir.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'hHNu+?;P;#/0qp3TS_[aCk@)rmW5`2lhrKU76W5xt-Wm@{CbUO9F]N={Brw},t*K' );
define( 'SECURE_AUTH_KEY',  '+G_.v2A=~.N_XH&X%#r_p$OYRAmXI0)b#jwN?~px.OWxZ8|^DLU|Pz_(KP<,0QMa' );
define( 'LOGGED_IN_KEY',    '{m_fU/p[d28kP7P7LfR(`h~BG2<fN_pM@[9)wc&/sf @Xu4j1#I#)QTRe__;XKYc' );
define( 'NONCE_KEY',        '%|EImKszAKNT]oAiNP43&gb>xtc_Z2@7ub]?n?X3f!!mY^P^N*C/@jN4>,j!&rX,' );
define( 'AUTH_SALT',        'F0o&UQsE(C%obg]S:2rd.[0XIT`,+(pnwcn$1tvnPM4Ni)t9-TCOlRpq{I?}U:fq' );
define( 'SECURE_AUTH_SALT', '-{ri5)!9!#!pxXKU>ak!&>)6&>6]06,)$9&]Un[O6p[]2yCm8#_ZB,-9r,#Wol82' );
define( 'LOGGED_IN_SALT',   'b.&+z65RgjR^{V@*CplHQQIT[BM8<?$ApeL-59>G!ehU!%l$d@@(aoD|E9_#lM%|' );
define( 'NONCE_SALT',       'k=/<&7Kucg],5n:SG?hHr:)NhuF+5:aRzfb.FBG+eqRSU>~2C.U1q(;_k)I0L@?v' );

/**#@-*/

/**
 * WordPress veritabanı tablo ön eki.
 *
 * Tüm kurulumlara ayrı bir önek vererek bir veritabanına birden fazla kurulum yapabilirsiniz.
 * Sadece rakamlar, harfler ve alt çizgi lütfen.
 */
$table_prefix = 'wp_';

/**
 * Geliştiriciler için: WordPress hata ayıklama modu.
 *
 * Bu değeri true olarak ayarlayıp geliştirme sırasında hataların ekrana
 * basılmasını sağlayabilirsiniz. Tema ve eklenti geliştiricilerinin geliştirme
 * aşamasında WP_DEBUG kullanmalarını önemle tavsiye ederiz.
 * 
 * Hata ayıklama için kullanabilecek diğer sabitler ile ilgili daha fazla bilgiyi
 * belgelerden edinebilirsiniz.
 * 
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Her türlü özel değeri bu satı ile "Hepsi bu kadar" yazan satır arasına ekleyebilirsiniz. */



/* Hepsi bu kadar. Mutlu bloglamalar! */

/** WordPress dizini için mutlak yol. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** WordPress değişkenlerini ve yollarını kurar. */
require_once ABSPATH . 'wp-settings.php';