<?php
namespace Webdock\Entity;

trait Validator
{
    public function isIPv4(string $input)
    {
        return filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    public function isIPv6(string $input)
    {
        return filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }

    public function isAlphaNum(string $input)
    {
        return ctype_alnum($input);
    }

    public function isAlpha(string $input)
    {
        return ctype_alpha($input);
    }

    protected function validate(array $src)
    {
        $rules = $this->rules();
        $errors = [];

        foreach ($src as $item => $itemValue) {
            if (!key_exists($item, $rules)) {
                $error = sprintf(
                    '`%s` is not defined in the Entity rules',
                    $item
                );
                $errors[] = $error;
                continue;
            }

            if (in_array($rules[$item]['nullable'])) {
                if (is_null($itemValue) || $itemValue === '') {
                    continue;
                }
            }

            foreach ($rules[$item] as $ruleName => $ruleValue) {
                $rule = is_string($ruleName) ? $ruleName : $ruleValue;

                switch ($rule) {
                    case 'alphanum':
                        if (!$this->isAlphaNum($itemValue)) {
                            $error = sprintf(
                                '%s must be alpha numeric, %s value given',
                                $item,
                                strval($itemValue)
                            );
                            $errors[] = $error;
                        }
                    case 'alpha':
                        if (!$this->isAlpha($itemValue)) {
                            $error = sprintf(
                                '%s must be alphabet, %s value given',
                                $item,
                                strval($itemValue)
                            );
                            $errors[] = $error;
                        }
                    case 'ipv4':
                        if (!$this->isIPv4($itemValue)) {
                            $error = sprintf(
                                '%s must be a valid IPv4, %s value given',
                                $item,
                                strval($itemValue)
                            );
                            $errors[] = $error;
                        }
                    case 'ipv6':
                        if (!$this->isIPv6($itemValue)) {
                            $error = sprintf(
                                '%s must be a valid IPv6, %s value given',
                                $item,
                                strval($itemValue)
                            );
                            $errors[] = $error;
                        }
                    case 'minLength':
                        if (strlen($itemValue) < $ruleValue) {
                            $error = sprintf(
                                '%s must be more than %s',
                                $item,
                                strlen($ruleValue)
                            );
                            $errors[] = $error;
                        }

                    case 'maxLength':
                        if (strlen($itemValue) > $ruleValue) {
                            $error = sprintf(
                                '%s must be less than %s',
                                $item,
                                strlen($ruleValue)
                            );
                            $errors[] = $error;
                        }
                    default:
                        # code...
                        break;
                }
            }
        }

        if (count($errors) > 0) {
            $errorMessage = join('\n', $errors);
            throw new EntityException($errorMessage);
        }

        return true;
    }
}
