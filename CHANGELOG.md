v4.49.0
- feat: add getScheme, getHost, getBaseUrl and getAbsoluteUrl helpers (96f5f16)

v4.48.0
- refactor: use FileHelper for extension extraction and validation in UploaderManager (5c49f01)
- feat: add FileSizeHelper for human-readable byte formatting (b92ab27)
- feat: add FileHelper for file inspection and path/URL conversion (72b5002)

v4.47.0
- fix: add new methods into Twig and Controller extension (9966c10)
- fix: remove nullable id from generated entity (c2a86fc)
- feat: add generic error.html.twig fallback before code-specific templates (6401f47)
- fix: preserve FrameworkException status code instead of overwriting with 500 (1d2062d)
- feat: add whereLike into QueryBuilder (c306e7c)
- fix: unwrap BackedEnum/UnitEnum values before comparing in ChoiceValidator (08b1fc5)
- fix: correct inverted return value in ChoiceValidator numeric key check (185f760)
- fix: auto-unwrap BackedEnum default value in Column attribute (063519a)

v4.46.0
- fix: remove "s" caracter in directory name (02a1eea)
- feat: add new twig function to get template of route (ed3ac84)
- fix: add create query builder method (8e8aab6)

v4.45.0
- feat: add DateHelper with timeAgo method (af3bf03)
- feat: add new method to format int/float into decimal string (476b1f0)

v4.44.0
- feat: add buildUrlWithParams to Request and pagination_link Twig extension (133b26c)

v4.43.0
- feat: add flexible flash functions to twig view extension (5e02d6d)
- feat: add flash helper methods to controller extension (2098a5a)
- fix: fix html container rendering and message expiration (b69affc)

v4.42.1
- fix: add PHP 8.1+ Enum support to PropertyAccessor (cb938a7)

v4.42.0
- feat: add NumberControllerExtension and NumberViewExtension for slugify access (aa2c906)
- feat: add NumberHelper with compact method (0c14bac)

v4.41.1
- fix: ignore column key and normalize boolean defaults in column diff (eaf02ce)
- fix: canonicalize longtext as json in mysql platform (4b9cd8a)
- fix: include package entities in ORM diff calculation (22b32ed)
- fix: make EAGER fetch actually eager-load OneToMany/ManyToMany collections (12637c4)
- fix: register entity in identity map before resolving associations to support circular references (e793d43)

v4.41.0
- feat: add StringViewExtension for slugify access in Twig templates (994f9d1)
- feat: add StringControllerExtension for slugify access in controllers (bb0378f)
- feat: add StringHelper with slugify method (061b587)

v4.40.0
- fix: update ide helper (fb2218f)
- feat: add get asset path controller extension (56fcaf0)
- fix: skip raw input reading for multipart requests to avoid false 403 on uploads (7103f6c)

v4.39.0
- feat: support wildcard patterns in global middleware exclude list (b5653ac)
- feat: merge app.config.php global middlewares into execution pipeline (9c25e5e)
- feat: add isGlobal and exclude fields to MiddlewareMeta (c6aa28f)
- docs: add example for global middleware with exclude in AppConfigTemplate (414c7bf)

v4.38.1
- fix: remove "s" caracters from directories (9ad6a5c)

v4.38.0
- feat: accept remember parameter in TokenGuard attempt/login (no-op for JWT) (a3e68a0)
- feat: implement remember-me via cache-backed token cookie in SessionGuard (00cc412)
- feat: add remember parameter to GuardInterface attempt/login signatures (7e17e07)
- feat: add CacheModule dependency to AuthModule for remember-me support (3cef285)
- feat: support remember-me flag in AuthManager attempt/login and guard resolution (2237a86)
- feat: add remember configuration to AuthConfigTemplate (4bfc78b)

v4.37.0
- feat: add File case to FieldType enum (4dbf34f)
- feat: add field_checks/field_failed_rules Twig helpers for Regex-based checklists (452dbfc)
- feat: derive password checklist from Regex constraints via checklistLabel (fb10ff8)
- fix: skip unmapped form fields when reflecting entity properties (eba2ec0)
- fix: stop auto-adding NotBlank from required option in FormBuilder (0e4c5c6)
- feat: add form_error() Twig helper to get a field's first error message (1e2ba31)
- feat: add AbstractForm to streamline form build + request handling (7660fb4)
- feat: add isMethod() to Request for HTTP method checking (2cfd045)
- feat: add HttpRequest enum for type-safe HTTP method comparison (62cc42d)

