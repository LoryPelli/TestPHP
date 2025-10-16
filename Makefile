all: docker htpasswd
docker:
	@python env.py && docker compose up -d
htpasswd:
	@docker exec -it nginx "./htpasswd.sh" && docker cp "nginx:/etc/nginx/.htpasswd" "./.htpasswd"