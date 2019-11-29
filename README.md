# Kibana-ReverseProxy
PHP reverse proxy for passing requests to a local Kibana instance (works with Kibana 6 and 7).

> This could be done directly in Apache/Nginx config, however this is more flexible and it can be directly used with any web admin panel.

In `/etc/kibana/kibana.yml`, set `server.xsrf.disableProtection: true` and run `service kibana restart`.
> Todo: pass kbn-xsrf token