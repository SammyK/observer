#ifndef PHP_OBSERVER_H
# define PHP_OBSERVER_H

extern zend_module_entry observer_module_entry;
# define phpext_observer_ptr &observer_module_entry

# define PHP_OBSERVER_VERSION "0.1.0"

# if defined(ZTS) && defined(COMPILE_DL_OBSERVER)
ZEND_TSRMLS_CACHE_EXTERN()
# endif

ZEND_BEGIN_MODULE_GLOBALS(observer)
	int instrument;
ZEND_END_MODULE_GLOBALS(observer)

#ifdef ZTS
#define OBSERVER_G(v) TSRMG(observer_globals_id, zend_observer_globals *, v)
#else
#define OBSERVER_G(v) (observer_globals.v)
#endif

#endif	/* PHP_OBSERVER_H */
