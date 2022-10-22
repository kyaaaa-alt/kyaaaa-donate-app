<?php
$getConf = new \Core\Conf\App();
date_default_timezone_set($getConf->app_timezone());
$handler = new \Core\Conf\Kyaaaa\Handler\Run();
if ($getConf->environment() == 'development') {
    $handler->pushHandler(new \Core\Conf\Kyaaaa\Handler\Handler\KyaaaaDevelopmentHandler());
} else {
    $handler->pushHandler(new \Core\Conf\Kyaaaa\Handler\Handler\KyaaaaProductionHandler());
}
$handler->register();
$getConf->session();

define('PUBLIC_PATH', $_SERVER['DOCUMENT_ROOT']);

if ( !function_exists('dd') ) {
    function dd($var) {
        echo '<html><head><title>Kyaaaa~ Ge-debug!</title><meta name="viewport" content="width=device-width, initial-scale=1.0"></head><body style="background: #202124;font-size: 15px;"><div style="padding:10px;background:#b12776;margin-bottom:10px;color:#fff;max-width:1920px;font-weight:normal;font-family:Courier New;border-radius: 8px;font-size: 17px;letter-spacing: 1.8px;">Kyaaaa~ Ge-debug!</div><div style="margin-left: 25px;">';
        foreach (func_get_args() as $var) {
            if (is_array($var) || is_object($var)) {
                ini_set("highlight.keyword", "#ff79c6;  font-weight: bolder");
                ini_set("highlight.string", "#c1f953; font-weight: lighter; ");
                ini_set("highlight.default", "#fff; font-weight: lighter; ");
                ob_start();
                highlight_string("<?php\r" . var_export($var, true) . " ?>");
                $highlighted_output = ob_get_clean();
                $highlighted_output = str_replace( ["&lt;?php","?&gt;"] , '', $highlighted_output );
                echo $highlighted_output;
            } else {
                echo "<pre style='color: #fff;font-size: 15px;'>";
                var_dump($var);
                echo "</pre>";
            }
        }

        echo '</div></body></html>';
        die;
    }
}

if( !function_exists('esc') ) {
    function esc($str, $entities = true) {
        if ($entities == false ) {
            $str = htmlspecialchars($str, ENT_QUOTES);
            $str = str_replace("&", "&amp;", $str);
            $str = str_replace(":", "&#58;", $str);
            $str = str_replace(";", "&#59;", $str);
            $str = str_replace("/", "&#47;", $str);
            $str = str_replace(">", "&#62;", $str);
            $str = str_replace("<", "&#60;", $str);
            $str = str_replace("'", "&#39;", $str);
            $str = str_replace("\"", "&quot;", $str);
            $str = str_replace("-", "&#45;", $str);
            $str = str_replace("_", "&#95;", $str);
            $str = str_replace("=", "&#61;", $str);
            $str = str_replace("(", "&#40;", $str);
            $str = str_replace(")", "&#41;", $str);
            $str = str_replace('document.cookie', '[cleanxss]', strtolower($str));
            $str = str_replace('document.domain', '[cleanxss]', strtolower($str));
            $str = str_replace('document.write', '[cleanxss]', strtolower($str));
            $str = str_replace('.parentNode', '[cleanxss]', strtolower($str));
            $str = str_replace('.innerHTML', '[cleanxss]', strtolower($str));
            $str = str_replace('<![CDATA[', '&lt;![CDATA[', strtolower($str));
            $str = str_replace('<comment>', '&lt;comment&gt;', strtolower($str));
            $str = str_replace('<script>', '&#60;script&#62;', strtolower($str));
            $str = str_replace('<!--', '&lt;!--', $str);
            $str = str_replace('-->', '--&gt;', $str);
        } else {
            $str = htmlspecialchars($str, ENT_QUOTES);
        }
        return $str;
    }
}

if( !function_exists('view') ) {
    function view($view, $data = []) {
        $getView = new \Core\Conf\Kyaaaa\Renderer($view, $data);
        return $getView->send();
    }
}

if ( !function_exists('viewPath') ) {
    function viewPath($view, $data = []) {
        return __DIR__ . "/../../Views/$view.kyaaaa.php";
    }
}

if ( !function_exists('d') ) {
    function d($var) {
        foreach (func_get_args() as $x) {
            var_dump($x);
        }
        die;
    }
}

if ( !function_exists('url') ) {
    function url($segments = '') {
        $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http")."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
        if ($segments != '') {
            return $url . $segments;
        } else {
            return $url;
        }

    }
}

if ( !function_exists('url') ) {
    function url($segments = '') {
        $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http")."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
        if ($segments != '') {
            return $url . $segments;
        } else {
            return $url;
        }

    }
}

