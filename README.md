# Observer PHP 8 Extension

This is a PoC PHP 8 extension that demonstrates the instrumentation API.

First compile PHP with the [instrumentation feature](https://github.com/SammyK/php-src/tree/php-8-instrumentation-hooks). Then compile this extension.

```bash
$ phpize \
    && ./configure \
    && make
$ php -dextension=$(pwd)/modules/observer.so --ri=observer
```
