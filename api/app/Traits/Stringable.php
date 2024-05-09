<?php

namespace App\Traits;

trait Stringable
{
    protected function sanitize(string $word): string
    {
        return strtolower($this->removeSpaces(
            $this->removeAccents($word)
        ));
    }

    protected function removeAccents($string)
    {
        $str = $this->utf8Encode(trim($string));
        $strResult = str_replace(['à', 'á', 'â', 'ã', 'ä', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý'], ['a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y'], $str);

        return $strResult;
    }

    protected function utf8Encode($string)
    {
        $str = (string)$string;
        if (!function_exists('mb_detect_encoding')) {
            $utf8 = (strtolower(mb_detect_encoding($str)) == 'utf-8');
        } else {
            $length = strlen($str);
            $utf8 = true;
            for ($i = 0; $i < $length; $i++) {
                $c = ord($str[$i]);
                if ($c < 0x80) {
                    $n = 0;
                } // 0bbbbbbb
                elseif (($c & 0xE0) == 0xC0) {
                    $n = 1;
                } // 110bbbbb
                elseif (($c & 0xF0) == 0xE0) {
                    $n = 2;
                } // 1110bbbb
                elseif (($c & 0xF8) == 0xF0) {
                    $n = 3;
                } // 11110bbb
                elseif (($c & 0xFC) == 0xF8) {
                    $n = 4;
                } // 111110bb
                elseif (($c & 0xFE) == 0xFC) {
                    $n = 5;
                } // 1111110b
                else {
                    return false;
                } // Does not match any model
                for ($j = 0; $j < $n; $j++) { // n bytes matching 10bbbbbb follow ?
                    if ((++$i == $length)
                        || ((ord($str[$i]) & 0xC0) != 0x80)
                    ) {
                        $utf8 = false;
                        break;
                    }
                }
            }
        }
        if (!$utf8) {
            return utf8_encode($str);
        }
        return $str;
    }

    protected function removeSpaces(string $text): string
    {
        return str_replace(' ', '_', trim($text));
    }
}
