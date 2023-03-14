<?php

namespace Common\Tools;

class UserAgentParsed
{
    private $REGSTR_EDGE = "/edge/(\d.)+/";
    private $REGSTR_IE = "/trident\/[\d.]+/i";
    private $REGSTR_OLD_IE = "/msie\s[\d.]+/i";
    private $REGSTR_SAMSUNG = "/SamsungBrowser\/[\d.]+/i";
    private $REGSTR_FB = "/FBAV\/[\d.]+/i";
    private $REGSTR_FF = "/firefox\/[\d.]+/i";
    private $REGSTR_CHROME = "/chrome\/[\d.]+/i";
    private $REGSTR_SAF = "/safari\/[\d.]+/i";
    private $REGSTR_OPERA = "/opr\/[\d.]+|opera\/[\d.]+|opt\/[\d.]+/i";
    private $REGSTR_OPERA_TOUCH = "/opt\/[\d.]+/i";
    private $REGSTR_WECHAR = "/MicroMessenger\/[\d.]+/i";
    private $REGSTR_VIVSLDI = "/Vivaldi\/[\d.]+/i";
    private $REGSTR_UC = "/UBrowser\/[\d.]+/i";
    private $REGSTR_MI = "/MiuiBrowser\/[\d.]+/i";
    private $REGSTR_QQ = "/QQBrowser\/[\d.]+/i";
    private $REGSTR_APPLE_PHONE = "/(iphone|ipod|ipad)/i";
    private $REGSTR_APPLE_SYSTEM_VERSION = "/OS [\d._]*/i";
    private $REGSTR_ISMOBILE = "/iphone|ios|android|mobile|ipad|symbos|iemobile|phone|bb10/i";

    private $spider_sign_arr = [
        "baiduspider", "googlebot",
        "360spider", "bingbot",
        "bytespider", "applebot",
        "msnbot", "sosospider",
        "sosoimagespider", "baidu transcoder",
        "sogou pic spider", "sogou web spider", "sogou-test-spider",
        "youdaobot", "easouspider",
        "huaweisymantecspider", "yisouspider",
        "yahoo! slurp", "yahoo contentmatch crawler",
        "twiceler", "qihoobot",
        "naverBot", "surveybot",
        "discobot", "yanga worldsearch bot",
        "bot", "spider",
    ];

