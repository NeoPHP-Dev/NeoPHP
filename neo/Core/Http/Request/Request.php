<?php
declare(strict_types=1);

namespace Neo\Core\Http\Request;


use Neo\Core\Error\Exception\FrameworkException;
use Neo\Core\Http\Client\Session\Session;
use Neo\Core\Http\File\Model\UploadedFile;
use Neo\Core\Http\Request\Enum\HttpRequest;

class Request
{
    private string $method;

    private string $path;

    /** @var array<string, mixed> */
    private array $query;

    /** @var array<string, mixed> */
    private array $body;

    /** @var array<string, string> */
    private array $headers;

    /** @var array<string, mixed> */
    private array $server;

    /** @var array<string, array<string, mixed>> */
    private array $files;

    private ?Session $session = null;

    private string $rawBody = '';

    /**
     * @param array<string, mixed> $query
     * @param array<string, mixed> $body
     * @param array<string, string> $headers
     * @param array<string, mixed> $server
     * @param array<string, array<string, mixed>> $files
     */
    private const int|float INPUT_MAX_SIZE = 8 * 1024 * 1024;

    /**
     * @param string $method
     * @param string $path
     * @param array<string, mixed> $query
     * @param array<string, mixed> $body
     * @param array<string, string> $headers
     * @param array<string, mixed> $server
     * @param array<string, array<string, mixed>> $files
     */
    private function __construct(
        string $method,
        string $path,
        array $query,
        array $body,
        array $headers,
        array $server,
        array $files = []
    ) {
        $this->method = strtoupper($method);
        $this->path = $this->sanitizePath($path);
        $this->query = $query;
        $this->body = $body;
        $this->headers = $headers;
        $this->server = $server;
        $this->files = $files;
    }

    public static function fromGlobals(): self
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        $query = $_GET ?? [];

        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $isMultipart = stripos($contentType, 'multipart/form-data') !== false;

        $rawInput = $isMultipart ? '' : self::readRawInput();

