from pathlib import Path

src = Path('./.env.example')
dest = Path('./.env')
htpasswd = Path('./htpasswd/.htpasswd')
htpasswdsh = Path('./htpasswd/htpasswd.sh')

if not(src.exists()) or not(htpasswdsh.exists()):
    print('\x1b[1;31m[ERROR]\x1b[0m Missing required files!')
    raise SystemExit(1)

if not(dest.exists()):
    dest.write_bytes(src.read_bytes())

htpasswd.touch(0o644)

src.chmod(0o644)
dest.chmod(0o644)

htpasswdsh.chmod(0o755)

print('\x1b[1;32m[SUCCESS]\x1b[0m Setup completed!')
