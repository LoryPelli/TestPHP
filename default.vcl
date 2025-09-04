vcl 4.1;

backend default {
    .host = "php";
    .port = "63342";
}

sub vcl_backend_response {
    unset beresp.http.Pragma;
    unset beresp.http.Expires;
    unset beresp.http.Server;
    set beresp.ttl = 5m;
}

sub vcl_recv {
    if (req.url ~ "\.(css|js|png|ico)$") {
        unset req.http.Cookie;
    }
}