        $body = [];
        if (stripos($contentType, 'application/json') !== false) {
            try {
                $decoded = json_decode($rawInput, true, 512, JSON_THROW_ON_ERROR);
                $body = is_array($decoded) ? $decoded : [];
            } catch (\JsonException $e) {
                $body = [];
            }
        } else {
            $body = $_POST ?? [];
        }

        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (str_starts_with($key, 'HTTP_')) {
                $name = substr($key, 5)
                        |> (fn($x) => str_replace('_', ' ', $x))
                        |> strtolower(...)
                        |> ucwords(...)
                        |> (fn($x) => str_replace(' ', '-', $x));

                $headers[$name] = $value;
            }
        }

        if (isset($_SERVER['CONTENT_TYPE'])) {
            $headers['Content-Type'] = $_SERVER['CONTENT_TYPE'];
        }

        if (isset($_SERVER['CONTENT_LENGTH'])) {
            $headers['Content-Length'] = (string) $_SERVER['CONTENT_LENGTH'];
        }

        $files = $_FILES ?? [];

        $request = new self($method, $path, $query, $body, $headers, $_SERVER, $files);
        $request->rawBody = $rawInput;

        return $request;
    }

    public static function createEmpty(): self
    {
        return new self('CLI', '/', [], [], [], [], []);
    }

    private static function readRawInput(): string
    {
        $contentLength = isset($_SERVER['CONTENT_LENGTH'])
            ? (int) $_SERVER['CONTENT_LENGTH']
            : null;

        if ($contentLength !== null && $contentLength > self::INPUT_MAX_SIZE) {
            throw new FrameworkException(
                title: 'Request Too Large',
                message: sprintf(
                    'The request body (%d bytes) exceeds the maximum allowed size of %d bytes.',
                    $contentLength,
                    self::INPUT_MAX_SIZE
                ),
                code: 413,
                context: ['contentLength' => $contentLength, 'maxSize' => self::INPUT_MAX_SIZE]
            );
        }

        $stream = fopen('php://input', 'rb');
        if ($stream === false) {
            return '';
        }

        $raw = stream_get_contents($stream, self::INPUT_MAX_SIZE + 1);
        fclose($stream);

        if ($raw === false) {
            return '';
        }

        if (strlen($raw) > self::INPUT_MAX_SIZE) {
            throw new FrameworkException(
                title: 'Request Too Large',
                message: sprintf(
                    'The request body (%d bytes read) exceeds the maximum allowed size of %d bytes.',
                    strlen($raw),
                    self::INPUT_MAX_SIZE
                ),
                code: 413,
                context: ['size' => strlen($raw), 'maxSize' => self::INPUT_MAX_SIZE]
            );
        }

        return $raw;
    }

    private function sanitizePath(string $path): string
    {
        $path = preg_replace('#/\.\.(/|$)#', '/', $path);
        $path = preg_replace('#/\.(/|$)#', '/', $path);

        $path = '/' . trim($path, '/');
        return $path === '/' ? '/' : rtrim($path, '/');
    }

    /**
     * @param string $method
     * @param string $path
     * @param array<string, mixed> $query
     * @param array<string, mixed> $body
     * @param array<string, string> $headers
     * @param array<string, mixed> $server
     * @return Request
     */
    public static function fromArray(
        string $method,
        string $path,
        array $query = [],
        array $body = [],
        array $headers = [],
        array $server = []
    ): self {
        return new self(
            $method,
            $path,
            $query,
            $body,
            $headers,
            $server
        );
    }

    public function file(string $key): ?UploadedFile
    {
        if (!isset($this->files[$key])) return null;

        return new UploadedFile($this->files[$key]);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function allFiles(): array
    {
        return $this->files;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function query(string $key, mixed $default = null): mixed
    {
        return $this->query[$key] ?? $default;
    }

    public function body(?string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return $this->body;
        }

        return $this->body[$key] ?? $default;
    }

    /**
     * @return array<string, mixed>
     */
    public function allQuery(): array
    {
        return $this->query;
    }

    /**
     * @return array<string, mixed>
     */
    public function allBody(): array
    {
        return $this->body;
    }

    public function getPost(?string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return $this->body;
        }
        return $this->body[$key] ?? $default;
    }

    public function header(string $name, mixed $default = null): mixed
    {
        return $this->headers[$name] ?? $default;
    }

    /**
     * @return array<string, string>
     */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * @return array<string, mixed>
     */
    public function server(): array
    {
        return $this->server;
    }

    /**
     * @return string|array<string, mixed>
     */
    public function getContent(): string|array
    {
        $contentType = $this->header('Content-Type', '');

        if (stripos($contentType, 'multipart/form-data') !== false) {
            return '';
        }

        $rawInput = self::readRawInput();

        if (stripos($contentType, 'application/json') !== false) {
            try {
                return json_decode($rawInput, true, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
                return $rawInput;
            }
        }

        return $rawInput;
    }

    public function enablePreviousUrlTracking(Session $session): void
    {
        $this->session = $session;
        $this->rememberPreviousUrl();
    }

    private function rememberPreviousUrl(): void
    {
        if ($this->method !== 'GET') {
            return;
        }

        if (str_starts_with($this->path, '/api')) {
            return;
        }

        $previousUrl = $this->session->get('_current_url', null);
        $this->session->set('_previous_url', $previousUrl);

        $currentUrl = $this->getFullUrl();
        $this->session->set('_current_url', $currentUrl);
    }

    public function getPreviousUrl(?string $fallback = null): string
    {
        return $this->session?->get('_previous_url', $fallback ?? '/') ?? ($fallback ?? '/');
    }

    public function getFullUrl(): string
    {
        $queryString = http_build_query($this->query);
        return $queryString
            ? $this->path . '?' . $queryString
            : $this->path;
    }

    public function getUserAgent(): ?string
    {
        return $this->server['HTTP_USER_AGENT'] ?? null;
    }

    public function getIp(): ?string
    {
        $remoteAddr = $this->server['REMOTE_ADDR'] ?? null;
        $isFromLikelyProxy = $remoteAddr !== null && filter_var(
                $remoteAddr, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
            ) === false;

        if ($isFromLikelyProxy) {
            $ipHeaders = [
                'HTTP_CF_CONNECTING_IP',
                'HTTP_X_REAL_IP',
                'HTTP_X_FORWARDED_FOR',
            ];

            foreach ($ipHeaders as $header) {
                if (!empty($this->server[$header])) {
                    $ip = trim(array_first(explode(',', $this->server[$header])));
                    if (
                        filter_var(
                            $ip,
                            FILTER_VALIDATE_IP,
                            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
                        ) !== false
                    ) {
                        return $ip;
                    }
                }
            }
        }

        return ($remoteAddr !== null && filter_var($remoteAddr, FILTER_VALIDATE_IP) !== false)
            ? $remoteAddr
            : null;
    }

    /**
     * @return array<string, mixed>
     */
    public function getPostAll(): array
    {
        return $this->body;
    }

    /**
     * @return array<string, mixed>
     */
    public function getServer(): array
    {
        return $this->server;
    }

    public function getRawBody(): string
    {
        return $this->rawBody;
    }

    public function isMethod(HttpRequest|string $method): bool
    {
        $expected = $method instanceof HttpRequest ? $method->value : strtoupper($method);
        return strtoupper($this->method) === $expected;
    }

    /**
     * @param array<string, mixed> $extraParams
     * @param string|null $basePath
     * @return string
     */
    public function buildUrlWithParams(array $extraParams = [], ?string $basePath = null): string
    {
        $path = $basePath ?? $this->getPath();
        $params = array_merge($this->allQuery(), $extraParams);

        $pairs = [];
        foreach ($params as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_scalar($value)) {
                $pairs[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $value);
            }
        }

        if (empty($pairs)) {
            return $path;
        }

        return $path . '?' . implode('&', $pairs);
    }

    public function getScheme(): string
    {
        return (($this->server['HTTPS'] ?? 'off') !== 'off') ? 'https' : 'http';
    }

    public function getHost(): string
    {
        return (string)($this->server['HTTP_HOST'] ?? 'localhost');
    }

    public function getBaseUrl(): string
    {
        return $this->getScheme() . '://' . $this->getHost();
    }

    public function getAbsoluteUrl(?string $path = null): string
    {
        $target = $path ?? $this->getFullUrl();

        return $this->getBaseUrl() . $target;
    }

}