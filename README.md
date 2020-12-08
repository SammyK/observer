# Observer PHP 8 Extension

This is a PoC PHP 8 extension that demonstrates the observer API.

```bash
$ phpize \
    && ./configure \
        --with-php-config=/path/to/php-config \
    && make
$ php -dextension=$(pwd)/modules/observer.so --ri=observer
```
When INI setting `observer.instrument=1`, the observer extension will emit a message before and after every user land function call.

Execute via
```bash
$ /path/to/sapi/cli/php \
    -d extension=$(pwd)/modules/observer.so \
    -d observer.instrument=1 \
    -r "function foo() {return 42;} var_dump(foo());"
[BEGIN foo()]
[END foo(): int]
int(42)
```
