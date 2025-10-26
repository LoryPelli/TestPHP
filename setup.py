from pathlib import Path

src = Path('.env.example')
dest = Path('.env')
htpasswd = Path('.htpasswd')
htpasswdsh = Path('htpasswd.sh')

if not(src.exists()) or not(htpasswdsh.exists()):
    print('Missing required files!')
    raise SystemExit(1)

if not(dest.exists()):
    dest.write_bytes(src.read_bytes())

htpasswd.touch(0o644)

src.chmod(0o644)
dest.chmod(0o644)

htpasswdsh.chmod(0o755)
