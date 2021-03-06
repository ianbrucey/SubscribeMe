<?php

use App\Business;
use App\Plan;
use App\Subscription;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Debug\Dumper;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HigherOrderTapProxy;
use Illuminate\Support\Facades\Auth;

if (! function_exists('append_config')) {
    /**
     * Assign high numeric IDs to a config item to force appending.
     *
     * @param  array  $array
     * @return array
     */
    function append_config(array $array)
    {
        $start = 9999;

        foreach ($array as $key => $value) {
            if (is_numeric($key)) {
                $start++;

                $array[$start] = Arr::pull($array, $key);
            }
        }

        return $array;
    }
}

if (! function_exists('array_add')) {
    /**
     * Add an element to an array using "dot" notation if it doesn't exist.
     *
     * @param  array   $array
     * @param  string  $key
     * @param  mixed   $value
     * @return array
     */
    function array_add($array, $key, $value)
    {
        return Arr::add($array, $key, $value);
    }
}

if (! function_exists('array_collapse')) {
    /**
     * Collapse an array of arrays into a single array.
     *
     * @param  array  $array
     * @return array
     */
    function array_collapse($array)
    {
        return Arr::collapse($array);
    }
}

if (! function_exists('array_divide')) {
    /**
     * Divide an array into two arrays. One with keys and the other with values.
     *
     * @param  array  $array
     * @return array
     */
    function array_divide($array)
    {
        return Arr::divide($array);
    }
}

if (! function_exists('array_dot')) {
    /**
     * Flatten a multi-dimensional associative array with dots.
     *
     * @param  array   $array
     * @param  string  $prepend
     * @return array
     */
    function array_dot($array, $prepend = '')
    {
        return Arr::dot($array, $prepend);
    }
}

if (! function_exists('array_except')) {
    /**
     * Get all of the given array except for a specified array of items.
     *
     * @param  array  $array
     * @param  array|string  $keys
     * @return array
     */
    function array_except($array, $keys)
    {
        return Arr::except($array, $keys);
    }
}

if (! function_exists('array_first')) {
    /**
     * Return the first element in an array passing a given truth test.
     *
     * @param  array  $array
     * @param  callable|null  $callback
     * @param  mixed  $default
     * @return mixed
     */
    function array_first($array, callable $callback = null, $default = null)
    {
        return Arr::first($array, $callback, $default);
    }
}

if (! function_exists('array_flatten')) {
    /**
     * Flatten a multi-dimensional array into a single level.
     *
     * @param  array  $array
     * @param  int  $depth
     * @return array
     */
    function array_flatten($array, $depth = INF)
    {
        return Arr::flatten($array, $depth);
    }
}

if (! function_exists('array_forget')) {
    /**
     * Remove one or many array items from a given array using "dot" notation.
     *
     * @param  array  $array
     * @param  array|string  $keys
     * @return void
     */
    function array_forget(&$array, $keys)
    {
        return Arr::forget($array, $keys);
    }
}

if (! function_exists('array_get')) {
    /**
     * Get an item from an array using "dot" notation.
     *
     * @param  \ArrayAccess|array  $array
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function array_get($array, $key, $default = null)
    {
        return Arr::get($array, $key, $default);
    }
}

if (! function_exists('array_has')) {
    /**
     * Check if an item or items exist in an array using "dot" notation.
     *
     * @param  \ArrayAccess|array  $array
     * @param  string|array  $keys
     * @return bool
     */
    function array_has($array, $keys)
    {
        return Arr::has($array, $keys);
    }
}

if (! function_exists('array_last')) {
    /**
     * Return the last element in an array passing a given truth test.
     *
     * @param  array  $array
     * @param  callable|null  $callback
     * @param  mixed  $default
     * @return mixed
     */
    function array_last($array, callable $callback = null, $default = null)
    {
        return Arr::last($array, $callback, $default);
    }
}

if (! function_exists('array_only')) {
    /**
     * Get a subset of the items from the given array.
     *
     * @param  array  $array
     * @param  array|string  $keys
     * @return array
     */
    function array_only($array, $keys)
    {
        return Arr::only($array, $keys);
    }
}

if (! function_exists('array_pluck')) {
    /**
     * Pluck an array of values from an array.
     *
     * @param  array   $array
     * @param  string|array  $value
     * @param  string|array|null  $key
     * @return array
     */
    function array_pluck($array, $value, $key = null)
    {
        return Arr::pluck($array, $value, $key);
    }
}

