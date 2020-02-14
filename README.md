# Observer PHP 8 Extension

This is a PoC PHP 8 extension that demonstrates the instrumentation API.

```bash
$ phpize \
    && ./configure \
    && make
$ php -dextension=$(pwd)/modules/observer.so --ri=observer
```