v4.36.1
- fix: replace double quotes with simple quote (039330d)

v4.36.0
- feat: add generate defautl view when generate a new controller (2f1e709)

v4.35.4
- fix: replace double quotes with simple quotes (9eb393b)

v4.35.3
- fix: resolve vendor persistence and windows symlink deletion error when deleting projects (237fd01)

v4.35.2
- fix: expose raw request body via getRawBody() for signature verification (4604641)
- fix: correct class name resolution regex in ScannerFileManager (8dcd91a)
- fix: correct class name resolution regex in ScannerFileManager (9363bd1)

v4.35.1
- fix: set directory without "s" char (c3d1197)

v4.35.0
- fix: correct ReflectionProperty method name for lazy objects (ce9fa36)
- fix: pass column mapping through to type conversion calls (b33fdd3)
- feat: support enum columns via enumClass, with BackedEnum auto-detection (efc5273)
- feat: add native ENUM column support via EnumType (d4ef747)
- chore: update built-in types to match Type's new $column parameter (bd46140)
- feat: add $column param to convertToPHPValue/convertToDatabaseValue for column-aware type conversion (a1c5fb0)
- feat: support ManyToMany pivot FKs; fix FK column key (7d44341)
- feat: add diffForeignKeys() and normalize FK signature (220fb9d)
- feat: emit FOREIGN KEY constraints in generated migrations (c7816ee)
- feat: wire foreign key diffing into orm:diff command (6e23a70)

v4.34.0
- fix: emit UNIQUE constraint in generated column DDL (ce04b2d)
- fix: resolve snake_case field names to camelCase entity properties (662f862)
- feat: getData() returns bound entity when one is set via bind() (f85a301)
- chore: update AbstractController IDE helper (79c895d)
- feat: propagate $query param through controller helpers (b12b34c)
- feat: support query string parameters in generateUrl() (2687bd4)
- fix: correct key access in DatabaseOrmDiffCommand::printSummary() (e3f419c)
- feat: add generateUrl method int abstract controller (9975dc6)

v4.33.1
- fix: return value missing in MigrationRunner::getPending() (e44ae89)

v4.33.0
- feat: add View extension for Cookie and Session (71ec5e1)
- feat: add controller extensions for Session/Cookie and Flash and update AbstractController into ide helper (961ce85)

v4.32.0
- feat: add DatabaseConnection collector (3534574)
- feat: add DumperTwigExtension exposing {{ var_dump() }} in Twig templates, using the same Dumper rendering as dd()/dump() (fd8ab9d)

v4.31.1
- fix: remove command to scan php8.5 codebase (defa3dc)
- docs: add explanatory comments to intentionally empty catch blocks across the codebase (e05f08f)
- fix: remove trailing whitespace (97536a5)
- fix: add missing declare strict type (8df3ccf)
- fix: add missing declare strict type (31041dc)
- fix: use pipe operator from PHP8.5 (2774388)
- fix: use pipe operator from PHP8.5 (9b944c2)
- fix: use array_first and array_last from PHP8.5 (0387605)
- refactor: modernize PHP code and update documentation (97f1d37)
- refactor: modernize PHP code and update documentation (704fd0f)

v4.31.0
- fix: resolve PHPStan level 6 errors (8cc94b5)
- feat: add NotificationCollector with success/failed/partial/skipped tabs, track sends in NotificationManager (d8de5c4)
- feat: render complex values through Dumper across profiler collectors instead of raw/compressed JSON (3fec1a1)
- fix: make $this->make() reuse the container's Response singleton instead of creating a new instance, fixing missing headers/content-type in the profiler (bf08272)
- fix: prevent memory exhaustion in Dumper on circular references and oversized object graphs (daa76c6)
- feat: pass real variable values (not just names) from views to the profiler, rendered via Dumper on-demand (f5503fe)
- feat: render array/object values in profiler tables and log contexts through Dumper instead of raw/compressed JSON (e4846a1)

