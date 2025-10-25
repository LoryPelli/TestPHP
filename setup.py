from pathlib import Path

src = Path('.env.example')
dest = Path('.env')
htpasswd = Path('.htpasswd')
htpasswdsh = Path('htpasswd.sh')

if not(dest.exists()):
    dest.write_text(src.read_text())

htpasswd.touch()

htpasswdsh.chmod(0o755)
