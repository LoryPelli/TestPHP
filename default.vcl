vcl 4.1;

backend default {
    .host = "php";
}

sub vcl_backend_response {
    unset beresp.http.Pragma;
    unset beresp.http.Expires;
    if (bereq.http.host ~ "localhost") {
        return (pass);
    }
    set beresp.ttl = 5m;
}

sub vcl_recv {
    if (req.url ~ "\.(css|js|png|ico)$") {
        unset req.http.Cookie;
    }
}