if (! function_exists('array_prepend')) {
    /**
     * Push an item onto the beginning of an array.
     *
     * @param  array  $array
     * @param  mixed  $value
     * @param  mixed  $key
     * @return array
     */
    function array_prepend($array, $value, $key = null)
    {
        return Arr::prepend($array, $value, $key);
    }
}

if (! function_exists('array_pull')) {
    /**
     * Get a value from the array, and remove it.
     *
     * @param  array   $array
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function array_pull(&$array, $key, $default = null)
    {
        return Arr::pull($array, $key, $default);
    }
}

if (! function_exists('array_random')) {
    /**
     * Get a random value from an array.
     *
     * @param  array  $array
     * @param  int|null  $num
     * @return mixed
     */
    function array_random($array, $num = null)
    {
        return Arr::random($array, $num);
    }
}

if (! function_exists('array_set')) {
    /**
     * Set an array item to a given value using "dot" notation.
     *
     * If no key is given to the method, the entire array will be replaced.
     *
     * @param  array   $array
     * @param  string  $key
     * @param  mixed   $value
     * @return array
     */
    function array_set(&$array, $key, $value)
    {
        return Arr::set($array, $key, $value);
    }
}

if (! function_exists('array_sort')) {
    /**
     * Sort the array by the given callback or attribute name.
     *
     * @param  array  $array
     * @param  callable|string  $callback
     * @return array
     */
    function array_sort($array, $callback)
    {
        return Arr::sort($array, $callback);
    }
}

if (! function_exists('array_sort_recursive')) {
    /**
     * Recursively sort an array by keys and values.
     *
     * @param  array  $array
     * @return array
     */
    function array_sort_recursive($array)
    {
        return Arr::sortRecursive($array);
    }
}

if (! function_exists('array_where')) {
    /**
     * Filter the array using the given callback.
     *
     * @param  array  $array
     * @param  callable  $callback
     * @return array
     */
    function array_where($array, callable $callback)
    {
        return Arr::where($array, $callback);
    }
}

if (! function_exists('array_wrap')) {
    /**
     * If the given value is not an array, wrap it in one.
     *
     * @param  mixed  $value
     * @return array
     */
    function array_wrap($value)
    {
        return Arr::wrap($value);
    }
}

if (! function_exists('camel_case')) {
    /**
     * Convert a value to camel case.
     *
     * @param  string  $value
     * @return string
     */
    function camel_case($value)
    {
        return Str::camel($value);
    }
}

if (! function_exists('class_basename')) {
    /**
     * Get the class "basename" of the given object / class.
     *
     * @param  string|object  $class
     * @return string
     */
    function class_basename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }
}

if (! function_exists('class_uses_recursive')) {
    /**
     * Returns all traits used by a class, its subclasses and trait of their traits.
     *
     * @param  object|string  $class
     * @return array
     */
    function class_uses_recursive($class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        $results = [];

        foreach (array_merge([$class => $class], class_parents($class)) as $class) {
            $results += trait_uses_recursive($class);
        }

        return array_unique($results);
    }
}

if (! function_exists('collect')) {
    /**
     * Create a collection from the given value.
     *
     * @param  mixed  $value
     * @return \Illuminate\Support\Collection
     */
    function collect($value = null)
    {
        return new Collection($value);
    }
}

if (! function_exists('data_fill')) {
    /**
     * Fill in data where it's missing.
     *
     * @param  mixed   $target
     * @param  string|array  $key
     * @param  mixed  $value
     * @return mixed
     */
    function data_fill(&$target, $key, $value)
    {
        return data_set($target, $key, $value, false);
    }
}

if (! function_exists('data_get')) {
    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param  mixed   $target
     * @param  string|array  $key
     * @param  mixed   $default
     * @return mixed
     */
    function data_get($target, $key, $default = null)
    {
        if (is_null($key)) {
            return $target;
        }

        $key = is_array($key) ? $key : explode('.', $key);

        while (! is_null($segment = array_shift($key))) {
            if ($segment === '*') {
                if ($target instanceof Collection) {
                    $target = $target->all();
                } elseif (! is_array($target)) {
                    return value($default);
                }

                $result = Arr::pluck($target, $key);

                return in_array('*', $key) ? Arr::collapse($result) : $result;
            }

            if (Arr::accessible($target) && Arr::exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return value($default);
            }
        }

        return $target;
    }
}