if ( !function_exists('getBrowser') ) {
    function getBrowser($arr = false) {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "IE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
        }
        $i = count($matches['browser']);
        if ($i != 1) {
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }
        if ($version == null || $version == "") {
            $version = "?";
        }
        if ($arr == true) {
            return array(
                'userAgent' => $u_agent,
                'name' => $bname,
                'ver' => $version,
                'platform' => $platform,
                'pattern' => $pattern
            );
        } else {
            return $ub;
        }
    }
}

if (! function_exists('session')) {
    function session() {
        $session = new \Core\Conf\Kyaaaa\Session();
        return $session;
    }
}

if (! function_exists('request')) {
    function request() {
        $request = new \Core\Conf\Kyaaaa\Request();
        return $request;
    }
}

if (! function_exists('csrf')) {
    function csrf($setExpired = true) {
        $csrf = new \Core\Conf\Kyaaaa\CSRF();
        return $csrf;
    }
}

if ( !function_exists('redirectTo')) {
    function redirectTo($url, $code = null): void {
        if (!headers_sent()) {
            if(is_numeric($url)) {
                throw new Exception("URL Cannot be a numeric");
            }
            $parseUrl = parse_url($url);
            if (array_key_exists('scheme', $parseUrl)) {
                if (getBrowser() == 'Safari') {
                    $host = $parseUrl['scheme'] . '://' . $parseUrl['host'];
                    if (array_key_exists('path', $parseUrl)) {
                        $path = $parseUrl['path'];
                        $query = '?' . $parseUrl['query'];
                        header('Location: ' . $host . rawurldecode($path));
                    } else if (array_key_exists('query', $parseUrl)) {
                        $path = $parseUrl['path'];
                        $query = '?' . $parseUrl['query'];
                        header('Location: ' . $host . rawurldecode($path) . rawurldecode($query));
                    } else {
                        header('Location: ' . $host);
                    }
                } else {
                    if ($code == NULL) {
                        switch ($code) {
                            case 301:
                                $code = '301 Moved Permanently';
                                break;
                            case 302:
                                $code = '302 Moved Temporarily';
                                break;
                            case 303:
                                $code = '303 See Other';
                                break;
                            default:
                                $code = '303 See Other';
                                break;
                        }
                    }
                    header( 'HTTP/1.1 ' . $code);
                    header( 'Location: ' . $url);
                    echo '<script>';
                    echo 'window.location.href="' . $url . '";';
                    echo '</script>';
                    echo '<noscript>';
                    echo '<meta http-equiv="refresh" content="0;url=' . $url . '">';
                    echo '</noscript>';
                    exit;
                }
            } else {
                throw new Exception("URL Invalid: URL Doesn't have scheme http or https");
            }
        } else {
            throw new Exception("Headers already sent.");
        }
    }
}

if ( !function_exists('strposMultiple')) {
    function strposMultiple($haystack, $needle, $offset = 0)
    {
        if (is_string($needle))
            return strpos($haystack, $needle, $offset);
        else {
            $min = false;
            foreach ($needle as $n) {
                $pos = strpos($haystack, $n, $offset);

                if ($min === false || $pos < $min) {
                    $min = $pos;
                }
            }
            return $min;
        }
    }
}

if ( !function_exists('profanity')) {
    function profanity($string) {
        $arr = explode(" ", strtolower($string));
        $profanity = ['anjing','babi','kunyuk','bajingan','asu','bangsat','kampret','kontol','memek','ngentot','pentil','perek','pepek','pecun','bencong','banci','maho','gila','sinting','tolol','sarap','setan','lonte','hencet','taptei','kampang','pilat','keparat','bejad','gembel','brengsek','tai','anjrit','bangsat','fuck','tetek','ngulum','jembut','totong','kolop','pukimak','bodat','heang','jancuk','burit','titit','nenen','bejat','silit','sempak','fucking','asshole','bitch','penis','vagina','klitoris','kelentit','borjong','dancuk','pantek','taek','itil','teho','bejat','pantat','bagudung','babami','kanciang','bungul','idiot','kimak','henceut','kacuk','blowjob','pussy','dick','damn','ass','ajg','goblok','goblog','b4b1','4nj','m3m3k','4su','k0nt','ng3n','1til','1t1l','geblek','b4ngs','kimak','tempik','j3mbut',s3t,'t1t','g0bl','t0l','t4','p3n','v4g','j4n'];
        foreach ($arr as $word) {
            if (strposMultiple($word, $profanity) !== false) {
                return true;
            }
        }
    }
}

if ( !function_exists('time_elapsed')) {
    function time_elapsed($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'tahun',
            'm' => 'bulan',
            'w' => 'minggu',
            'd' => 'hari',
            'h' => 'jam',
            'i' => 'menit',
            's' => 'detik',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' yang lalu' : 'beberapa detik yang lalu';
    }
}