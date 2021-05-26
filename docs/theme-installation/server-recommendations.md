# Server Recommendations

!> **Important** If you are unsure of how to configure these settings, please contact your hosting provider.

## Recommended

- PHP version 7.4 or greater
- MySQL version 5.6 or greater OR MariaDB version 10.1 or greater
- WordPress memory limit of 256 MB or greater
- Enable HTTPS (SSL) support

## PHP.ini configurations

| Setting             | Value |
| ------------------- | ----- |
| max_execution_time  | 180   |
| memory_limit        | 256M  |
| post_max_size       | 32M   |
| upload_max_filesize | 32M   |
| max_input_vars      | 2000+ |

## WordPress memory limit

```PHP
define( 'WP_MEMORY_LIMIT', '256M' );
```

?> **Tip** WordPress memory can be different from the server – you need to set this regardless of server memory settings

[Reference to WordPress docs](https://wordpress.org/support/article/editing-wp-config-php/#increasing-memory-allocated-to-php)
