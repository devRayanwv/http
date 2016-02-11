<?php
/**
 * User: Rayan Alamer
 * Date: 09/02/16
 * Time: 8:42 PM
 */

namespace Http;


class Response implements ResponseInterface
{
    public $headers;
    private $cookies = [];
    private $content;
    private $statusCode;
    private $version;
    private $statusText;
    private $charset = 'UTF-8';

    const HTTP_CONTINUE = 100;
    const HTTP_SWITCHING_PROTOCOLS = 101;
    const HTTP_PROCESSING = 102;            // RFC2518
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_ACCEPTED = 202;
    const HTTP_NON_AUTHORITATIVE_INFORMATION = 203;
    const HTTP_NO_CONTENT = 204;
    const HTTP_RESET_CONTENT = 205;
    const HTTP_PARTIAL_CONTENT = 206;
    const HTTP_MULTI_STATUS = 207;          // RFC4918
    const HTTP_ALREADY_REPORTED = 208;      // RFC5842
    const HTTP_IM_USED = 226;               // RFC3229
    const HTTP_MULTIPLE_CHOICES = 300;
    const HTTP_MOVED_PERMANENTLY = 301;
    const HTTP_FOUND = 302;
    const HTTP_SEE_OTHER = 303;
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_USE_PROXY = 305;
    const HTTP_RESERVED = 306;
    const HTTP_TEMPORARY_REDIRECT = 307;
    const HTTP_PERMANENTLY_REDIRECT = 308;  // RFC7238
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_PAYMENT_REQUIRED = 402;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
    const HTTP_REQUEST_TIMEOUT = 408;
    const HTTP_CONFLICT = 409;
    const HTTP_GONE = 410;
    const HTTP_LENGTH_REQUIRED = 411;
    const HTTP_PRECONDITION_FAILED = 412;
    const HTTP_REQUEST_ENTITY_TOO_LARGE = 413;
    const HTTP_REQUEST_URI_TOO_LONG = 414;
    const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
    const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const HTTP_EXPECTATION_FAILED = 417;
    const HTTP_I_AM_A_TEAPOT = 418;                                               // RFC2324
    const HTTP_UNPROCESSABLE_ENTITY = 422;                                        // RFC4918
    const HTTP_LOCKED = 423;                                                      // RFC4918
    const HTTP_FAILED_DEPENDENCY = 424;                                           // RFC4918
    const HTTP_RESERVED_FOR_WEBDAV_ADVANCED_COLLECTIONS_EXPIRED_PROPOSAL = 425;   // RFC2817
    const HTTP_UPGRADE_REQUIRED = 426;                                            // RFC2817
    const HTTP_PRECONDITION_REQUIRED = 428;                                       // RFC6585
    const HTTP_TOO_MANY_REQUESTS = 429;                                           // RFC6585
    const HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;                             // RFC6585
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_NOT_IMPLEMENTED = 501;
    const HTTP_BAD_GATEWAY = 502;
    const HTTP_SERVICE_UNAVAILABLE = 503;
    const HTTP_GATEWAY_TIMEOUT = 504;
    const HTTP_VERSION_NOT_SUPPORTED = 505;
    const HTTP_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL = 506;                        // RFC2295
    const HTTP_INSUFFICIENT_STORAGE = 507;                                        // RFC4918
    const HTTP_LOOP_DETECTED = 508;                                               // RFC5842
    const HTTP_NOT_EXTENDED = 510;                                                // RFC2774
    const HTTP_NETWORK_AUTHENTICATION_REQUIRED = 511;                             // RFC6585


    private $statusTexts = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        208 => 'Already Reported',
        226 => 'IM Used',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Reserved',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Reserved for WebDAV advanced collections expired proposal',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
    ];

    /**
     * Response constructor.
     * @param $content
     * @param $statusCode
     * @param $version
     * @param $statusText
     */
    public function __construct($content = '', $statusCode = 200, $version = '1.1', $headers = array())
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->version = $version;
        $this->statusText = $this->statusTexts[$statusCode];
        $this->headers = new Header($headers);
    }


    public function setContent($content)
    {
        if ($content !== null && !is_string($content) && !is_numeric($content))
            throw new \UnexpectedValueException('The response content must be a string');
        $this->content = (string) $content;
    }

    public function getContent()
    {
        return $this->content;
    }


    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($code, $text = null)
    {
        if (array_key_exists($code, $this->statusTexts) && $text === null)
        {
            $this->statusCode = $code;
            $this->statusText = $this->statusTexts[$code];
        }
        else
        {
            $this->statusCode = $code;
            $this->statusText = $text;
        }
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

    public function getCharset()
    {
        return $this->charset;
    }

    public function redirect($url)
    {
        $this->headers->add(['Location' => $url]);
        $this->setStatusCode(303);
    }

    public function toJson($content)
    {
        return json_encode($content);
    }

    public function isOK()
    {
        return $this->statusCode === 200;
    }

    public function isNotFound()
    {
        return $this->statusCode === 404;
    }

    public function isClientError()
    {
        return $this->statusCode >= 400 && $this->statusCode < 500;
    }

    public function isServerError()
    {
        return $this->statusCode >= 500 && $this->statusCode < 600;
    }

    public function isForbidden()
    {
        return $this->statusCode === 403;
    }


    public function send()
    {
        $this->sendHeader();
        $this->sendContent();
    }

    public function sendHeader()
    {
        if (headers_sent())
            return $this;
        foreach($this->headers->all() as $key => $values)
        {
            foreach ($values as $value)
            {
                header($key.':'.$value, false, $this->statusCode);
            }
        }
        header(sprintf('HTTP/%s %s %s', $this->version, $this->statusCode, $this->statusText), true, $this->statusCode);

        foreach($this->cookies as $cookie)
        {
            setcookie($cookie->getName(), $cookie->getValue(), $cookie->getExpiresTime(), $cookie->getPath(), $cookie->getDomain(), $cookie->isSecure(), $cookie->isHttpOnly);

        }
        return $this;
    }

    public function allCookie()
    {
        return $this->cookies;
    }
    public function sendContent()
    {
        echo $this->content;
    }


    public function addCookie(Cookie $cookie)
    {
        $this->cookies[$cookie->getName()] = $cookie;
    }

    public function removeCookie(Cookie $cookie)
    {
        $cookie->setValue('');
        $cookie->setExpiresTime(-1);
        $this->cookies[$cookie->getName()] = $cookie;
    }
}