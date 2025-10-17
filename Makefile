.PHONY: all docker htpasswd
all: docker htpasswd
docker:
	@python setup.py && docker compose up -d
htpasswd:
	@docker exec -it nginx "./htpasswd.sh" && docker cp "nginx:/etc/nginx/.htpasswd" "./.htpasswd"