# Kibana-ReverseProxy
PHP reverse proxy for passing requests to a local Kibana instance (works with Kibana 6 and 7).

> This could be done directly in Apache/Nginx config, however this is more flexible and it can be directly used with any server admin panel.

## Usage
Create a `.htpasswd` file ([see here](https://www.htaccesstools.com/htpasswd-generator/)) and add its absolute path to `.htaccess`.
