<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'maurobonfietti/rest-api-slim-php';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'composer/ca-bundle' => '1.2.10@9fdb22c2e97a614657716178093cd1da90a64aa8',
  'composer/composer' => '1.10.22@28c9dfbe2351635961f670773e8d7b17bc5eda25',
  'composer/semver' => '1.7.2@647490bbcaf7fc4891c58f47b825eb99d19c377a',
  'composer/spdx-licenses' => '1.5.5@de30328a7af8680efdc03e396aad24befd513200',
  'composer/xdebug-handler' => '1.4.6@f27e06cd9675801df441b3656569b328e04aa37c',
  'firebase/php-jwt' => 'v5.4.0@d2113d9b2e0e349796e72d2a63cf9319100382d2',
  'graham-campbell/result-type' => 'v1.0.1@7e279d2cd5d7fbb156ce46daada972355cea27bb',
  'justinrainbow/json-schema' => '5.2.11@2ab6744b7296ded80f8cc4f9509abbff393399aa',
  'nikic/fast-route' => 'v1.3.0@181d480e08d9476e61381e04a71b34dc0432e812',
  'palanik/corsslim' => 'dev-slim3@e84cb944ca73aace3ea92f6ec0b68de1619eea62',
  'phpoption/phpoption' => '1.7.5@994ecccd8f3283ecf5ac33254543eb0ac946d525',
  'pimple/pimple' => 'v3.4.0@86406047271859ffc13424a048541f4531f53601',
  'predis/predis' => 'v1.1.7@b240daa106d4e02f0c5b7079b41e31ddf66fddf8',
  'psr/container' => '1.1.1@8622567409010282b7aeebe4bb841fe98b58dcaf',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.4@d49695b909c3b7628b6289db5479a1c204601f11',
  'respect/validation' => '1.1.31@45d109fc830644fecc1145200d6351ce4f2769d0',
  'seld/jsonlint' => '1.8.3@9ad6ce79c342fbd44df10ea95511a1b24dee5b57',
  'seld/phar-utils' => '1.1.2@749042a2315705d2dfbbc59234dd9ceb22bf3ff0',
  'slim/slim' => '3.12.3@1c9318a84ffb890900901136d620b4f03a59da38',
  'symfony/console' => 'v5.3.6@51b71afd6d2dc8f5063199357b9880cea8d8bfe2',
  'symfony/deprecation-contracts' => 'v2.4.0@5f38c8804a9e97d23e0c8d63341088cd8a22d627',
  'symfony/filesystem' => 'v5.3.4@343f4fe324383ca46792cae728a3b6e2f708fb32',
  'symfony/finder' => 'v5.3.4@17f50e06018baec41551a71a15731287dbaab186',
  'symfony/polyfill-ctype' => 'v1.23.0@46cd95797e9df938fdd2b03693b5fca5e64b01ce',
  'symfony/polyfill-intl-grapheme' => 'v1.23.1@16880ba9c5ebe3642d1995ab866db29270b36535',
  'symfony/polyfill-intl-normalizer' => 'v1.23.0@8590a5f561694770bdcd3f9b5c69dde6945028e8',
  'symfony/polyfill-mbstring' => 'v1.23.1@9174a3d80210dca8daa7f31fec659150bbeabfc6',
  'symfony/polyfill-php73' => 'v1.23.0@fba8933c384d6476ab14fb7b8526e5287ca7e010',
  'symfony/polyfill-php80' => 'v1.23.1@1100343ed1a92e3a38f9ae122fc0eb21602547be',
  'symfony/process' => 'v5.3.4@d16634ee55b895bd85ec714dadc58e4428ecf030',
  'symfony/service-contracts' => 'v2.4.0@f040a30e04b57fbcc9c6cbcf4dbaa96bd318b9bb',
  'symfony/string' => 'v5.3.3@bd53358e3eccec6a670b5f33ab680d8dbe1d4ae1',
  'vlucas/phpdotenv' => 'v5.3.0@b3eac5c7ac896e52deab4a99068e3f4ab12d9e56',
  'amphp/amp' => 'v2.6.0@caa95edeb1ca1bf7532e9118ede4a3c3126408cc',
  'amphp/byte-stream' => 'v1.8.1@acbd8002b3536485c997c4e019206b3f10ca15bd',
  'composer/package-versions-deprecated' => '1.11.99.2@c6522afe5540d5fc46675043d3ed5a45a740b27c',
  'dealerdirect/phpcodesniffer-composer-installer' => 'v0.7.1@fe390591e0241955f22eb9ba327d137e501c771c',
  'dnoegel/php-xdg-base-dir' => 'v0.1.1@8f8a6e48c5ecb0f991c2fdcf5f154a47d85f9ffd',
  'doctrine/annotations' => '1.13.2@5b668aef16090008790395c02c893b1ba13f7e08',
  'doctrine/instantiator' => '1.4.0@d56bf6102915de5702778fe20f2de3b2fe570b5b',
  'doctrine/lexer' => '1.2.1@e864bbf5904cb8f5bb334f99209b48018522f042',
  'facade/ignition-contracts' => '1.0.2@3c921a1cdba35b68a7f0ccffc6dffc1995b18267',
  'felixfbecker/advanced-json-rpc' => 'v3.2.1@b5f37dbff9a8ad360ca341f3240dc1c168b45447',
  'felixfbecker/language-server-protocol' => '1.5.1@9d846d1f5cf101deee7a61c8ba7caa0a975cd730',
  'filp/whoops' => '2.14.0@fdf92f03e150ed84d5967a833ae93abffac0315b',
  'friendsofphp/php-cs-fixer' => 'v2.19.2@d5c737c2e18ba502b75b44832b31fe627f82e307',
  'league/container' => '3.4.1@84ecbc2dbecc31bd23faf759a0e329ee49abddbd',
  'myclabs/deep-copy' => '1.10.2@776f831124e9c62e1a2c601ecc52e776d8bb7220',
  'netresearch/jsonmapper' => 'v3.1.1@ba09f0e456d4f00cef84e012da5715625594407c',
  'nette/utils' => 'v3.2.3@5c36cc1ba9bb6abb8a9e425cf054e0c3fd5b9822',
  'nikic/php-parser' => 'v4.12.0@6608f01670c3cc5079e18c1dab1104e002579143',
  'nunomaduro/collision' => 'v5.8.0@0c3c393462eada1233513664e2d22bb9f69ca393',
  'nunomaduro/phpinsights' => 'v1.14.1@d8204dc1c30e5f0fe725b29eac1b5ea2202a7fcf',
  'object-calisthenics/phpcs-calisthenics-rules' => 'v3.9.1@6a4e66767138763839370273b47f1f9da6e0ee5a',
  'openlss/lib-array2xml' => '1.0.0@a91f18a8dfc69ffabe5f9b068bc39bb202c81d90',
  'pestphp/pest' => 'v1.16.0@eca5f89e595884e26860b8aec5cfc7d892e9f942',
  'pestphp/pest-plugin' => 'v1.0.0@fc8519de148699fe612d9c669be60554cd2db4fa',
  'phar-io/manifest' => '2.0.3@97803eca37d319dfa7826cc2437fc020857acb53',
  'phar-io/version' => '3.1.0@bae7c545bef187884426f042434e561ab1ddb182',
  'php-cs-fixer/diff' => 'v1.3.1@dbd31aeb251639ac0b9e7e29405c1441907f5759',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.2.2@069a785b2141f5bcf49f3e353548dc1cce6df556',
  'phpdocumentor/type-resolver' => '1.4.0@6a467b8989322d92aa1c8bf2bebcc6e5c2ba55c0',
  'phploc/phploc' => '6.0.2@00e3bade7b22a6f23b17c3bf2fa4dba24ead8a29',
  'phpspec/prophecy' => '1.13.0@be1996ed8adc35c3fd795488a653f4b518be70ea',
  'phpstan/phpdoc-parser' => '0.4.9@98a088b17966bdf6ee25c8a4b634df313d8aa531',
  'phpstan/phpstan' => '0.12.96@a98bdc51318f20fcae8c953d266f81a70254917f',
  'phpunit/php-code-coverage' => '9.2.6@f6293e1b30a2354e8428e004689671b83871edde',
  'phpunit/php-file-iterator' => '3.0.5@aa4be8575f26070b100fccb67faabb28f21f66f8',
  'phpunit/php-invoker' => '3.1.1@5a10147d0aaf65b58940a0b72f71c9ac0423cc67',
  'phpunit/php-text-template' => '2.0.4@5da5f67fc95621df9ff4c4e5a84d6a8a2acf7c28',
  'phpunit/php-timer' => '5.0.3@5a63ce20ed1b5bf577850e2c4e87f4aa902afbd2',
  'phpunit/phpunit' => '9.5.8@191768ccd5c85513b4068bdbe99bb6390c7d54fb',
  'psr/cache' => '1.0.1@d11b50ad223250cf17b86e38383413f5a6764bf8',
  'psr/event-dispatcher' => '1.0.0@dbefd12671e8a14ec7f180cab83036ed26714bb0',
  'sebastian/cli-parser' => '1.0.1@442e7c7e687e42adc03470c7b668bc4b2402c0b2',
  'sebastian/code-unit' => '1.0.8@1fc9f64c0927627ef78ba436c9b17d967e68e120',
  'sebastian/code-unit-reverse-lookup' => '2.0.3@ac91f01ccec49fb77bdc6fd1e548bc70f7faa3e5',
  'sebastian/comparator' => '4.0.6@55f4261989e546dc112258c7a75935a81a7ce382',
  'sebastian/complexity' => '2.0.2@739b35e53379900cc9ac327b2147867b8b6efd88',
  'sebastian/diff' => '4.0.4@3461e3fccc7cfdfc2720be910d3bd73c69be590d',
  'sebastian/environment' => '5.1.3@388b6ced16caa751030f6a69e588299fa09200ac',
  'sebastian/exporter' => '4.0.3@d89cc98761b8cb5a1a235a6b703ae50d34080e65',
  'sebastian/finder-facade' => '2.0.0@9d3e74b845a2ce50e19b25b5f0c2718e153bee6c',
  'sebastian/global-state' => '5.0.3@23bd5951f7ff26f12d4e3242864df3e08dec4e49',
  'sebastian/lines-of-code' => '1.0.3@c1c2e997aa3146983ed888ad08b15470a2e22ecc',
  'sebastian/object-enumerator' => '4.0.4@5c9eeac41b290a3712d88851518825ad78f45c71',
  'sebastian/object-reflector' => '2.0.4@b4f479ebdbf63ac605d183ece17d8d7fe49c15c7',
  'sebastian/recursion-context' => '4.0.4@cd9d8cf3c5804de4341c283ed787f099f5506172',
  'sebastian/resource-operations' => '3.0.3@0f4443cb3a1d92ce809899753bc0d5d5a8dd19a8',
  'sebastian/type' => '2.3.4@b8cd8a1c753c90bc1a0f5372170e3e489136f914',
  'sebastian/version' => '3.0.2@c6c1022351a901512170118436c764e473f6de8c',
  'slevomat/coding-standard' => '6.4.1@696dcca217d0c9da2c40d02731526c1e25b65346',
  'squizlabs/php_codesniffer' => '3.6.0@ffced0d2c8fa8e6cdc4d695a743271fab6c38625',
  'symfony/event-dispatcher' => 'v5.3.4@f2fd2208157553874560f3645d4594303058c4bd',
  'symfony/event-dispatcher-contracts' => 'v2.4.0@69fee1ad2332a7cbab3aca13591953da9cdb7a11',
  'symfony/http-client' => 'v5.3.4@67c177d4df8601d9a71f9d615c52171c98d22d74',
  'symfony/http-client-contracts' => 'v2.4.0@7e82f6084d7cae521a75ef2cb5c9457bbda785f4',
  'symfony/options-resolver' => 'v5.3.4@a603e5701bd6e305cfc777a8b50bf081ef73105e',
  'symfony/polyfill-php70' => 'v1.20.0@5f03a781d984aae42cebd18e7912fa80f02ee644',
  'symfony/polyfill-php72' => 'v1.23.0@9a142215a36a3888e30d0a9eeea9766764e96976',
  'symfony/stopwatch' => 'v5.3.4@b24c6a92c6db316fee69e38c80591e080e41536c',
  'theseer/fdomdocument' => '1.6.6@6e8203e40a32a9c770bcb62fe37e68b948da6dca',
  'theseer/tokenizer' => '1.2.1@34a41e998c2183e22995f158c581e7b5e755ab9e',
  'vimeo/psalm' => '3.18.2@19aa905f7c3c7350569999a93c40ae91ae4e1626',
  'webmozart/assert' => '1.9.1@bafc69caeb4d49c39fd0779086c03a3738cbb389',
  'webmozart/glob' => '4.3.0@06358fafde0f32edb4513f4fd88fe113a40c90ee',
  'webmozart/path-util' => '2.3.0@d939f7edc24c9a1bb9c0dee5cb05d8e859490725',
  'maurobonfietti/rest-api-slim-php' => '2.14.0@',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!class_exists(InstalledVersions::class, false) || !(method_exists(InstalledVersions::class, 'getAllRawData') ? InstalledVersions::getAllRawData() : InstalledVersions::getRawData())) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (class_exists(InstalledVersions::class, false) && (method_exists(InstalledVersions::class, 'getAllRawData') ? InstalledVersions::getAllRawData() : InstalledVersions::getRawData())) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}