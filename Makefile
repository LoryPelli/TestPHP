.PHONY: all start down setup up htpasswd
all: start down setup up htpasswd
start:
	@docker desktop start
down:
	@docker compose down
setup:
	@python3 setup.py
up:
	@docker compose up -d
htpasswd:
	@docker exec -it nginx "./htpasswd.sh" && docker cp "nginx:/etc/nginx/.htpasswd" "./.htpasswd"