if (! function_exists('data_set')) {
    /**
     * Set an item on an array or object using dot notation.
     *
     * @param  mixed  $target
     * @param  string|array  $key
     * @param  mixed  $value
     * @param  bool  $overwrite
     * @return mixed
     */
    function data_set(&$target, $key, $value, $overwrite = true)
    {
        $segments = is_array($key) ? $key : explode('.', $key);

        if (($segment = array_shift($segments)) === '*') {
            if (! Arr::accessible($target)) {
                $target = [];
            }

            if ($segments) {
                foreach ($target as &$inner) {
                    data_set($inner, $segments, $value, $overwrite);
                }
            } elseif ($overwrite) {
                foreach ($target as &$inner) {
                    $inner = $value;
                }
            }
        } elseif (Arr::accessible($target)) {
            if ($segments) {
                if (! Arr::exists($target, $segment)) {
                    $target[$segment] = [];
                }

                data_set($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite || ! Arr::exists($target, $segment)) {
                $target[$segment] = $value;
            }
        } elseif (is_object($target)) {
            if ($segments) {
                if (! isset($target->{$segment})) {
                    $target->{$segment} = [];
                }

                data_set($target->{$segment}, $segments, $value, $overwrite);
            } elseif ($overwrite || ! isset($target->{$segment})) {
                $target->{$segment} = $value;
            }
        } else {
            $target = [];

            if ($segments) {
                data_set($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite) {
                $target[$segment] = $value;
            }
        }

        return $target;
    }
}

if (! function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function dd(...$args)
    {
        foreach ($args as $x) {
            (new Dumper)->dump($x);
        }

        die(1);
    }
}

if (! function_exists('e')) {
    /**
     * Escape HTML special characters in a string.
     *
     * @param  \Illuminate\Contracts\Support\Htmlable|string  $value
     * @return string
     */
    function e($value)
    {
        if ($value instanceof Htmlable) {
            return $value->toHtml();
        }

        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }
}

if (! function_exists('ends_with')) {
    /**
     * Determine if a given string ends with a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    function ends_with($haystack, $needles)
    {
        return Str::endsWith($haystack, $needles);
    }
}

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        if (strlen($value) > 1 && Str::startsWith($value, '"') && Str::endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (! function_exists('head')) {
    /**
     * Get the first element of an array. Useful for method chaining.
     *
     * @param  array  $array
     * @return mixed
     */
    function head($array)
    {
        return reset($array);
    }
}

if (! function_exists('kebab_case')) {
    /**
     * Convert a string to kebab case.
     *
     * @param  string  $value
     * @return string
     */
    function kebab_case($value)
    {
        return Str::kebab($value);
    }
}

if (! function_exists('last')) {
    /**
     * Get the last element from an array.
     *
     * @param  array  $array
     * @return mixed
     */
    function last($array)
    {
        return end($array);
    }
}

if (! function_exists('object_get')) {
    /**
     * Get an item from an object using "dot" notation.
     *
     * @param  object  $object
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function object_get($object, $key, $default = null)
    {
        if (is_null($key) || trim($key) == '') {
            return $object;
        }

        foreach (explode('.', $key) as $segment) {
            if (! is_object($object) || ! isset($object->{$segment})) {
                return value($default);
            }

            $object = $object->{$segment};
        }

        return $object;
    }
}

if (! function_exists('preg_replace_array')) {
    /**
     * Replace a given pattern with each value in the array in sequentially.
     *
     * @param  string  $pattern
     * @param  array   $replacements
     * @param  string  $subject
     * @return string
     */
    function preg_replace_array($pattern, array $replacements, $subject)
    {
        return preg_replace_callback($pattern, function () use (&$replacements) {
            foreach ($replacements as $key => $value) {
                return array_shift($replacements);
            }
        }, $subject);
    }
}

if (! function_exists('retry')) {
    /**
     * Retry an operation a given number of times.
     *
     * @param  int  $times
     * @param  callable  $callback
     * @param  int  $sleep
     * @return mixed
     *
     * @throws \Exception
     */
    function retry($times, callable $callback, $sleep = 0)
    {
        $times--;

        beginning:
        try {
            return $callback();
        } catch (Exception $e) {
            if (! $times) {
                throw $e;
            }

            $times--;

            if ($sleep) {
                usleep($sleep * 1000);
            }

            goto beginning;
        }
    }
}

if (! function_exists('snake_case')) {
    /**
     * Convert a string to snake case.
     *
     * @param  string  $value
     * @param  string  $delimiter
     * @return string
     */
    function snake_case($value, $delimiter = '_')
    {
        return Str::snake($value, $delimiter);
    }
}

if (! function_exists('starts_with')) {
    /**
     * Determine if a given string starts with a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    function starts_with($haystack, $needles)
    {
        return Str::startsWith($haystack, $needles);
    }
}

if (! function_exists('str_after')) {
    /**
     * Return the remainder of a string after a given value.
     *
     * @param  string  $subject
     * @param  string  $search
     * @return string
     */
    function str_after($subject, $search)
    {
        return Str::after($subject, $search);
    }
}

if (! function_exists('str_contains')) {
    /**
     * Determine if a given string contains a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    function str_contains($haystack, $needles)
    {
        return Str::contains($haystack, $needles);
    }
}

if (! function_exists('str_finish')) {
    /**
     * Cap a string with a single instance of a given value.
     *
     * @param  string  $value
     * @param  string  $cap
     * @return string
     */
    function str_finish($value, $cap)
    {
        return Str::finish($value, $cap);
    }
}

if (! function_exists('str_is')) {
    /**
     * Determine if a given string matches a given pattern.
     *
     * @param  string  $pattern
     * @param  string  $value
     * @return bool
     */
    function str_is($pattern, $value)
    {
        return Str::is($pattern, $value);
    }
}

if (! function_exists('str_limit')) {
    /**
     * Limit the number of characters in a string.
     *
     * @param  string  $value
     * @param  int     $limit
     * @param  string  $end
     * @return string
     */
    function str_limit($value, $limit = 100, $end = '...')
    {
        return Str::limit($value, $limit, $end);
    }
}

if (! function_exists('str_plural')) {
    /**
     * Get the plural form of an English word.
     *
     * @param  string  $value
     * @param  int     $count
     * @return string
     */
    function str_plural($value, $count = 2)
    {
        return Str::plural($value, $count);
    }
}

if (! function_exists('str_random')) {
    /**
     * Generate a more truly "random" alpha-numeric string.
     *
     * @param  int  $length
     * @return string
     *
     * @throws \RuntimeException
     */
    function str_random($length = 16)
    {
        return Str::random($length);
    }
}

if (! function_exists('str_replace_array')) {
    /**
     * Replace a given value in the string sequentially with an array.
     *
     * @param  string  $search
     * @param  array   $replace
     * @param  string  $subject
     * @return string
     */
    function str_replace_array($search, array $replace, $subject)
    {
        return Str::replaceArray($search, $replace, $subject);
    }
}

if (! function_exists('str_replace_first')) {
    /**
     * Replace the first occurrence of a given value in the string.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $subject
     * @return string
     */
    function str_replace_first($search, $replace, $subject)
    {
        return Str::replaceFirst($search, $replace, $subject);
    }
}

if (! function_exists('str_replace_last')) {
    /**
     * Replace the last occurrence of a given value in the string.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $subject
     * @return string
     */
    function str_replace_last($search, $replace, $subject)
    {
        return Str::replaceLast($search, $replace, $subject);
    }
}

if (! function_exists('str_singular')) {
    /**
     * Get the singular form of an English word.
     *
     * @param  string  $value
     * @return string
     */
    function str_singular($value)
    {
        return Str::singular($value);
    }
}

if (! function_exists('str_slug')) {
    /**
     * Generate a URL friendly "slug" from a given string.
     *
     * @param  string  $title
     * @param  string  $separator
     * @return string
     */
    function str_slug($title, $separator = '-')
    {
        return Str::slug($title, $separator);
    }
}

if (! function_exists('str_start')) {
    /**
     * Begin a string with a single instance of a given value.
     *
     * @param  string  $value
     * @param  string  $prefix
     * @return string
     */
    function str_start($value, $prefix)
    {
        return Str::start($value, $prefix);
    }
}

if (! function_exists('studly_case')) {
    /**
     * Convert a value to studly caps case.
     *
     * @param  string  $value
     * @return string
     */
    function studly_case($value)
    {
        return Str::studly($value);
    }
}

if (! function_exists('tap')) {
    /**
     * Call the given Closure with the given value then return the value.
     *
     * @param  mixed  $value
     * @param  callable|null  $callback
     * @return mixed
     */
    function tap($value, $callback = null)
    {
        if (is_null($callback)) {
            return new HigherOrderTapProxy($value);
        }

        $callback($value);

        return $value;
    }
}

if (! function_exists('title_case')) {
    /**
     * Convert a value to title case.
     *
     * @param  string  $value
     * @return string
     */
    function title_case($value)
    {
        return Str::title($value);
    }
}

if (! function_exists('trait_uses_recursive')) {
    /**
     * Returns all traits used by a trait and its traits.
     *
     * @param  string  $trait
     * @return array
     */
    function trait_uses_recursive($trait)
    {
        $traits = class_uses($trait);

        foreach ($traits as $trait) {
            $traits += trait_uses_recursive($trait);
        }

        return $traits;
    }
}

if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (! function_exists('windows_os')) {
    /**
     * Determine whether the current environment is Windows based.
     *
     * @return bool
     */
    function windows_os()
    {
        return strtolower(substr(PHP_OS, 0, 3)) === 'win';
    }
}

if (! function_exists('with')) {
    /**
     * Return the given object. Useful for chaining.
     *
     * @param  mixed  $object
     * @return mixed
     */
    function with($object)
    {
        return $object;
    }
}

function formatPrice($pennies) {
    $price = $pennies * .01;
    return "$".$price;
}

function getPublicStripeKey() {
    return config('services.stripe.public');
}

function getPrivateStripeKey() {
    return config('services.stripe.secret');
}

function getWebHookKey($type) {
    return config('services.stripe.'.$type);
}

function setStripeApiKey($secretOrPublic) {
    if($secretOrPublic == "secret") {
        \Stripe\Stripe::setApiKey(getPrivateStripeKey());
    } elseif($secretOrPublic == "public") {
        \Stripe\Stripe::setApiKey(getPublicStripeKey());
    }
}

function currentMonthAndYear() {
    return date('m').date('Y');
}

function currentMonth() {
    return date('m');
}

function currentYear() {
    return date('Y');
}

function extractLimitYear($date)
{
    return substr($date,2);
}

function extractLimitMonth($date)
{
    return substr($date,0,2);
}

/** this method is used to unlink photos during deletes */
function getFullPathToImage($dbPath) {
    return storage_path('app/public/') . $dbPath;
}

function form_method_field($requestType) {
    return new HtmlString('<input type="hidden" name="_method" value="'.$requestType.'">');
}

function itemUrl($businessId, $planId) {
    return sprintf('/business/store/%u/plan/%u',$businessId, $planId);
}

function getAuthUser() {
    return \Illuminate\Support\Facades\Auth::user();
}

function howFarAway(
    $latitudeFrom,
    $longitudeFrom,
    $latitudeTo,
    $longitudeTo,
    $earthRadius = 6371000)
{
// convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo =   deg2rad($latitudeTo);
    $lonTo =   deg2rad($longitudeTo);

    $lonDelta = $lonTo - $lonFrom;
    $a = pow(cos($latTo) * sin($lonDelta), 2) +
        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

    $angle = atan2(sqrt($a), $b);
# S = R * ø(theta);
    $result = $angle * $earthRadius;
    $result/=1609;
    $result = round($result, 2);

    return $result;
}

function defaultSearchDistanceKM() {
    return '80.5km';
}

function defaultSearchDistanceMI() {
    return (int) defaultSearchDistanceKM() / .621;
}

function removeLastWord($text) {
    $arr = explode(' ', $text);
    array_pop($arr);
    return implode(' ',$arr);
}

function getLoadingAnimation()
{
    return new HtmlString('<img src="/images/pacman.gif">');
}

function authedUserFullName()
{
    $user = \Illuminate\Support\Facades\Auth::user();
    return ucwords(sprintf("%s %s", $user->first, $user->last));
}

function formatDate($time, $formatString)
{
    $date = new DateTime($time);
    return $date->format($formatString);
}

function getRatingStars($rating)
{
    for($i = 1; $i <= 5; $i++){
        if($rating >= $i){
            $class = 'fa fa-star';
        } elseif ($i - $rating < 1.0) {
            $class = 'fa fa-star-half-full';
        } else {
            $class = 'fa fa-star-o';
        }

        echo "<span class='$class'></span>";
    }
}

function hasNewNotifications()
{
    return Auth::check() ? Auth::user()->notification_count > 0 : false;
}

function getThemeColorValue()
{
    return '#4cb996';
}

function getUseLimitString($plan){
    if($plan->limit_interval) {
        if($plan->use_limit_year) {
            return sprintf('%s time(s) a %s',$plan->use_limit_year,$plan->limit_interval);
        } elseif($plan->use_limit_month) {
            return sprintf('%s time(s) a %s',$plan->use_limit_month,$plan->limit_interval);
        }
    }

    return "no limit on uses";
}

function getBusinessLogoImg($business)
{
    return getImage($business->logo_path);
}

function getOtruvezLogoImg()
{
    return baseUrlConcat('/classimax/images/logos/otruvez-logo.png'); 
}

function getOtruvezCircleLogoImg()
{
    return baseUrlConcat('/classimax/images/logos/o-logo-cropped.png');
}

function getAccountNotificationsUrl()
{
    return sprintf('%s/account/notifications',config('app.url'));
}

function getAccountSubscriptionsUrl()
{
    return sprintf('%s/account/mysubscriptions',config('app.url'));
}

function getBusinessNotificationsUrl($businessId)
{
    return sprintf('%s/business/notifications/',config('app.url'), $businessId);
}

function s3PhotobucketPath() {
    return "https://s3-us-west-2.amazonaws.com/otruvez-images/";
}

function getImage($imgPath) {
    return fixDoubleSlash(s3PhotobucketPath().$imgPath);
}

function fixDoubleSlash($path) {
    $path = str_replace("https://","", $path);
    $path = str_replace("http://","", $path);
    $path = str_replace("//","/", $path);
    return "https://".$path;
}

function getLocalImage($imgPath) {
    return fixDoubleSlash(s3PhotobucketPath().$imgPath);
}

function s3BucketFolderList() {
    return [
        'business-photo',
        'business-logo',
        'plan-featured-photo',
        'plan-photo',
        'logos'
    ];
}

function truncateCardTitle($str){
    return strlen($str) > 55 ? substr($str,0,55)."..." : substr($str,0,55);
}

function baseUrlConcat($str) {
    return sprintf("%s%s",env('APP_URL'),$str);
}

function validatePortalParams($businessId ,$stripeId ,$apiKey) {

    $arr = [];
    $business = (new Business())->find($businessId);
    $arr['business'] = $business;

    if($business && $business->api_key == $apiKey) {
        $plan = (new Plan())->find($stripeId);
        $arr['plan'] = $plan;
        if($plan && $plan->business_id == $business->id) {
            return $arr;
        } else {
            return null;
        }
    } else {
        return null;
    }
}

function generateValidationToken() {
    return rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
}

function issetAndTrue($array, $key) {
    return isset($array[$key]) && $array[$key] ? $array[$key] : null;
}

function curlRequest($url, $post = null) {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    $content = trim(curl_exec($ch));
    curl_close($ch);
    var_dump($content);
    print $content;
}

function jsonToObject($json) {
    return json_decode($json);
}

function objectToJson($object) {
    return json_encode($object);
}

function noEntityAbort($entity, $code) {
    if($entity == null) {
        abort($code);
    }
}

function serverError500() {
    abort(500);
}

function notYourEntityAbort403(\Illuminate\Database\Eloquent\Model $entity) {
    if($entity->user_id != Auth::id()) {
        abort(403);
    }
}

function logException(Exception $e) {
    return Bugsnag::notifyException($e);
}

function sanitizeRequest(\Illuminate\Http\Request $request) {
    if(strtoupper($request->method()) == 'PUT' || strtoupper($request->method()) == 'POST') {
        $skip = ['_method', '_token'];
        $keys = array_keys($request->all());
        foreach ($keys as $key) {
            $value = in_array($key, $skip) ? $request->$key : htmlspecialchars($request->$key);
            $request->merge([$key => $value]);
        }
        var_dump($request->all());
    }
}


function getAuthedBusiness() {
    return Business::where('user_id', Auth::id())->first();
}

function calculateRemainingUses(Plan $plan, Subscription $subscription) {
    $limitInterval = $plan->limit_interval;

    if(!empty($limitInterval)) {
        $useLimit = $limitInterval == "year" ? $plan->use_limit_year : $plan->use_limit_month;
    }
    return [
        'limitInterval' => $limitInterval,
        'usesRemaining' => $useLimit - $subscription->uses,
        'useLimit'      => $useLimit
    ];
}

/**
 * @param Subscription $subscription
 * @param Plan $plan
 * @return bool
 * This method will check to see if the 'uses' on the subscription
 * are greater than the plan's limit. If so, then we check to see if
 * last usage date is within the range of current interval. if it is, then the limit is exceeded.
 * If the last usage was in the previous month or year, then they have not exceeded
 */
function isUsageLimitExceeded(Subscription $subscription, Plan $plan ) {

    $planInterval = $plan->limit_interval;

    $planUseLimit = $planInterval == 'year' ? $plan->use_limit_year : $plan->use_limit_month;

    if ($subscription->uses >= $planUseLimit) // resets every mont
    {
        if($planInterval == 'year' && extractLimitYear($subscription->last_usage_date) == currentYear() ||
            $planInterval == 'month' && extractLimitMonth($subscription->last_usage_date) == currentMonth()
        )
        {
            return true;
        }
        // we are in a new month so we can reset the uses on the sub
        $subscription->uses = 0;
        $subscription->save();

    }
    return false;
}

/**
 * @param Subscription $subscription
 * @return bool
 * This method is one of many used to determine whether or not a refund should be issued.
 * The 'uses' are reset every month or year depending on the interval. But before we can issue you a refund,
 * we need to be sure that you've paid within that same month or year, else we have nothing
 * to refund you
 */
function isPaymentWithinCurrentInterval(Subscription $subscription) {
    setStripeApiKey('secret');
    $stripeSubscription = \Stripe\Subscription::retrieve($subscription->stripe_id);
    $plan               = (new Plan())->find($subscription->plan_id);
    $usageInterval      = $plan->limit_interval;
    $currentDate        = new DateTime();
    $paidDate           = new DateTime();
    $paidDate->setTimestamp($stripeSubscription->current_period_start);

    if($usageInterval == 'month') {
        return $currentDate->format('M') == $paidDate->format('M');
    } else {
        return $currentDate->format('Y') == $paidDate->format('Y');
    }

}

const SERVICE_CATEGORY_LIST = [
    ""  => "Choose a category",
    "1" => "Beauty & Spa",
    "2" => "Health & Fitness",
    "3" => "Activities, Special Events",
    "4" => "Retail",
    "5" => "Food and Drink",
    "6" => "Automotive",
    "7" => "Home Services",
    "8" => "Online Services",
    "9" => "Software",
    "10" => "Travel",
    "11" => "Apparel",
    "12" => "Automotive",
    "13" => "Baby &amp; Kids",
    "14" => "Beauty",
    "15" => "Collectibles",
    "16" => "Electronics",
    "17" => "Entertainment",
    "18" => "Footwear",
    "19" => "Grocery",
    "20" => "Handbags",
    "21" => "Home Improvement",
    "22" => "Home",
    "23" => "Intimates",
    "24" => "Jewelry",
    "25" => "Office",
    "26" => "Patio",
    "27" => "Pets",
    "28" => "Sports &amp; Outdoors",
    "29" => "Toys &amp; Games",
    "30" => "Vitamins",
];

function subtractStripeFees($pennies) {
    return $pennies == 0 ? 0 : substr(($pennies - STRIPE_FLAT_FEE) * (1 - STRIPE_PERCENT_FEE),0,4);
}

function secureUrl($str) {
    return env('APP_ENV') == 'prod' ? str_replace("http://","https://", $str) : $str;
}
const CUSTOMER_SERVICE_CONTACT_LIMIT = 3;
const ALPHANUMERIC_DASH_SPACE_REGEX = 'regex:/^[a-zA-Z0-9\-\s#]+$/';
const ALPHANUMERIC_DASH_SPACE_DOT_REGEX = 'regex:/^[a-zA-Z0-9\-\s.#]+$/';
const TITLE_NAME_REGEX =  'regex:/^[a-zA-Z0-9\-\s.,\'"_()#]+$/';
const DESCRIPTION_REGEX = 'regex:/^[a-zA-Z0-9\-_\s.,\'"?:()$@!+=#]+$/';
const HANDLE = 'regex:/^[a-zA-Z0-9\_.]+$/';
const STRIPE_FLAT_FEE = 30;
const STRIPE_PERCENT_FEE = .029;
// logo: <img src="{{getImage("logos/otruvez-logo.png")}}" style="width: 150px; height: auto;">