v4.30.0
- docs: add README for dumper (a61711b)
- feat: route dump() output to a new Profiler "Dumps" tab instead of printing inline (492ed84)
- fix: harden and polish Dumper — recursion/memory safety, brace alignment, DateTime rendering, object identity (#id), collapsible long strings; also fix unguarded print_r() OOM in ErrorManager (8316888)
- feat: add dd()/dump() debug helpers with dark-themed collapsible variable dumps, disabled outside dev (133b5dc)
- feat: wire up dd()/dump() debug helpers and the translate() helper via explicit requires in index.php (8da2afd)

v4.29.1
- fix: eliminate toolbar/profile data mismatch by computing collector export once and reusing it for both (a13c5d3)

v4.29.0
- fix: fix phpstan errors (9d084b8)
- feat: scan appPath for collectors, so app-level collectors get auto-registered like core and package ones (1f60a43)
- docs: add README (197ecdb)
- fix: use a fixed-height sticky bar with negative margin to avoid scrollbar jump and layout gap on header collapse (3dfbbd4)
- refactor: make the colored header scroll with content, keep only the brand bar and sidebar fixed (3bd1199)
- feat: add request timeline/waterfall panel with full lifecycle tracing, category checkboxes, threshold filter, and drag-to-scroll (dc0f23c)
- fix: large sidebar size (ce45310)
- feat: add CacheCollector (profiler-only) and cross-reference cache log to show rate limit attempts in Middleware panel (b90598f)
- fix: remove from toolbar (c0e324a)
- feat: add AssetCollector tracking resolved assets and compilation cache hits (a2a0bec)
- fix: move into Security group (c17dc2c)
- refactor: centralize profiler cleanup into ProfilerCleaner, run it deterministically on every save (including error pages) (8826473)
- feat: add ValidatorCollector logging each constraint check with field, value, and pass/fail result (9bc120c)
- feat: add Http dropdown grouping Request, Response, Client, Session, Cookies, and Flash collectors (5f85877)
- feat: add ViewCollector tracking Twig template renders with duration and passed variable names (7a0ad33)
- feat: add HttpClientCollector tracking outgoing cURL requests with headers, body, and timing (0f84f3b)
- feat: add MiddlewareCollector with per-middleware timing, params, and block/pass status (eb7a62c)
- feat: add EventsCollector with per-listener timing and propagation-stop tracking (f88d699)
- feat: add Database dropdown with Queries and Forms collectors, dynamic collector grouping, and fix FormBuilder re-instantiation bug (19dc3f1)
- feat: add ConfigurationCollector with framework/PHP/environment info and Composer package list (5784476)
- feat: add TranslationCollector, replace collector-injection interface with a static record buffer on TranslationManager (a282c7a)
- refactor: remove internal scroll and sticky header from data table block (68f9526)
- feat: add RequestCollector and ResponseCollector to the profiler (ae35feb)
- fix: render log context as readable multi-line text instead of escaped JSON (a8f299d)
- feat: make the profiler viewable even when app bootstrap fails, extract shared rendering logic (9c97566)
- feat: capture module boot errors and surface them in the profiler, fix stale toolbar data on early crashes (0df0682)
- feat: add dark NeoProfiler brand bar above the header (ad0a813)
- feat: replace log table with card-style log-list block including collapsible context (0111b16)
- refactor: split profiler CSS into scoped per-component stylesheets and redesign sidebar/tabs (59e3daa)
- refactor: replace HTTP-only badge coloring with generic alert/neutral badge type in toolbar (ce25cba)
- refactor: restrict global duration/memory metrics to the Route panel only (8857147)
- refactor: make nav/panel badges optional and color-driven by controller instead of collectors and support per-collector metrics, tabbed blocks, and package grouping in sidebar (8d3c23a)
- feat: add AuthCollector for core AuthManager, expose guard/identifier getters (47aa617)
- feat: add RouteCollector with dynamic status-based badge coloring (3e59199)
- feat: add PackagesCollector to list installed composer packages (7c40581)
- feat: add core profiler system (manager, module, listener, toolbar) (4240618)
- fix: reassign instance instead of unset() on static property in ProfilerManager::reset() (0f7ce08)
- refactor: rebuild the profiler system from scratch — data-only collectors via CollectorInterface, HTML/CSS extracted into dedicated templates, storage moved to var/cache/profiler with automatic cleanup (1fcfd43)
- feat: remove oldest use profiler (ae54611)
- feat: remove old toolbar/profiler system (e205e56)

v4.28.2
- fix: handle repositories with no existing tags in package-release workflow (afcf1e5)

v4.28.1
- ci: add reusable package-release workflow for automatic versioning and tagging (4bd8b79)

v4.28.0
- feat: register package translation paths in PackageModule (a1752e4)
- feat: add getTranslationsPath to PackageInterface and AbstractPackage (f91c6ca)

v4.27.0
- feat: scan package paths for profiler collectors using ScannerFileManager (3c7b8ac)

v4.26.1
- fix: set packages instead of package into app.config.php template (3af661a)

v4.26.0
- fix: scan Core Package Controllers path in RouterManager so PackageAssetController is discovered (e3c8c9e)
- fix: register redirect() and make() methods in ResponseControllerExtension (0a803eb)
- feat: add PackageAssetController to serve package static assets (793c725)
- feat: add adminConfig() and adminSidebar() Twig functions via AdminControllerExtension (cabd5c6)

v4.25.3
- fix: register bootstrap error handler in bin/neo for CLI error formatting (d9bfcb6)
- fix: render plain text errors in CLI instead of HTML in ErrorManager (09b6eb2)

v4.25.2
- ci: add contents write permission to ide-helper workflow (5d2641c)

v4.25.1
- ci: sequence ide-helper after auto-release to avoid concurrent push to main (8a3985b)

v4.25.0
- chore: add generated IDE helper stub for AbstractController autocomplete (c5f4d40)
- chore: exclude .ide-helper from Composer classmap (770f768)
- feat: add make:ide-helper command to generate AbstractController IDE stub (b08c321)

v4.24.1
- fix: remove deleted project from composer.local.json instead of root composer.json (0e50415)
- fix: sync projects into composer.local.json instead of root composer.json (d89f1db)

v4.24.0
- feat: add package:remove command to uninstall packages and detect leftover PackageInterface classes (f3dab88)
- fix: register newly installed package's PSR-4 mapping on the active autoloader before scanning (c9b3c6e)
- fix: prefer Composer autoload over manual require_once in ScannerFileManager (5c2380b)

v4.23.1
- fix: add /packages/ to gitignore (9a4de93)

v4.23.0
- feat: expose RoleConfig from AuthManager for third-party role resolution (7a73995)

v4.22.1
- docs: fix reduce text (1e46ee8)

v4.22.0
- docs: document package assets convention and PackageAssetController (b7ba716)
- feat: add PackageAssetController to serve package static assets (aea1c5e)
- feat: add getAssetsPath to PackageInterface and AbstractPackage (a38650a)
- docs: replace dangling hello-package reference with a full inline example in Package README (849d6f8)
- build: allow wikimedia/composer-merge-plugin in composer.json (0c891fb)
- feat: seed composer.local.json from template if missing in ProjectCreateCommand (aa0b720)
- build: add composer.local.json.dist template (43e9dbc)
- feat: register new projects in composer.local.json instead of composer.json (b54cf45)
- chore: ignore composer.local.json (768fb1f)
- build: add wikimedia/composer-merge-plugin to merge composer.local.json (6cdcb36)

v4.21.0
- fix: move @var docblock above the assignment instead of the foreach to satisfy PHPStan (4e91110)
- fix: set default composer (a253d63)
- feat: add package:require command to install packages and detect NeoPHP PackageInterface classes (0fc84ce)
- feat: add withExcludedSegment to ScannerFileManager to prune directories during scan (5a3b588)
- feat: add packages key to generated app.config.php template (f9161d5)
- build: register hello-package as a local path repository (2c25128)
- feat: load package config files from Config/Packages with project priority (ae27401)
- feat: report migration status across project and package paths in DatabaseMigrationStatusCommand (baa9d12)
- feat: pass project and package paths to MigrationRunner rollback in DatabaseMigrationRollbackCommand (267ac2e)
- feat: run migrations from project and package paths in DatabaseMigrationMigrateCommand (5c743ff)
- feat: search all project and package paths before rollback in MigrationRunner (2b34815)
- feat: scan project and package cron paths in CronRunCommand (2e117f5)
- feat: scan project and package cron paths in CronListCommand (89962ca)
- refactor: make CronScanner stateless and accept multiple paths (452917f)
- feat: add PackageModule dependency to ConsoleModule (1969973)
- refactor: split static and instance command scanning in ConsoleManager (01dc91c)
- feat: add PackageModule dependency to ExtensionModule (c849a53)
- refactor: use ScannerFileManager in ExtensionManager and append package paths (c128a03)
- feat: add PackageModule dependency to EventModule (bc32832)
- refactor: use ScannerFileManager in EventManager and append package listener paths (80171fa)
- feat: add PackageModule dependency to ViewModule (e5c0832)
- refactor: use ScannerFileManager in ViewManager and register package view namespaces (9a28b36)
- feat: add PackageModule dependency to RouterModule (e042554)
- refactor: use ScannerFileManager in RouterManager and append package controller paths (b5f207a)
- docs: add Package module README (31ce696)
- feat: add PackageModule to register and wire declared packages (26cb527)
- feat: add PackageManager config copy helper (0129803)
- feat: add AbstractPackage with convention-based path resolution (347bf12)
- feat: add PackageException (b636c2d)
- feat: add PackageInterface contract (6010fbd)

v4.20.8
- fix: resolve PHPStan errors (4b217de)
- docs: document ScannerFileManager and getFileScanner in Utils README (1960d60)
- docs: document ScannerFileManager and FileScanResult in Scanner README (6ed3b84)
- refactor: use ScannerFileManager in CronScanner::scan (a4a95c0)
- refactor: use ScannerFileManager in ConsoleManager command discovery (45aec32)
- refactor: use ScannerFileManager in ExtensionManager::discover (3e24410)
- refactor: use ScannerFileManager in EventManager::scanListeners (961bbed)
- refactor: use ScannerFileManager in RouterManager::scanControllers (8a0de60)
- refactor: use ScannerFileManager in ModuleManager::discover (4e63d34)
- refactor: rename getScanner to getFileScanner in ScannerControllerExtension PHPDoc (607978d)

v4.20.7
- fix: use symlink instead of mirror for project path repositories (ec55f18)

v4.20.6
- fix: DatabaseConnection should not fail when database.config.php is missing (3ecda78)

v4.20.5
- fix: remove auth from gitignore (b01b8fd)

v4.20.4
- fix: use AttributeScanResult getters instead of array access in ConsoleManager (2938884)

v4.20.3
- fix: replace "Table of Contents" to "Summary" (38290dc)

v4.20.2
- doc: update STARTUP (8234539)

v4.20.1
- docs: translate all README, STARTUP and CONTRIBUTION files (3bc4bf8)

v4.20.0
- docs: update ROADMAP (4939cb5)
- docs: document Paginator, QueryBuilder::paginate() and paginator_links in README (5605142)
- feat: add paginator_links Twig extension for rendering pagination navigation (7e930b1)
- feat: add EntityRepository::paginate() for entity-based pagination (6cde3ea)
- feat: add QueryBuilder::paginate() using a cloned builder for the count query (4a23c22)
- feat: add standalone Paginator with pagination metadata and link windowing (8d08f47)

v4.19.0
- docs: update ROADMAP (5669e0b)
- docs: document persistent connections and transaction leak warning (2a9481c)
- feat: add persistan option key (4ffd28c)
- feat: support persistent PDO connections via config option (2182fdf)

v4.18.2
- docs: update ROADMAP (d2a2275)

v4.18.1
- fix: buffer output during dispatch to prevent premature flush before headers are sent (7070295)

v4.18.0
- fix: remove redundant isAbstract() check and use AttributeScanResult getters in ConsoleManager (761732f)
- docs: update ROADMAP (d3c04c6)
- docs: document DatabaseIntrospector and its metadata DTOs in README (7343a07)
- refactor: convert ColumnMetadata to array in MigrationGenerator::generate() (daa18da)
- refactor: convert ColumnMetadata to array at JSON snapshot boundary in MigrationSchemaSnapshot (d32c9fa)
- refactor: return metadata DTOs from DatabaseIntrospector (a39184e)
- feat: add IndexMetadata DTO (d5666fd)
- feat: add ForeignKeyMetadata DTO (abc80d1)
- feat: add ColumnMetadata DTO (4779cd8)

v4.17.1
- fix: migrate remaining ScannerAttributeManager consumers to AttributeScanResult getters (79e1c54)

v4.17.0
- docs: update ROADMAP (7e1e058)
- docs: document AttributeScanResult DTO in Scanner README (844b312)
- refactor: consume AttributeScanResult in RouterManager, CronScanner, TestScanner and MiddlewareManager (a878659)
- refactor: return AttributeScanResult instead of array shape in ScannerAttributeManager (bf1ccde)
- feat: add AttributeScanResult DTO (7e52e7d)

v4.16.1
- fix: accumulate changelog entries instead of overwriting on each release (1aef400)

- docs: update ROADMAP (d9acce7)
- docs: document RoleConfig DTO in Auth README (cec95a5)
- refactor: build RoleConfig from config array in AuthManager (df9022e)
- refactor: use RoleConfig instead of raw array in TokenGuard (ec60677)
- refactor: use RoleConfig instead of raw array in SessionGuard (dfdebc3)
- feat: add RoleConfig DTO shared between auth guards (7d41c9c)