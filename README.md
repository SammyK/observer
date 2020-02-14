# Observer PHP 8 Extension

This is a PoC PHP 8 extension that demonstrates the instrumentation API.

First compile PHP with the [instrumentation feature](https://github.com/SammyK/php-src/tree/php-8-instrumentation-hooks). Then compile this extension.

```bash
$ phpize \
    && ./configure \
        --with-php-config=/path/to/php-config \
    && make
$ php -dextension=$(pwd)/modules/observer.so --ri=observer
```
When INI setting `observer.instrument=1`, the observer extension will emit a message before and after every function call.

```bash
$ /path/to/sapi/cli/php \
    -d extension=$(pwd)/modules/observer.so \
    -d observer.instrument=1 \
    -r "var_dump(42);"
[BEGIN var_dump()]
int(42)
[END var_dump()]
```