    /**
     * @description 获取浏览器信息
     * @param {*String} $useragent
     * @returns {*Array}  ["System OS Name":"Unknown"]
     */
    public function getBrowserInfo(string $useragent): array
    {
        $browserInfo = [
            "Browser Name" => "unknow",
            "Browser Version" => "unknow"
        ];
        $agent = strtolower($useragent);


        // Spider
        $isSpider = false;
        foreach ($this->spider_sign_arr as $sign) {
            if (strpos($agent, $sign) !== false) {
                $browserInfo["Spider"] = "Spider " . $sign;
                $browserInfo["Browser Version"] = "";
                $isSpider = true;
                break;
            }
        }
        if ($isSpider) {
            return $browserInfo;
        }
        // IE
        if (strpos($agent, "trident") !== false) {
            preg_match($this->REGSTR_IE, $agent, $matches);
            $browserInfo["Browser Name"] = "IE+";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }
        // OLD_IE
        if (strpos($agent, "msie") !== false) {
            preg_match($this->REGSTR_OLD_IE, $agent, $matches);
            $browserInfo["Browser Name"] = "IE-";
            $browserInfo["Browser Version"] = explode(" ", $matches[0])[1];
            return $browserInfo;
        }

        // SamsungBrowser
        if (strpos($agent, "samsungbrowser") !== false) {
            preg_match($this->REGSTR_SAMSUNG, $agent, $matches);
            $browserInfo["Browser Name"] = "SamsungBrowser";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }
        // FaceBook
        if (strpos($agent, "fbav") !== false) {
            preg_match($this->REGSTR_FB, $agent, $matches);
            $browserInfo["Browser Name"] = "FaceBook";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }
        // QQBrowser
        if (strpos($agent, "qqbrowser") !== false) {
            preg_match($this->REGSTR_QQ, $agent, $matches);
            $browserInfo["Browser Name"] = "QQBrowser";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }

        // MiuiBrowser
        if (strpos($agent, "miuibrowser") !== false) {
            preg_match($this->REGSTR_MI, $agent, $matches);
            $browserInfo["Browser Name"] = "MiuiBrowser";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }
        // UBrowser
        if (strpos($agent, "ubrowser") !== false) {
            preg_match($this->REGSTR_UC, $agent, $matches);
            $browserInfo["Browser Name"] = "UC";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }
        // Vivaldi
        if (strpos($agent, "vivaldi") !== false) {
            preg_match($this->REGSTR_VIVSLDI, $agent, $matches);
            $browserInfo["Browser Name"] = "Vivaldi";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }
        // Edge
        if (strpos($agent, "edge") !== false) {
            preg_match($this->REGSTR_EDGE, $agent, $matches);
            $browserInfo["Browser Name"] = "Edge";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }
        // Firefox
        if (strpos($agent, "firefox") !== false) {
            preg_match($this->REGSTR_FF, $agent, $matches);
            $browserInfo["Browser Name"] = "Firefox";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }
        // Opera 
        if (strpos($agent, "opr") !== false || strpos($agent, "opera") !== false) {
            preg_match($this->REGSTR_OPERA, $agent, $matches);
            $browserInfo["Browser Name"] = "Opera";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }
        // Opera Touch
        if (strpos($agent, "opt") !== false) {
            preg_match($this->REGSTR_OPERA_TOUCH, $agent, $matches);
            $browserInfo["Browser Name"] = "Opera Touch";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }
        // WeChat
        if (strpos($agent, "micromessenger") !== false) {
            preg_match($this->REGSTR_WECHAR, $agent, $matches);
            $browserInfo["Browser Name"] = "WeChat";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }
        // Safari
        if (strpos($agent, "safari") !== false && strpos($agent, "chrome") === false) {
            preg_match($this->REGSTR_SAF, $agent, $matches);
            $browserInfo["Browser Name"] = "Safari";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }
        // Chrome
        if (strpos($agent, "chrome") !== false) {
            preg_match($this->REGSTR_CHROME, $agent, $matches);
            $browserInfo["Browser Name"] = "Chrome";
            $browserInfo["Browser Version"] = explode("/", $matches[0])[1];
            return $browserInfo;
        }

        return $browserInfo;
    }

    /**
     * @description 获取客户端系统
     * @param {*String} $useragent
     * @returns {*Array}  ["System OS Name":"Unknown"]
     */
    public function getSystemOS(string $useragent): array
    {
        $systemOS = "Unknown";
        $agent = strtolower($useragent);

        if (strpos($agent, "mac os x") !== false) {
            preg_match($this->REGSTR_APPLE_PHONE, $agent, $matches);
            $type = $matches[0];
            if ($type) {
                $name = (string)$type;
                $systemOS = ucwords($name) . $this->getVersion($useragent, 'iphone');
            } else {
                $systemOS = 'Mac OS' . $this->getVersion($useragent, 'mac os x');
            }
        } else if (strpos($agent, "symbos") !== false) {
            $systemOS = 'SymbOS' . $this->getVersion($useragent, 'symbos');
        } else if (strpos($agent, "cros") !== false) {
            $systemOS = 'Chromium OS' . $this->getVersion($useragent, 'cros');
        } else if (strpos($agent, "windows phone") !== false) {
            $systemOS = 'Windows Phone' . $this->getVersion($useragent, 'windows phone');
        } else if (strpos($agent, "android") !== false) {
            $systemOS = 'Android' . $this->getVersion($useragent, 'android');
        } else if (strpos($agent, "bb10") !== false) {
            $systemOS = 'BlackBerry' . $this->getVersion($useragent, 'bb10');
        } else if (strpos($agent, "iemobile") !== false) {
            $systemOS = 'WinPhone' . $this->getVersion($useragent, 'iemobile');
        } else if (strpos($agent, "ubuntu") !== false) {
            $systemOS = 'Ubuntu' . $this->getVersion($useragent, 'ubuntu');
        } else if (strpos($agent, "debian") !== false) {
            $systemOS = 'Debian' . $this->getVersion($useragent, 'debian');
        } else if (strpos($agent, "linux") !== false) {
            $systemOS = 'Linux' . $this->getVersion($useragent, 'linux');
        } else if (strpos($agent, "windows nt 5.0") !== false) {
            $systemOS = 'Windows 2000';
        } else if (strpos($agent, "windows nt 5.1") !== false || strpos($agent, "windows nt 5.2") !== false) {
            $systemOS = 'Windows XP';
        } else if (strpos($agent, "windows nt 6.0") !== false) {
            $systemOS = 'Windows Vista';
        } else if (strpos($agent, "windows nt 6.1") !== false || strpos($agent, "windows 7") !== false) {
            $systemOS = 'Windows 7';
        } else if (strpos($agent, "windows nt 6.2") !== false || strpos($agent, "windows 8") !== false) {
            $systemOS = 'Windows 8';
        } else if (strpos($agent, "windows nt 6.3") !== false) {
            $systemOS = 'Windows 8.1';
        } else if (strpos($agent, "windows nt 6.2") !== false || strpos($agent, "windows nt 10.0") !== false) {
            $systemOS = 'Windows 10';
        }

        return ["System OS Name" => $systemOS];
    }


