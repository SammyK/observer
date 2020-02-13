/* observer extension for PHP (c) 2020 Sammy Kaye Powers <sammyk@php.net> */

#ifdef HAVE_CONFIG_H
# include "config.h"
#endif

#include "php.h"
#include "ext/standard/info.h"
#include "php_observer.h"

static PHP_MINIT_FUNCTION(observer)
{
	return SUCCESS;
}

static PHP_RINIT_FUNCTION(observer)
{
#if defined(ZTS) && defined(COMPILE_DL_OBSERVER)
	ZEND_TSRMLS_CACHE_UPDATE();
#endif

	return SUCCESS;
}

static PHP_MINFO_FUNCTION(observer)
{
	php_info_print_table_start();
	php_info_print_table_header(2, "observer support", "enabled");
	php_info_print_table_end();
}

zend_module_entry observer_module_entry = {
	STANDARD_MODULE_HEADER,
	"observer",
	NULL,					/* zend_function_entry */
	PHP_MINIT(observer),
	NULL,					/* PHP_MSHUTDOWN */
	PHP_RINIT(observer),
	NULL,					/* PHP_RSHUTDOWN */
	PHP_MINFO(observer),
	PHP_OBSERVER_VERSION,
	STANDARD_MODULE_PROPERTIES
};

#ifdef COMPILE_DL_OBSERVER
# ifdef ZTS
ZEND_TSRMLS_CACHE_DEFINE()
# endif
ZEND_GET_MODULE(observer)
#endif
