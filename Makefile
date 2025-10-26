.PHONY: all down setup up htpasswd
all: down setup up htpasswd
down:
	@docker compose down
setup:
	@python3 setup.py
up:
	@docker compose up -d
htpasswd:
	@docker exec -it nginx "./htpasswd.sh" && docker cp "nginx:/etc/nginx/.htpasswd" "./.htpasswd"