    private function getVersion(string $useragent, string $type): string
    {
        $subNum = [
            "linux" => 8,
            "android" => 8,
            "bb10" => 5,
            "iemobile" => 9,
            "cros" => 5,
            "ubuntu" => 7,
            "windows phone" => 14,
            "mac os x" => 9,
        ][$type];
        $agent = strtolower($useragent);
        $osStart = stripos($agent, $type);
        $versionStart = $osStart + $subNum;
        $versionEnd = stripos($agent, ";", $osStart);
        if (empty($versionEnd)) {
            return "";
        }
        $versionLength = $versionEnd - $versionStart;
        $version = substr($agent, $versionStart, $versionLength);

        if ($type === "cros" || $type === "mac os x") {
            $versionEnd = stripos($agent, ")", $osStart);
            $versionLength = $versionEnd - $versionStart;
            $version = str_replace("_", ".", substr($agent, $versionStart, $versionLength));
        }
        if ($type === "ubuntu") {

            $versionEnd = stripos($agent, " ", $osStart);
            if (empty($versionEnd)) {
                return "";
            }
            $versionLength = $versionEnd - $versionStart;
            $version = substr($agent, $versionStart, $versionLength);
        }
        if ($type === "iphone") {
            preg_match($this->REGSTR_APPLE_SYSTEM_VERSION, $agent, $matches);
            $version = str_replace("_", ".", explode(' ', $matches[0])[1]);
        }


        return !empty($version) ? " " . $version : "";
    }

    /**
     * @description 检查是不是爬虫
     * @param {*String} $useragent
     * @returns {*Array} [ "isSpider": false ]
     */
    public function checkSpider(string $useragent): array
    {
        $agent = strtolower($useragent);
        $isSpider = false;
        foreach ($this->spider_sign_arr as $sign) {
            if (strpos($agent, $sign) !== false) {
                $isSpider = true;
                break;
            }
        }

        return ["isSpider" => $isSpider];
    }

    /**
     * @description 检查客户端类型
     * @param {*String} $useragent
     * @param {*Boolean} [upperCase=true]
     * @returns {*Array} [ "machineType": "Unknown" ]
     */
    public function getMachineType(string $useragent, bool $upperCase = true): array
    {
        $agent = strtolower($useragent);
        $machineType = $upperCase ? "Unknown" : "unknown";
        if (preg_match($this->REGSTR_ISMOBILE, $agent, $matches) === 0) {
            $machineType = $upperCase ? "PC" : "pc";
        } else {
            $machineType = $upperCase ? "Mobile" : "mobile";
        }
        return ["machineType" => $machineType];
    }

    public function getAllInfo(string $useragent): array
    {
        $systemOS = $this->getSystemOS($useragent);
        $browserInfo = $this->getBrowserInfo($useragent);
        $isSpider = $this->checkSpider($useragent);
        $machineType = $this->getMachineType($useragent);
        return array_merge($systemOS, $browserInfo, $isSpider, $machineType);
    }
}
