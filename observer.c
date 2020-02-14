#ifdef HAVE_CONFIG_H
# include "config.h"
#endif

#include "php.h"
#include "ext/standard/info.h"
#include "Zend/zend_instrument.h"
#include "php_observer.h"

ZEND_DECLARE_MODULE_GLOBALS(observer)

static void observer_begin(zend_execute_data *ex) {
	php_printf("[BEGIN %s()]\n", ZSTR_VAL(ex->func->common.function_name));
}

static void observer_end(zend_execute_data *ex) {
	php_printf("[END %s()]\n", ZSTR_VAL(ex->func->common.function_name));
}

static zend_instrument_fns observer_should_instrument(zend_function *func) {
	zend_instrument_fns fns = {NULL, NULL};
	if (OBSERVER_G(instrument) == 0) {
		return fns;
	}
	fns.begin = observer_begin;
	fns.end = observer_end;
	return fns;
}

static void php_observer_init_globals(zend_observer_globals *observer_globals)
{
	observer_globals->instrument = 0;
}

PHP_INI_BEGIN()
	STD_PHP_INI_BOOLEAN("observer.instrument", "0", PHP_INI_SYSTEM, OnUpdateBool, instrument, zend_observer_globals, observer_globals)
PHP_INI_END()

static PHP_MINIT_FUNCTION(observer)
{
	ZEND_INIT_MODULE_GLOBALS(observer, php_observer_init_globals, NULL);
	REGISTER_INI_ENTRIES();
	zend_register_instrumentation(observer_should_instrument);
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
	php_info_print_table_header(2, "Observer PoC extension", "enabled");
	php_info_print_table_end();

	DISPLAY_INI_ENTRIES();
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